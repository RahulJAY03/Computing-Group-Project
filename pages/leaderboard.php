<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/leaderboard.css">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->

    
    <title>Document</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    
    
    <div class="container mt-4 leaderboard-container">

    <h2 class="mb-4">Leaderboard</h2>

    <!-- XP Progress Bar -->
    <div class="card p-3 mb-4">
        <h5>Your journey so far</h5>
        <div class="progress">
            <div class="progress-bar progress-xp" role="progressbar" style="width: 56%;" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100">
                556 XP
            </div>
        </div>
    </div>

 <!-- League & Achievements in Horizontal Layout -->
<div class="horizontal-cards">
    <!-- League Section -->
    <div class="card p-3 league-card">
        <h6>League</h6>
        <div class="horizontal-icons">
            <div class="icon-item">
                <i class="fas fa-trophy" style="color: gold;"></i>
                <span>Gold</span>
            </div>
            <div class="icon-item">
                <i class="fas fa-trophy" style="color: silver;"></i>
                <span>Silver</span>
            </div>
            <div class="icon-item">
                <i class="fas fa-trophy" style="color: #cd7f32;"></i>
                <span>Bronze</span>
            </div>
        </div>
    </div>

    <!-- Achievements Section -->
    <div class="card p-3 achievements-card">
        <h6>Achievements</h6>
        <div class="horizontal-icons">
            <div class="icon-item">
                <i class="fas fa-graduation-cap" style="color: #2ecc71;"></i>
                <span>Fast Learner</span>
            </div>
            <div class="icon-item">
                <i class="fas fa-star" style="color: #f39c12;"></i>
                <span>Top Contributor</span>
            </div>
            <div class="icon-item">
                <i class="fas fa-handshake" style="color: #8e44ad;"></i>
                <span>Challenger</span>
            </div>
        </div>
    </div>
</div>



    <!-- Leaderboard Table -->
    <table class="table leaderboard-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>XP</th>
                <th>Challenge</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="rank-badge gold-rank">1</span> </td>
                <td>Rahul JAY</td>
                <td>1000 XP</td>
                <td><button class="btn challenge-btn">Challenge</button></td>
            </tr>
            <tr>
                <td><span class="rank-badge silver-rank">2</span> </td>
                <td>Sara</td>
                <td>998 XP</td>
                <td><button class="btn challenge-btn">Challenge</button></td>
            </tr>
            <tr>
                <td><span class="rank-badge bronze-rank">3</span> </td>
                <td>Punchi Malith</td>
                <td>999 XP</td>
                <td><button class="btn challenge-btn">Challenge</button></td>
            </tr>
            <tr>
                <td><span class="rank-badge">4</span></td>
                <td>Soora Weera Gimhan</td>
                <td>997 XP</td>
                <td><button class="btn challenge-btn">Challenge</button></td>
            </tr>
            <tr>
                <td><span class="rank-badge">5</span></td>
                <td>Kudu Sunil (Ruchira)</td>
                <td>995 XP</td>
                <td><button class="btn challenge-btn">Challenge</button></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>

