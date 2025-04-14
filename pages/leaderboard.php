<?php
session_start();
require_once '../config/db.php'; // Ensure this path is correct
$currentUserEmail = $_SESSION['email'] ?? null;
if (!$currentUserEmail) {
    // Handle the case where the user is not logged in
    echo "User not logged in.";
    exit;
}
$collection = $db->users;

// Fetch users sorted by XP descending
$users = $collection->find([], [
    'sort' => ['xp' => -1]
]);

$rank = 1; // Initialize rank counter
$collection = $db->users;
$usersCursor = $collection->find([], ['sort' => ['xp' => -1]]);
$users = iterator_to_array($usersCursor);

$currentUserXP = 0;

foreach ($users as $user) {
    if ($user['email'] === $currentUserEmail) {
        $currentUserXP = $user['xp'] ?? 0;
        break;
    }
}

// Cap XP shown in the progress bar at 100
$xpDisplay = min(100, $currentUserXP);

?>

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
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>
    
    
    <div class="container mt-4 leaderboard-container">

    <h2 class="mb-4">Leaderboard</h2>

    <!-- XP Progress Bar -->
    <div class="card p-3 mb-4">
    <h5>Your journey so far</h5>
    <div class="progress">
        <div class="progress-bar progress-xp" role="progressbar"
            style="width: <?= $xpDisplay ?>%;" 
            aria-valuenow="<?= $xpDisplay ?>" aria-valuemin="0" aria-valuemax="100">
            <?= $currentUserXP ?> XP
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
<?php foreach ($users as $user): ?>
    <tr>
        <td>
            <span class="rank-badge 
                <?php 
                    if ($rank == 1) echo 'gold-rank'; 
                    elseif ($rank == 2) echo 'silver-rank'; 
                    elseif ($rank == 3) echo 'bronze-rank'; 
                ?>">
                <?= $rank ?>
            </span>
        </td>
        <td><?= htmlspecialchars($user['fullName']) ?></td>
        <td><?= $user['xp'] ?> XP</td>
        <td><button class="btn challenge-btn">Challenge</button></td>
    </tr>
    <?php $rank++; ?>
<?php endforeach; ?>
</tbody>

    </table>
</div>


<script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

