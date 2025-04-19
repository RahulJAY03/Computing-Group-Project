<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Challenges</title>
  <link rel="stylesheet" href="../assets/css/mychallange.css" />
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

  <div class="main-content">
    <div class="container">
      <div class="page-header">
        <h1 class="page-title"><i class="fas fa-trophy"></i> My Challenges</h1>
        <button class="new-challenge-btn"><i class="fas fa-plus"></i> New Challenge</button>
      </div>

      <div class="main-tabs">
        <button class="tab active"><i class="fas fa-layer-group"></i> All Challenges</button>
        <button class="tab"><i class="fas fa-fire"></i> Active</button>
        <button class="tab"><i class="fas fa-check-circle"></i> Completed</button>
        <button class="tab"><i class="fas fa-clock"></i> Pending</button>
      </div>

    

      <div class="card-group">
        <!-- Active Challenge 1 -->
        <div class="card active">
          <span class="status active">Active</span>
          <div class="top-line">
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Alex" />
              <p>Alex Morgan<span class="xp">2500 XP</span></p>
            </div>
            <div class="vs-container">
              <span class="vs">VS</span>
            </div>
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Sarah" />
              <p>Sarah Wilson<span class="xp">2300 XP</span></p>
            </div>
          </div>
          <div class="info">
            <div class="time-left">
              <i class="fas fa-hourglass-half"></i>
              <p>23h 45m left</p>
            </div>
            <div class="start-date">
              <i class="far fa-calendar-alt"></i>
              <p>Started: May 15, 2024</p>
            </div>
          </div>
          <div class="progress-container">
            <div class="progress-label">
              <span>Progress</span>
              <span>80%</span>
            </div>
            <div class="progress-bar"><div style="width: 80%;"></div></div>
          </div>
        </div>

        <!-- Active Challenge 2 -->
        <div class="card active">
          <span class="status active">Active</span>
          <div class="top-line">
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="John" />
              <p>John Davis<span class="xp">3200 XP</span></p>
            </div>
            <div class="vs-container">
              <span class="vs">VS</span>
            </div>
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Mike" />
              <p>Mike Chen<span class="xp">3100 XP</span></p>
            </div>
          </div>
          <div class="info">
            <div class="time-left">
              <i class="fas fa-hourglass-half"></i>
              <p>12h 30m left</p>
            </div>
            <div class="start-date">
              <i class="far fa-calendar-alt"></i>
              <p>Started: May 14, 2024</p>
            </div>
          </div>
          <div class="progress-container">
            <div class="progress-label">
              <span>Progress</span>
              <span>60%</span>
            </div>
            <div class="progress-bar"><div style="width: 60%;"></div></div>
          </div>
        </div>

        <!-- Pending Challenge -->
        <div class="card pending">
          <span class="status pending">Pending</span>
          <div class="top-line">
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Emma" />
              <p>Emma Thompson<span class="xp">1800 XP</span></p>
            </div>
            <div class="vs-container">
              <span class="vs">VS</span>
            </div>
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="David" />
              <p>David Kim<span class="xp">1900 XP</span></p>
            </div>
          </div>
          <div class="starting">
            <i class="far fa-calendar-plus"></i>
            <p>Starting: May 16, 2024</p>
          </div>
          <div class="buttons">
            <button class="accept"><i class="fas fa-check"></i> Accept</button>
            <button class="decline"><i class="fas fa-times"></i> Decline</button>
          </div>
        </div>

        <!-- Completed Challenge -->
        <div class="card completed">
          <span class="status completed">Completed</span>
          <div class="top-line">
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Lisa" />
              <p>Lisa Anderson<span class="xp">4200 XP</span></p>
            </div>
            <div class="vs-container">
              <span class="vs">VS</span>
            </div>
            <div class="player">
              <img src="https://via.placeholder.com/50" alt="Tom" />
              <p>Tom Wilson<span class="xp">4000 XP</span></p>
            </div>
          </div>
          <div class="result">
            <i class="fas fa-trophy"></i>
            <p>Lisa Anderson Won! <span class="xp-gain">+150 XP</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="../assets/js/mychallange.js"></script>
  <script src="../assets/js/script.js"></script>
</body>
</html>
