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
      <h1>Welcome back, John!</h1>
      <p>Here's what's happening today <span class="date">April 19, 2025</span></p>
    </div>
    <div class="quick-stats">
      <div class="stat-card">
        <i class="fas fa-book-open"></i>
        <div class="stat-info">
          <span>540</span>
          <p>XP Points</p>
        </div>
      </div>
      <div class="stat-card">
        <i class="fas fa-fire"></i>
        <div class="stat-info">
          <span>12</span>
          <p>Day Streak</p>
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
      <div class="session-card">
        <div class="session-time">
          <span class="time">2:00 PM</span>
          <span class="day">Today</span>
        </div>
        <div class="session-info">
          <h4>Advanced Python Programming</h4>
          <p><i class="fas fa-user-tie"></i> Dr. Sarah Wilson</p>
          <div class="session-participants">
            <div class="avatars">
              <img src="https://i.pravatar.cc/150?img=1" alt="Participant">
              <img src="https://i.pravatar.cc/150?img=2" alt="Participant">
              <img src="https://i.pravatar.cc/150?img=3" alt="Participant">
            </div>
            <span>+12 joined</span>
          </div>
        </div>
        <button class="join">Join Now</button>
      </div>
      <div class="session-card">
        <div class="session-time">
          <span class="time">10:00 AM</span>
          <span class="day">Tomorrow</span>
        </div>
        <div class="session-info">
          <h4>Web Development Workshop</h4>
          <p><i class="fas fa-user-tie"></i> Mike Johnson</p>
          <div class="session-participants">
            <div class="avatars">
              <img src="https://i.pravatar.cc/150?img=4" alt="Participant">
              <img src="https://i.pravatar.cc/150?img=5" alt="Participant">
            </div>
            <span>+8 joined</span>
          </div>
        </div>
        <button class="join">Join Now</button>
      </div>
    </div>
  </div>
</div>

  <script src="dashboard.js"></script>
  <script src="../assets/js/script.js"></script>
</body>

</html>
