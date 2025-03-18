<?php
require '../../config/db.php'; // Database connection

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $token = $data['token'] ?? '';

    if (!$token) {
        echo json_encode(["status" => "error", "message" => "Missing token"]);
        exit;
    }

    // Verify Google Token
    $client_id = "53507074052-dr4sgdektjv7u13rhe3b5ob636qol59m.apps.googleusercontent.com"; // Replace with actual Client ID
    $googleUrl = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $token;
    $response = file_get_contents($googleUrl);
    $payload = json_decode($response, true);

    if (!isset($payload['email']) || $payload['aud'] !== $client_id) {
        echo json_encode(["status" => "error", "message" => "Invalid Google token"]);
        exit;
    }

    $email = strtolower($payload['email']);
    $usersCollection = $db->users;

    // Check if user exists
    $user = $usersCollection->findOne(["email" => $email]);

    if (!$user) {
        // Register new user with Google account
        $newUser = [
            "email" => $email,
            "google_id" => $payload['sub'], // Unique Google ID
            "xp" => 0,
            "achievements" => [],
            "created_at" => new MongoDB\BSON\UTCDateTime(),
            "profile_image" => $payload['picture'] ?? "uploads/profile_pictures/default.png",
            "uni" => null, // Required details not filled yet
            "study_program" => null,
            "gender" => null
        ];
        $insertResult = $usersCollection->insertOne($newUser);
        $user = $newUser;
    }

    // Store session
    session_start();
    $_SESSION['user_id'] = (string)$user['_id'];
    $_SESSION['email'] = $user['email'];

    // Check if user needs to complete profile
    if (empty($user['uni']) || empty($user['study_program']) || empty($user['gender'])) {
        $redirect = "/cgp-sara/pages/signup-details.php"; // Redirect to details page
    } else {
        $redirect = "/cgp-sara/pages/index.php"; // Redirect to home
    }

    echo json_encode(["status" => "success", "message" => "Google login successful", "redirect" => $redirect]);
}


?>
