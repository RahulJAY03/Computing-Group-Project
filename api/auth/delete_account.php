<?php
session_start();
require_once '../../config/db.php';
 // Adjust path if needed

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($_SESSION['email'])) {
        echo json_encode(["success" => false, "message" => "User not logged in"]);
        exit;
    }

    $email = $_SESSION['email'];
    $collection = $db->users; // Ensure correct collection name

    $updateResult = $collection->updateOne(
        ["email" => $email],
        ['$set' => ["is_active" => false]]
    );

    if ($updateResult->getModifiedCount() > 0) {
        session_unset();
        session_destroy();
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to deactivate account"]);
    }
}
?>
