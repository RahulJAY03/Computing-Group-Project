<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/setting.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    <div class="settings-container">
        <h2>Settings</h2>
        
        <div class="section">
        <div class="section1">
            <h3>Change Email</h3>
            <form>
                <div class="form-group">
                    <label>Current email</label>
                    <input type="email" value="sarialbalasinghe@gmail.com" disabled>
                </div>
                <div class="form-group">
                    <label>Current password</label>
                    <input type="password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New email</label>
                    <input type="email" placeholder="Enter new email">
                </div>
                <div class="form-group">
                    <label>Repeat new email</label>
                    <input type="email" placeholder="Enter new email again">
                </div>
                <button class="save-btn">Save changes</button>
            </form>
        </div>
        
        
        <div class="section2">
            <h3>Change password</h3>
            <form>
                <div class="form-group">
                    <label>Current password</label>
                    <input type="password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <input type="password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label>Repeat new password</label>
                    <input type="password" placeholder="Enter new password again">
                </div>
                <button class="save-btn">Save changes</button>
            </form>
        </div>
        
        <div class="section3">
            <h3>Delete account</h3>
            <p>Do you want to delete your ‘The Kuppiya’ account? We wish you all the best and hope to see you again soon</p>
            <button class="delete-btn">Permanently delete account</button>
        </div>
        </div>
    </div>
    

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>