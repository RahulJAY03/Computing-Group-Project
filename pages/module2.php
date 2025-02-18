<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/module2.css">
    <title>Sessions</title>
</head>
<body>
    <?php
        include '../includes/navbar.php';
        include '../includes/sidebar.php';
    ?>
    
    <div class="container">
        <h2 class="page-title">IT Section Modules</h2>
        <div class="modules-grid">
            <button class="module-item active" onclick="window.location.href='module3.php'">Database Management System</button>
            <button class="module-item">Introduction to Computer Science</button>
            <button class="module-item">Programming in C</button>
            <button class="module-item">Computer Architecture</button>
            <button class="module-item">Introduction to IOT</button>
            <button class="module-item">Mobile Application Development</button>
            <button class="module-item">Mathematics for Computing</button>
            <button class="module-item">Computer Networks</button>
            <button class="module-item">Information Management and Retrieval</button>
            <button class="module-item">Algorithms and Data Structures</button>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>