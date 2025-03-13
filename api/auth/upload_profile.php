<?php
require_once '../../config/db.php'; // Adjust based on project structure
session_start();

if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_image"])) {
    $targetDir = "../../uploads/profile_pictures/";
    
    // Generate a unique filename to avoid overwriting
    $fileExtension = pathinfo($_FILES["profile_image"]["name"], PATHINFO_EXTENSION);
    $uniqueFileName = uniqid("profile_", true) . "." . $fileExtension;
    $targetFilePath = $targetDir . $uniqueFileName;

    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFilePath)) {
        // Save relative path in database
        $profileImagePath = "uploads/profile_pictures/" . $uniqueFileName;

        // Get MongoDB collection
        $usersCollection = $db->users;
        
        // Update user's profile image
        $updateResult = $usersCollection->updateOne(
            ["email" => $email],
            ['$set' => ["profile_image" => $profileImagePath]]
        );

        if ($updateResult->getModifiedCount() > 0) {
            echo json_encode(["success" => true, "message" => "Profile updated", "path" => $profileImagePath]);
        } else {
            echo json_encode(["success" => false, "message" => "Database update failed"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "File upload failed"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
