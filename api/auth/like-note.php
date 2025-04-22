<?php
session_start();
require_once '../../config/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['email']) || !isset($_POST['noteId'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized or missing data']);
    exit;
}

$userId = $_SESSION['email'];
$noteId = $_POST['noteId'];

$likesCollection = $db->likes;
$notesCollection = $db->notes;

// Check if like exists
$existing = $likesCollection->findOne([
    'userId' => $userId,
    'noteId' => $noteId
]);

if ($existing) {
    // Unlike
    $likesCollection->deleteOne(['_id' => $existing->_id]);
    $liked = false;
} else {
    // Like
    $likesCollection->insertOne([
        'userId' => $userId,
        'noteId' => $noteId
    ]);
    $liked = true;
}

// Recount total likes
$totalLikes = $likesCollection->countDocuments(['noteId' => $noteId]);

// Update note with new totalLikes
$notesCollection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectId($noteId)],
    ['$set' => ['totalLikes' => $totalLikes]]
);

echo json_encode([
    'status' => 'success',
    'liked' => $liked,
    'totalLikes' => $totalLikes
]);
