<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once '../../config/db.php'; 

require '../../vendor/autoload.php'; // Include MongoDB library
$client = new MongoDB\Client("mongodb://localhost:27017");
$db = $client->thekuppiya; 

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['email'])) {
        http_response_code(401);
        echo json_encode(["success" => false, "error" => "User not logged in"]);
        exit;
    }

    $email = $_SESSION['email'];

    $uploadsDir = "../../uploads/notes/";
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0755, true); // Secure directory creation
    }

    // File Handling
    if (!isset($_FILES["file"])) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "No file uploaded"]);
        exit;
    }

    $fileName = basename($_FILES["file"]["name"]);
    $fileTmpName = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];
    $allowedTypes = ['pdf', 'doc', 'docx', 'jpeg', 'png', 'xls', 'zip'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowedTypes)) {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Invalid file type"]);
        exit;
    }

    if ($fileSize > 100 * 1024 * 1024) { // 100MB Limit
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "File too large"]);
        exit;
    }

    // Generate a unique file name to avoid overwriting
    $newFileName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
    $filePath = $uploadsDir . $newFileName;

    if (move_uploaded_file($fileTmpName, $filePath)) {
        // Store Data in MongoDB
        $collection = $db->notes;
        $insertResult = $collection->insertOne([
            "email" => $email,
            "file_name" => $fileName,
            "file_path" => $filePath,
            // "category" => $_POST['category'] ?? "",
            // "module" => $_POST['module'] ?? "",
            "moduleId" => $_POST['moduleId'] ?? "",
            "doc_type" => $_POST['docType'] ?? "",
            "language" => $_POST['language'] ?? "",
            "title" => $_POST['title'] ?? "",
            "description" => $_POST['description'] ?? "",
            "totalLikes" => 0, // 👈 Initialize likes count
            "created_at" => new MongoDB\BSON\UTCDateTime()
        ]);
        

        if ($insertResult->getInsertedCount() > 0) {
            // **Update user's XP in MongoDB**
            $usersCollection = $db->users;
            $updateXP = $usersCollection->updateOne(
                ["email" => $email],
                ['$inc' => ["xp" => 10]] // Increase XP by 10
            );

            if ($updateXP->getModifiedCount() > 0) {
                http_response_code(201);
                echo json_encode(["success" => true, "message" => "File uploaded successfully! XP increased by 10."]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "error" => "File uploaded, but XP update failed."]);
            }
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "error" => "Database insert failed"]);
        }
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "error" => "File upload failed"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
