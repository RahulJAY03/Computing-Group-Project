<?php
require_once '../config/db.php';
session_start();

// Assume user email is stored in session
$email = $_SESSION['email'] ?? null;

$fullName = "User";
$xp = 0;

if ($email) {
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $db = $client->thekuppiya;
    $usersCollection = $db->users;

    $user = $usersCollection->findOne(['email' => $email]);

    if ($user) {
        $fullName = $user['fullName'] ?? "User";
        $xp = $user['xp'] ?? 0;
    }
}

$today = date("F j, Y"); // Example: April 21, 2025
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/index.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>

<div class="content-wrapper">
<div class="hero">
  <div class="hero-content">
    <h1>Welcome back, <?= htmlspecialchars($fullName) ?>!</h1>
    <p>Here's what's happening today <span class="date"><?= $today ?></span></p>
  </div>
  <div class="quick-stats">
    <div class="stat-card">
      <i class="fas fa-book-open"></i>
      <div class="stat-info">
        <span><?= $xp ?></span>
        <p>XP Points</p>
      </div>
    </div>
  </div>
</div>

  <div class="main-content">
    <div class="notes-section">
      <div class="notes-header">
        <h2><i class="fas fa-file-alt"></i> Recommended Notes</h2>
        <a href="#">Explore More Notes <i class="fas fa-arrow-right"></i></a>
      </div>
      <div class="notes-grid">
        <div class="note-card">
          <div class="note-tag">Data Science</div>
          <h3>Introduction to Data Structures</h3>
          <p>Learn the fundamentals of data structures and their implementations</p>
          <div class="note-meta">
            <span><i class="far fa-clock"></i> Updated 2 days ago</span>
            <span><i class="far fa-eye"></i> 234 views</span>
          </div>
          <div class="actions">
            <button class="view"><i class="far fa-eye"></i> View</button>
            <button class="download"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
        <div class="note-card">
          <div class="note-tag">Algorithms</div>
          <h3>Advanced Algorithm Analysis</h3>
          <p>Deep dive into complexity analysis and optimization techniques</p>
          <div class="note-meta">
            <span><i class="far fa-clock"></i> Updated 5 days ago</span>
            <span><i class="far fa-eye"></i> 187 views</span>
          </div>
          <div class="actions">
            <button class="view"><i class="far fa-eye"></i> View</button>
            <button class="download"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
        <!-- New Note Card -->
        <div class="note-card">
          <div class="note-tag">Machine Learning</div>
          <h3>Neural Networks Fundamentals</h3>
          <p>Explore the core concepts of neural networks and deep learning architectures</p>
          <div class="note-meta">
            <span><i class="far fa-clock"></i> Updated today</span>
            <span><i class="far fa-eye"></i> 412 views</span>
          </div>
          <div class="actions">
            <button class="view"><i class="far fa-eye"></i> View</button>
            <button class="download"><i class="fas fa-download"></i> Download</button>
          </div>
        </div>
      </div>
    </div>

    <div class="sessions-section">
      <div class="sessions-header">
        <h2><i class="fas fa-chalkboard-teacher"></i> Suggested Sessions</h2>
        <a href="#">View All <i class="fas fa-arrow-right"></i></a>
      </div>
   
    </div>
  </div>
</div>


<script>

  // Load Recommended Notes
  fetch('../api/auth/getRecommendedNotes.php')
    .then(res => res.text())
    .then(html => {
      document.querySelector('.notes-grid').innerHTML = html;
    });

  // Load Suggested Sessions
  fetch('../api/auth/getTodaySessions.php')
    .then(res => res.text())
    .then(html => {
      document.querySelector('.sessions-section').innerHTML += html;
    });
</script>

  <script src="dashboard.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>
