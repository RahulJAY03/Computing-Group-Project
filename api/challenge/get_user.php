<?php
// Including necessary files for MongoDB connection and error handling

require_once '../../config/db.php';  // Ensure this contains your MongoDB connection code

// Get the winnerId from the query string (passed as a URL parameter)
$winnerId = isset($_GET['id']) ? $_GET['id'] : null;

// Check if the winnerId is provided
if (!$winnerId) {
    echo json_encode(['success' => false, 'message' => 'No winner ID provided']);
    exit;
}

// Access the MongoDB collection for users
$usersCollection = $db->users;  // Assuming the collection is named 'users'

// Query the user document based on the winnerId
try {
    $user = $usersCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($winnerId)]);

    if ($user) {
        // Ensure the 'fullName' field exists in the user document before accessing it
        $fullName = isset($user['fullName']) ? $user['fullName'] : 'Unknown Name';

        // Define the base URL for the application
        $baseUrl = "http://localhost/Cgp-sara/";

        // Prepend the base URL to the profile_image path
        $profileImage = isset($user['profile_image']) ? $baseUrl . $user['profile_image'] : $baseUrl . 'uploads/profile_pictures/default.jpg';

        // Return the user data, excluding the MongoDB ID (_id field) in the response
        $userData = [
            'name' => $fullName, 
            'profile_image' => $profileImage, 
            'xp' => $user['xp']  // Assuming 'xp' is a field in the user document
        ];
        echo json_encode(['success' => true, 'user' => $userData]);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
?>
