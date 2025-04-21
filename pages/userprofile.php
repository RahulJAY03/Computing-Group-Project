<?php
session_start();
require_once '../config/db.php';

$user_email = $_SESSION['email'] ?? null;
$notes = [];

if ($user_email) {
    $notesCollection = $db->notes;
    $notesCursor = $notesCollection->find(['email' => $user_email]);
    foreach ($notesCursor as $note) {
        $notes[] = $note;
    }
}
$sessions = [];

if ($user_email) {
    $sessionCollection = $db->sessions;
    $sessionsCursor = $sessionCollection->find(['createdBy' => $user_email]);

    foreach ($sessionsCursor as $session) {
        $sessions[] = $session;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/userprofile.css">
    <link rel="stylesheet" href="../assets/css/profile-sections.css">
    <title>My Profile</title>
</head>
<body>

<?php
include '../includes/navbar.php';
include '../includes/sidebar.php';
include '../api/chatbot/Chatbot.php';

$collection = $db->users;
$user = $collection->findOne(["email" => $user_email]);
$profileImage = isset($user['profile_image']) ? "../" . $user['profile_image'] : "../assets/images/girl.png";
?>

<div class="container">
    <header>
        <div class="profile">
            <label for="profile-upload" class="profile-upload-label">
                <img id="profile-avatar" src="<?= $profileImage ?>" alt="User Avatar">
                <div class="overlay"><i class="fas fa-pencil"></i></div>
            </label>
            <input type="file" id="profile-upload" style="display: none;" accept="image/*">
            <h1 id="user-name">Loading...</h1>
        </div>

        <div class="settings">
            <button class="settings-btn" onclick="window.location.href='setting.php'"><i class="fas fa-cog"></i></button>
            <button class="settings-btn" id="logoutBtn"><i class="fas fa-sign-out-alt"></i></button>
        </div>
    </header>

    <section class="info-section">
        <div class="studies">
            <h2>My Studies</h2>
            <div class="study-details">
                <div class="study-item">
                    <img src="../assets/images/university-of-milan.png" alt="University">
                    <p id="user-university">Loading...</p>
                </div>
                <div class="study-item">
                    <img src="../assets/images/graduating-student.png" alt="Degree">
                    <p id="user-studyProgram">Loading...</p>
                </div>
                <div class="study-item">
                    <img src="../assets/images/calendar.png" alt="Graduation Date">
                    <p id="user-graduation">Loading...</p>
                </div>
            </div>
        </div>
        <div class="stats">
            <h2>My Stats</h2>
            <div class="stat-details">
                <div class="stat-item">
                    <img src="../assets/images/earn.png" alt="User Avatar">
                    <p>Credit Points: 0</p>
                </div>
                <div class="stat-item">
                    <img src="../assets/images/inbox.png" alt="User Avatar">
                    <p>Downloads/Views: 0</p>
                </div>
            </div>
        </div>
    </section>

    <!-- My Documents Section -->
    <section id="documents-section" class="section">
        <div class="section-header">
            <h2>My Documents</h2>
        </div>
        <div class="document-list">
            <?php if (empty($notes)): ?>
                <p>No documents uploaded yet.</p>
            <?php else: ?>
                <?php
                $icons = [
                    'pdf' => '../assets/images/pdf.png',
                    'doc' => '../assets/images/doc.png',
                    'docx' => '../assets/images/doc.png',
                    'zip' => '../assets/images/zip.png',
                    'jpg' => '../assets/images/img.png',
                    'jpeg' => '../assets/images/img.png',
                    'png' => '../assets/images/img.png',
                ];

                foreach ($notes as $note):
                    $title = htmlspecialchars($note['title']);
                    $desc = htmlspecialchars($note['description']);
                    $language = strtolower($note['language']);
                    $docType = strtoupper($note['doc_type']);
                    $originalPath = $note['file_path'];
                    $cleanPath = str_replace('../../', '', $originalPath);
                    $fixedFilePath = '/cgp-sara/' . $cleanPath;

                    $uploadDate = $note['created_at']->toDateTime()->format("d M Y");
                    $timestamp = $note['created_at']->toDateTime()->getTimestamp();
                    $extension = strtolower(pathinfo($note['file_name'], PATHINFO_EXTENSION));
                    $iconPath = $icons[$extension] ?? '../assets/images/default-doc.png';
                ?>
                    <div class="document-item" data-type="<?= $docType ?>" data-lang="<?= $language ?>" data-time="<?= $timestamp ?>">
                        <img src="<?= $iconPath ?>" alt="Doc Icon" class="doc-img">
                        <div class="document-info">
                            <h3><a href="<?= $fixedFilePath ?>" target="_blank"><?= $title ?></a></h3>
                            <p class="desc"><?= $desc ?></p>
                            <div class="metadata">
                                <span><?= $docType ?> | <?= ucfirst($language) ?></span><br>
                                <span>Uploaded on: <?= $uploadDate ?></span>
                            </div>
                            <div class="document-actions">
                                <a href="<?= $fixedFilePath ?>" class="download-btn" download><i class="bi bi-download"></i></a>
                                <a href="<?= $fixedFilePath ?>" target="_blank" class="view-btn"><i class="bi bi-eye"></i> View</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <!-- My Sessions Section -->
    <section id="sessions-section" class="section">
        <div class="section-header">
            <h2>My Sessions</h2>
        </div>
        <div class="sessions-grid" id="sessions-grid">
    <?php
        if (empty($sessions)) {
            echo "<p>You haven't hosted any sessions yet.</p>";
        } else {
            foreach ($sessions as $session) {
                $categoryId = isset($session['category']) ? (string)$session['category'] : null;
                $categoryName = isset($categoryNames[$categoryId]) ? $categoryNames[$categoryId] : 'Unknown Category';

                if (isset($session['date'])) {
                    $date = $session['date']->toDateTime();
                    $formattedDate = $date->format('d M Y');
                } else {
                    $formattedDate = 'N/A';
                }

                echo "<div class='session-card' data-category='$categoryName'>";
                echo "<h3 class='session-topic'>" . htmlspecialchars($session['topic']) . "</h3>";
                echo "<p><strong>Hosted by:</strong> " . htmlspecialchars($session['hostedBy']) . "</p>";
                echo "<p><strong>Duration:</strong> " . htmlspecialchars($session['duration']) . "</p>";
                echo "<p><strong>Date:</strong> " . $formattedDate . "</p>";
                echo "<p><strong>Time:</strong> " . date('h:i A', strtotime($session['time'])) . "</p>";
                echo "<button class='join-btn' onclick='window.open(\"" . htmlspecialchars($session['meetingLink']) . "\", \"_blank\")'>Join</button>";
                echo "</div>";
            }
        }
    ?>
</div>

    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/userProfile.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
