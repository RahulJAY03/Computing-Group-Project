<?php
require_once '../../config/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = $_POST['topic'] ?? '';
    $hostedBy = $_POST['hosted'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $category = $_POST['category'] ?? '';
    $meetingLink = $_POST['meetingLink'] ?? '';

    // Get the email of the logged-in user
    $createdBy = $_SESSION['email'] ?? null;

    if (!$createdBy) {
        echo "User not authenticated. Please log in.";
        exit();
    }

    // Validate date format
    if ($date && !DateTime::createFromFormat('Y-m-d', $date)) {
        echo "Invalid date format. Please use the format YYYY-MM-DD.";
        exit();
    }

    // Convert to MongoDB UTCDateTime
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        echo "Invalid date. Please check the date format.";
        exit();
    }
    $mongoDate = new MongoDB\BSON\UTCDateTime($timestamp * 1000);

    try {
        // Insert session
        $db->sessions->insertOne([
            'topic' => $topic,
            'hostedBy' => $hostedBy,
            'duration' => $duration,
            'date' => $mongoDate,
            'time' => $time,
            'category' => $category,
            'meetingLink' => $meetingLink,
            'participants' => [],
            'createdBy' => $createdBy
        ]);

        // Increment XP by 10 for the user who created the session
        $db->users->updateOne(
            ['email' => $createdBy],
            ['$inc' => ['xp' => 10]]
        );

        // Redirect after success
        header("Location: http://localhost/cgp-sara/pages/sessions.php?success=1");
        exit();
    } catch (Exception $e) {
        echo "Error saving session: " . $e->getMessage();
    }
}
?>
