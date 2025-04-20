<?php
session_start();
require_once '../../config/db.php';

header('Content-Type: application/json');

// Get the challengeId and winnerId from the request
$data = json_decode(file_get_contents('php://input'), true);
$challengeId = $data['challengeId'] ?? null;
$winnerId = $data['winnerId'] ?? null;

if (!$challengeId || !$winnerId) {
    echo json_encode(['success' => false, 'message' => 'Missing challengeId or winnerId']);
    exit;
}

// Update the challenge document with the winnerId
$result = $db->xpChallenges->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($challengeId)],
    ['$set' => ['winnerId' => new MongoDB\BSON\ObjectId($winnerId), 'status' => 'completed']]
);

if ($result->getModifiedCount() > 0) {
    echo json_encode(['success' => true, 'message' => 'Winner updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update winner']);
}
?>
