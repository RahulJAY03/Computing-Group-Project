<?php
session_start();
require_once '../../config/db.php';

header('Content-Type: application/json');

function log_debug($msg) {
    error_log("[CHALLENGE DEBUG] $msg");
}

$currentUserEmail = $_SESSION['email'] ?? null;
if (!$currentUserEmail) {
    log_debug("User not logged in.");
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get current user
$user = $db->users->findOne(['email' => $currentUserEmail]);
if (!$user) {
    log_debug("User not found with email: $currentUserEmail");
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$userId = (string) $user['_id'];
log_debug("User ID: $userId");

// Fetch challenges where user is involved, with all statuses
$challengesCursor = $db->xpChallenges->find([  // Change 'challenges' to 'xpChallenges'
    '$or' => [
        ['challengerId' => new MongoDB\BSON\ObjectId($userId)],  // Convert userId to ObjectId for querying
        ['challengedId' => new MongoDB\BSON\ObjectId($userId)]   // Convert userId to ObjectId for querying
    ]
]);

$data = [];
$baseUrl = "http://localhost/cgp-sara/"; // Adjust this to include the "cgp-sara" folder

foreach ($challengesCursor as $challenge) {
    // Convert challenger and challenged user IDs to ObjectId for querying users
    $challengerObjId = $challenge['challengerId'];
    $challengedObjId = $challenge['challengedId'];

    try {
        $challenger = $db->users->findOne(['_id' => $challengerObjId]);
        $challenged = $db->users->findOne(['_id' => $challengedObjId]);
    } catch (Exception $e) {
        log_debug("Error fetching user data: " . $e->getMessage());
        continue;
    }

    if (!$challenger || !$challenged) {
        log_debug("Could not find challenger or challenged user.");
        continue;
    }

    // Prepend the base URL to the profile image paths
    $challengerImage = $baseUrl . ltrim($challenger['profile_image'], '/');
    $challengedImage = $baseUrl . ltrim($challenged['profile_image'], '/');

    $data[] = [
        '_id' => (string) $challenge['_id'],  // Ensure challenge _id is included
        'status' => $challenge['status'],
        'startXP' => $challenge['startXP'] ?? [],
        'startTime' => $challenge['startTime'] ?? null,
        'durationHours' => $challenge['durationHours'] ?? null,
        'winnerId' => $challenge['winnerId'] ?? null,
        'challenger' => [
            'id' => (string)$challengerObjId,
            'name' => $challenger['fullName'],
            'xp' => $challenger['xp'] ?? 0,
            'profile_image' => $challengerImage
        ],
        'challenged' => [
            'id' => (string)$challengedObjId,
            'name' => $challenged['fullName'],
            'xp' => $challenged['xp'] ?? 0,
            'profile_image' => $challengedImage
        ]
    ];

    // Fetch winner details if winnerId is present
    if (isset($challenge['winnerId'])) {
        $winnerObjId = $challenge['winnerId'];
        try {
            $winner = $db->users->findOne(['_id' => $winnerObjId]);
            if ($winner) {
                $winnerImage = $baseUrl . ltrim($winner['profile_image'], '/');
                $data[count($data) - 1]['winner'] = [
                    'id' => (string)$winnerObjId,
                    'name' => $winner['fullName'],
                    'xp' => $winner['xp'] ?? 0,
                    'profile_image' => $winnerImage
                ];
            }
        } catch (Exception $e) {
            log_debug("Error fetching winner data: " . $e->getMessage());
        }
    }
}

log_debug("Total challenges found: " . count($data));
echo json_encode(['success' => true, 'challenges' => $data]);

