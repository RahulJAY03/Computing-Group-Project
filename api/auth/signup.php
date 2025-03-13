<?php
require '../../config/db.php'; // Connect to MongoDB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die(json_encode(["status" => "error", "message" => "Invalid email format"]));
    }

    // Check password length
    if (strlen($password) < 6) {
        die(json_encode(["status" => "error", "message" => "Password must be at least 6 characters"]));
    }

    // Check if user already exists
    $usersCollection = $db->users;
    $existingUser = $usersCollection->findOne(['email' => $email]);

    if ($existingUser) {
        die(json_encode(["status" => "error", "message" => "Email already registered"]));
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Default profile image
    $defaultProfileImage = "uploads/profile_pictures/default.png";

    // Insert user with profile_image field
    $insertResult = $usersCollection->insertOne([
        "email" => $email,
        "password" => $hashedPassword,
        "xp" => 0, // Default XP
        "achievements" => [],
        "created_at" => new MongoDB\BSON\UTCDateTime(),
        "profile_image" => $defaultProfileImage // Add this field
    ]);

    // Success response
    echo json_encode(["status" => "success", "message" => "Signup successful!"]);
}
?>

