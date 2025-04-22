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
    $db->xpChallenges->deleteOne(['_id' => new MongoDB\BSON\ObjectId($challengeId)]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
