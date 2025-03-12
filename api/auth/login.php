<?php

header("Content-Type: application/json");
error_log("Request method: " . $_SERVER['REQUEST_METHOD']);
error_log("Raw POST data: " . file_get_contents("php://input"));
error_log("POST array: " . json_encode($_POST));

// Start the session
session_start();

// Include the database connection file
require_once '../../config/db.php'; // Adjust the path if necessary

// Debug log to check if the login request was received
error_log("Login request received");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if email or password is empty
    if (empty($email) || empty($password)) {
        error_log("Missing email or password");
        echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
        exit;
    }

    // Query MongoDB to fetch the user by email
    $collection = $db->users;
    $user = $collection->findOne(['email' => $email]);

    if ($user) {
        error_log("User found: " . $user['email']);

        // **Check if the user is inactive**
        if (isset($user['is_active']) && $user['is_active'] === false) {
            error_log("Login attempt for inactive account: " . $email);
            echo json_encode(['status' => 'error', 'message' => 'Your account has been deactivated. Please contact support.']);
            exit;
        }

        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = (string)$user['_id']; // Store user ID
            $_SESSION['email'] = $user['email'];

            error_log("Login successful for: " . $user['email']);
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            error_log("Incorrect password for: $email");
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }
    } else {
        error_log("No user found with email: $email");
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
    }
} else {
    error_log("Invalid request method");
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>
