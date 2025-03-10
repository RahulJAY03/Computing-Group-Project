<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['email'])) { // Change this to 'email'
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$email = $_SESSION['email']; // Update to match login.php

try {
    $user = $db->users->findOne(["email" => $email]); // Use $db->users

    if ($user) {
        echo json_encode(["xp" => $user['xp'] ?? 0]); 
    } else {
        echo json_encode(["error" => "User not found"]);
    }
} catch (Exception $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}

?>
