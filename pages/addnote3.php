<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Complete</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/leaderboard.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addnote3.css">
    <script src="../assets/js/addnote3.js"></script>
    <style>
       
    </style>
</head>
<body>

<?php
        include '../includes/navbar.php';  
        include '../includes/sidebar.php'; 
    ?>
<div class="alignmiddle">
    <div class="container-box">
        <h2><strong>Upload complete!</strong></h2>
        <p><strong>DOCUMENTS: 1/1</strong></p>
        
        <div class="file-box">
            <div>
                <strong style="color: green;">✔ Upload complete</strong>
                <p>images.jpg<br>File size: 10 KB</p>
            </div>
            <a href="#" class="text-decoration-none" style="color: green;">Open document →</a>
        </div>
        
        <div class="buttons">
            <button class="btn btn-success btn-custom">Upload more files</button>
            <button class="btn btn-dark btn-custom btn-glow" id="proceedButton">Back to Home</button>
        </div>
    </div>
</div>

</body>
</html>