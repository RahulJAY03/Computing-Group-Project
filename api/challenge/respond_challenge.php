<?php
session_start();
require_once '../../config/db.php';

header('Content-Type: application/json');

// Utility for logging
function log_debug($msg) {
    error_log("[CHALLENGE RESPOND] $msg");
}

// Check if user is logged in
$currentUserEmail = $_SESSION['email'] ?? null;
if (!$currentUserEmail) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get user info
$user = $db->users->findOne(['email' => $currentUserEmail]);
if (!$user) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$userId = (string) $user['_id'];

// Parse POST input
$input = json_decode(file_get_contents("php://input"), true);
$challengeId = $input['challengeId'] ?? null;
$action = $input['action'] ?? null; // "accept" or "decline"

if (!$challengeId || !$action) {
    echo json_encode(['success' => false, 'message' => 'Missing challenge ID or action']);
    exit;
}

try {
    $challengeObjId = new MongoDB\BSON\ObjectId($challengeId);
    $challenge = $db->xpChallenges->findOne(['_id' => $challengeObjId]);

    if (!$challenge) {
        echo json_encode(['success' => false, 'message' => 'Challenge not found']);
        exit;
    }

    // Check if current user is part of this challenge
    $challengerId = (string) $challenge['challengerId'];
    $challengedId = (string) $challenge['challengedId'];
    if ($challengerId !== $userId && $challengedId !== $userId) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    if ($action === 'decline') {
        // Delete the challenge
        $db->xpChallenges->deleteOne(['_id' => $challengeObjId]);
        echo json_encode(['success' => true, 'message' => 'Challenge declined and deleted']);
    } elseif ($action === 'accept') {
        // Accept the challenge and start the timer
        $updateResult = $db->xpChallenges->updateOne(
            ['_id' => $challengeObjId],
            [
                '$set' => [
                    'status' => 'active',
                    'startTime' => new MongoDB\BSON\UTCDateTime()
                ],
                '$setOnInsert' => [
                    'createdAt' => new MongoDB\BSON\UTCDateTime()
                ]
            ]
        );
        echo json_encode(['success' => true, 'message' => 'Challenge accepted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }

} catch (Exception $e) {
    log_debug("Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Server error']);
}

