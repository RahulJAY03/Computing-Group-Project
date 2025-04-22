<?php
require_once '../../config/db.php';
header('Content-Type: application/json');

$challengeId = $_POST['challengeId'] ?? null;
if (!$challengeId) {
    echo json_encode(['success' => false, 'message' => 'Missing challenge ID']);
    exit;
}

$challenge = $db->xpChallenges->findOne(['_id' => new MongoDB\BSON\ObjectId($challengeId)]);
if (!$challenge) {
    echo json_encode(['success' => false, 'message' => 'Challenge not found']);
    exit;
}

$challenger = $db->users->findOne(['_id' => $challenge['challengerId']]);
$challenged = $db->users->findOne(['_id' => $challenge['challengedId']]);

if (!$challenger || !$challenged) {
    echo json_encode(['success' => false, 'message' => 'User data incomplete']);
    exit;
}

$challengerXP = $challenger['xp'] ?? 0;
$challengedXP = $challenged['xp'] ?? 0;
$winnerId = null;

if ($challengerXP > $challengedXP) {
    $winnerId = $challenge['challengerId'];
} else if ($challengedXP > $challengerXP) {
    $winnerId = $challenge['challengedId'];
}

// Update challenge
$update = [
    '$set' => [
        'status' => 'completed',
        'winnerId' => $winnerId
    ]
];
$db->xpChallenges->updateOne(['_id' => new MongoDB\BSON\ObjectId($challengeId)], $update);

echo json_encode(['success' => true, 'message' => 'Challenge marked as completed']);
