<?php
session_start();
require_once '../../config/db.php';

if (!isset($_SESSION['email'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$email = $_SESSION['email'];

try {
    $user = $db->users->findOne(['email' => $email]);

    $avatar = isset($user['profile_image']) && !empty($user['profile_image'])
        ? '/Cgp-sara/' . $user['profile_image']
        : '/Cgp-sara/uploads/profile_pictures/default.png';

    echo json_encode(['profile_image' => $avatar]);
} catch (Exception $e) {
    echo json_encode(['profile_image' => '/Cgp-sara/uploads/profile_pictures/default.png']);
}
?>
