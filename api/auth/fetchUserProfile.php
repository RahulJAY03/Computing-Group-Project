<?php
// Include the database connection file
require_once '../../config/db.php';

session_start();

$email = $_SESSION['email'] ?? null; // Use email from session

if (!$email) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$collection = $db->users;
$user = $collection->findOne(["email" => $email]);

if (!$user) {
    echo json_encode(["error" => "User not found"]);
    exit;
}

// Set a default profile image if none exists
$profileImage = isset($user["profile_image"]) && !empty($user["profile_image"])
    ? "../" . $user["profile_image"]
    : "../assets/images/girl.png";

echo json_encode([
    "fullName" => $user["fullName"] ?? "",
    "university" => $user["university"] ?? "",
    "studyProgram" => $user["studyProgram"] ?? "",
  "graduationDate" => isset($user["graduationDate"]) ? $user["graduationDate"]->toDateTime()->format("d M Y") : "",

    "profile_image" => $profileImage // Add profile image
]);
?>
