<?php
require_once '../../config/db.php'; // Database connection
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit;
}

// Fetch user information
$userId = $_SESSION['email'];  // Get the email from the session
$content = trim($_POST['content'] ?? '');  // Post content
$moduleId = $_POST['moduleId'] ?? '';  // Module ID

// Validate content and moduleId
if (empty($content)) {
    echo json_encode(['status' => 'error', 'message' => 'Post content cannot be empty.']);
    exit;
}

if (empty($moduleId)) {
    echo json_encode(['status' => 'error', 'message' => 'Module ID cannot be empty.']);
    exit;
}

// Fetch user data based on email
$user = $db->users->findOne(['email' => $userId]);

if (!$user) {
    echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    exit;
}

// Convert moduleId to ObjectId
try {
    $moduleObjectId = new MongoDB\BSON\ObjectId($moduleId);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Module ID.']);
    exit;
}

// Insert post into the database
try {
    $insertResult = $db->discussionPosts->insertOne([
        'userId' => $user['_id'],  // Use the actual MongoDB user _id
        'content' => $content,
        'moduleId' => $moduleObjectId,
        'created_at' => new MongoDB\BSON\UTCDateTime(),  // Timestamp for the post
    ]);

    if ($insertResult->getInsertedCount() === 1) {
        echo json_encode(['status' => 'success', 'message' => 'Post created successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create post.']);
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'MongoDB Error: ' . $e->getMessage()]);
}
?>
