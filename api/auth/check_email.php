<?php
header('Content-Type: application/json');

try {
    require '../../vendor/autoload.php';
    
    // Get input data
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'] ?? '';
    
    // Basic validation
    if (empty($email)) {
        echo json_encode(['exists' => false]);
        exit;
    }
    
    // Connect to MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->thekuppiya;
    $users = $db->users;
    
    // Check if email exists
    $user = $users->findOne(['email' => $email]);
    
    // Return result
    echo json_encode(['exists' => ($user !== null)]);
    
} catch (Exception $e) {
    // Return error
    echo json_encode([
        'exists' => false,
        'error' => 'Database error'
    ]);
    
    // Log error
    error_log("Check Email Error: " . $e->getMessage());
}