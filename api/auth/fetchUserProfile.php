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

echo json_encode([
    "fullName" => $user["fullName"] ?? "",
    "university" => $user["university"] ?? "",
    "studyProgram" => $user["studyProgram"] ?? "",
    "graduationDate" => isset($user["graduationDate"]) ? date("Y", strtotime($user["graduationDate"])) : ""
]);
?>
