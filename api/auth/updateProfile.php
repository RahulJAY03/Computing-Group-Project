<?php
require '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Assuming we send this from frontend
    $gender = $_POST['gender'];
    $university = $_POST['university'];
    $studyProgram = $_POST['studyProgram'];
    $graduationDate = $_POST['graduationDate'];

    // Update user profile
    $usersCollection = $db->users;
    $updateResult = $usersCollection->updateOne(
        ["email" => $email],
        ['$set' => [
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
