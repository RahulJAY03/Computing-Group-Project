<?php
require_once '../../config/db.php';
session_start();

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['text'] ?? '');
    $postId = $_POST['postId'] ?? '';

    if (empty($text) || empty($postId)) {
        echo json_encode(['status' => 'error', 'message' => 'Missing comment or post ID']);
        exit;
    }

    $email = $_SESSION['email'];
    $user = $db->users->findOne(['email' => $email]);

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
    }

    $comment = [
        'text' => $text,
        'postId' => new MongoDB\BSON\ObjectId($postId),
        'userId' => $user->_id,
        'commentDate' => new MongoDB\BSON\UTCDateTime()
    ];

    $db->discussionComments->insertOne($comment);

    echo json_encode(['status' => 'success', 'message' => 'Comment added']);
    exit;
}
