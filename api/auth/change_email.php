<?php
session_start();
require_once '../../config/db.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$email = $_SESSION['email'];
$currentPassword = $data["currentPassword"];
$newEmail = $data["newEmail"];

$collection = $db->users;
$user = $collection->findOne(["email" => $email]);

if (!$user || !password_verify($currentPassword, $user["password"])) {
    echo json_encode(["success" => false, "message" => "Incorrect password"]);
    exit;
}

// Check if new email is already in use
$existingUser = $collection->findOne(["email" => $newEmail]);
if ($existingUser) {
    echo json_encode(["success" => false, "message" => "Email already in use"]);
    exit;
}

// Update email
$updateResult = $collection->updateOne(
    ["email" => $email],
    ['$set' => ["email" => $newEmail]]
);

if ($updateResult->getModifiedCount() > 0) {
    $_SESSION['email'] = $newEmail;
    echo json_encode(["success" => true, "message" => "Email updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update email"]);
}
?>

