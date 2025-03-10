<?php
require '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Email from frontend
    $fullName = $_POST['fullName']; // New addition
    $gender = $_POST['gender'];
    $university = $_POST['university'];
    $studyProgram = $_POST['studyProgram'];
    $graduationDate = $_POST['graduationDate'];

    // Ensure all required fields are present
    if (!$email || !$fullName || !$gender || !$university || !$studyProgram || !$graduationDate) {
        echo json_encode(["status" => "error", "message" => "Missing required fields."]);
        exit;
    }

    // Update user profile
    $usersCollection = $db->users;
    $updateResult = $usersCollection->updateOne(
        ["email" => $email],
        ['$set' => [
            "fullName" => $fullName, // Add full name
            "gender" => $gender,
            "university" => $university,
            "studyProgram" => $studyProgram,
            "graduationDate" => new MongoDB\BSON\UTCDateTime(strtotime($graduationDate) * 1000)
        ]]
    );

    if ($updateResult->getModifiedCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Profile updated successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update profile."]);
    }
}
?>
