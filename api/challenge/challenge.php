<?php
require_once '../../config/db.php'; // Adjust if your DB config path differs
require '../../vendor/autoload.php'; // MongoDB PHP Library

header('Content-Type: application/json');

// Parse JSON input
$input = json_decode(file_get_contents('php://input'), true);

$challengerId = $input['challengerId'] ?? null;
$challengedId = $input['challengedId'] ?? null;

// Basic validation
if (!$challengerId || !$challengedId) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing user IDs.']);
    exit;
}

try {
    // Convert the user IDs to MongoDB ObjectIds
    $challengerObjectId = new MongoDB\BSON\ObjectId($challengerId);
    $challengedObjectId = new MongoDB\BSON\ObjectId($challengedId);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid ObjectId format.']);
    exit;
}

// Fetch users from DB using ObjectIds
$challenger = $db->users->findOne(['_id' => $challengerObjectId]);
$challenged = $db->users->findOne(['_id' => $challengedObjectId]);

if (!$challenger || !$challenged) {
    http_response_code(404);
    echo json_encode(['success' => false, 'error' => 'One or both users not found.']);
    exit;
}

// Prepare challenge document with ObjectIds stored as is
$challenge = [
    'challengerId' => $challengerObjectId,  // Storing as ObjectId
    'challengedId' => $challengedObjectId,  // Storing as ObjectId
    'startXP' => [
        (string)$challengerObjectId => $challenger['xp'] ?? 0,
        (string)$challengedObjectId => $challenged['xp'] ?? 0,
    ],
    'startTime' => null,
    'durationHours' => 24,
    'status' => 'pending',
    'winnerId' => null,
    'createdAt' => new MongoDB\BSON\UTCDateTime()
];

// Insert the challenge into the xpChallenges collection
$result = $db->xpChallenges->insertOne($challenge);

// Return success response
echo json_encode([
    'success' => true,
    'message' => 'Challenge created successfully.',
    'challengeId' => (string)$result->getInsertedId()
]);
