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

    // Check if the date is in a valid format (Y-m-d)
    if ($date && !DateTime::createFromFormat('Y-m-d', $date)) {
        echo "Invalid date format. Please use the format YYYY-MM-DD.";
        exit();
    }

    // Convert date to MongoDB Date format
    $timestamp = strtotime($date);
    if ($timestamp === false) {
        echo "Invalid date. Please check the date format.";
        exit();
    }
    $mongoDate = new MongoDB\BSON\UTCDateTime($timestamp * 1000);

    try {
        $db->sessions->insertOne([
            'topic' => $topic,
            'hostedBy' => $hostedBy,
            'duration' => $duration,
            'date' => $mongoDate,
            'time' => $time,
            'category' => $category,
            'meetingLink' => $meetingLink,
            'participants' => [] // Empty initially
        ]);

        header("Location: ../../pages/sessionList.php?success=1");
        exit();
    } catch (Exception $e) {
        echo "Error saving session: " . $e->getMessage();
    }
}
?>
