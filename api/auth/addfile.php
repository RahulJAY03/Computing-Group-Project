<?php
require '../../config/db.php'; // Include database connection
session_start();

use MongoDB\Client;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

$mongoUri = "mongodb://localhost:27017";

try {
    // Create a new MongoDB client
    $client = new Client($mongoUri);

    // Select the databases
    $database = $client->selectDatabase('thekuppiya');
    $usersCollection = $database->selectCollection('users');
    $modulesCollection = $database->selectCollection('modules');
    $notesCollection = $database->selectCollection('notes');

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "User not logged in!";
        exit;
    }

    $loggedInEmail = $_SESSION['email'];

    // Find the userId based on the email
    $user = $usersCollection->findOne(['email' => $loggedInEmail]);
    if (!$user) {
        echo "User not found!";
        exit;
    }
    $userId = $user['_id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validate required fields
        if (empty($_FILES['file']['name']) || empty($_POST['category']) || empty($_POST['module']) ||
            empty($_POST['documentType']) || empty($_POST['language']) || empty($_POST['description'])) {
            echo "All fields are required!";
            exit;
        }

        // Find moduleId based on module name
        $module = $modulesCollection->findOne(['name' => $_POST['module']]);
        if (!$module) {
            echo "Module not found!";
            exit;
        }
        $moduleId = $module['_id'];

        // File upload handling
        $targetDir = "../../uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Allowed file types
        $allowedTypes = ["pdf", "doc", "docx", "jpeg", "png", "xls", "zip"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($fileType, $allowedTypes)) {
            echo "Invalid file type! Only PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP allowed.";
            exit;
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            echo "Error uploading file.";
            exit;
        }

        // Insert data into MongoDB
        $document = [
            'title' => $fileName,
            'description' => $_POST['description'],
            'language' => $_POST['language'],
            'documentType' => $_POST['documentType'],
            'filePath' => $targetFilePath,
            'uploadDate' => new UTCDateTime(time() * 1000),
            'userId' => new ObjectId($userId),
            'moduleId' => new ObjectId($moduleId),
            'category' => $_POST['category'],
            'module' => $_POST['module']
        ];

        $result = $notesCollection->insertOne($document);

        if ($result->getInsertedCount() === 1) {
            echo "File uploaded and data inserted successfully!";
        } else {
            echo "Failed to insert document.";
        }
    } else {
        echo "Invalid request.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
