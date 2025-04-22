<?php
session_start();
require_once '../../config/db.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$challengeId = $input['challengeId'] ?? null;

if (!$challengeId) {
    echo json_encode(['success' => false, 'message' => 'Missing challenge ID']);
    exit;
}

try {
    $result = $db->xpChallenges->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($challengeId)],
        [
            '$set' => [
                'status' => 'active',
                'startTime' => new MongoDB\BSON\UTCDateTime()
            ]
        ]
    );

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
