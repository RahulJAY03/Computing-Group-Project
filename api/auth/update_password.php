<?php
header('Content-Type: application/json');

try {
    require '../../vendor/autoload.php';
    
    // Get input data
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    
    // Basic validation
    if (empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'error' => 'Email and password are required'
        ]);
        exit;
    }
    
    // Password validation
    if (strlen($password) < 8) {
        echo json_encode([
            'success' => false, 
            'error' => 'Password must be at least 8 characters'
        ]);
        exit;
    }
    
    // Connect to MongoDB
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->thekuppiya;
    $users = $db->users;
    
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Update user's password
    $result = $users->updateOne(
        ['email' => $email],
        ['$set' => ['password' => $hashedPassword]]
    );
    
    // Check if update was successful
    if ($result->getModifiedCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to update password'
        ]);
    }
    
} catch (Exception $e) {
    // Return error
    echo json_encode([
        'success' => false,
        'error' => 'System error'
    ]);
    
    // Log error
    error_log("Update Password Error: " . $e->getMessage());
}