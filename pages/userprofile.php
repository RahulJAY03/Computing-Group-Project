<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/userprofile.css"> <!-- Custom Styles -->


    
    <title>My Profile</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    
    <div class="container">
    <header>
        <div class="profile">
            <img id="profile-avatar" src="../assets/images/girl.png" alt="User Avatar">
            <h1 id="user-name">Loading...</h1>
        </div>
        <div class="settings">
            <button class="settings-btn"> <i class="fas fa-cog"></i></button>
            <button class="settings-btn" onclick="logoutUser()"> <i class="fas fa-sign-out-alt"></i></button>
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

        <div class="menu">
            <button class="menu-item">
                <i class="bi bi-file-earmark-text"></i>
            <span>My Documents</span>
                 <i class="bi bi-chevron-right"></i>
            </button>
            <button class="menu-item">
                <i class="bi bi-journal-text"></i>
             <span>My Sessions</span>
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  <!-- Add jQuery -->
<script src="../assets/js/userProfile.js"></script>    
<script src="../assets/js/script.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>



</body>
</html>