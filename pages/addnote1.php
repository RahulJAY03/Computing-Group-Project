<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addnote.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <title>Add Notes</title>
</head>
<body>

    <?php
        include '../includes/navbar.php';  
        include '../includes/sidebar.php'; 
    ?>

<div class="green_center_box">
        <h2>Select your files</h2>
        <h6>Earn <img src="../assets/images/coin7.png" alt="coin"> credits by uploading and sharing your study notes</h6>

        <div class="steps">
            <div class="step">
                <div class="circle">1</div>
                <p>Select file</p>
            </div>
            <div class="step">
                <div class="circle">2</div>
                <p>Add info</p>
            </div>
            <div class="step">
                <div class="circle">3</div>
                <p>Earn rewards</p>
            </div>
        </div>
    
        <div class="file-drop" id="drop-area" >
            <i class="bi bi-upload upload-icon"></i>
            <p><strong>Drag & drop files here to upload </strong></p>
            <p class="file-info">Max file size: 100MB. Supported files: PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP</p>
            <input type="file" id="fileInput" hidden>
        </div>

        <button class="browse-btn" onclick="document.getElementById('fileInput').click()" id="uploadbutton">Or browse files here</button>
</div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script>
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function(event) {
            let href = this.getAttribute('href');
            if (href !== '#' && href) {
                window.location.href = href;
            }
        });
    });
    </script>



</body>
</html>