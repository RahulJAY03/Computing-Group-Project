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
    include '../includes/navbar.php';  
    include '../includes/sidebar.php';  
?>

<div class="main-content">
  <div class="container">
    <div class="page-header">
      <h1 class="page-title"><i class="fas fa-trophy"></i> My Challenges</h1>
    
    </div>

    <div class="main-tabs">
      <button class="tab active" data-status="all"><i class="fas fa-layer-group"></i> All Challenges</button>
      <button class="tab" data-status="active"><i class="fas fa-fire"></i> Active</button>
      <button class="tab" data-status="completed"><i class="fas fa-check-circle"></i> Completed</button>
      <button class="tab" data-status="pending"><i class="fas fa-clock"></i> Pending</button>
    </div>

    <div class="card-group" id="challenge-cards">
      <!-- Dynamic challenges will be injected here -->
    </div>

    <div class="winner-container">
      <!-- Winner details will be dynamically injected here -->
    </div>
  </div>
</div>

<script src="../assets/js/mychallange.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
