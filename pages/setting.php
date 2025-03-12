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
session_start();
?>

   
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
                    <input type="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" disabled>

                </div>
                <div class="form-group">
                    <label>Current password</label>
                    <input type="password" class="email-current-password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New email</label>
                    <input type="email" class="new-email" placeholder="Enter new email">
                </div>
                <div class="form-group">
                    <label>Repeat new email</label>
                    <input type="email" class="confirm-new-email" placeholder="Enter new email again">
                </div>
                <button class="save-btn email-save-btn">Save changes</button>
            </form>
        </div>

        <div class="section2">
            <h3>Change password</h3>
            <form>
                <div class="form-group">
                    <label>Current password</label>
                    <input type="password" class="password-current-password" placeholder="Enter current password">
                </div>
                <div class="form-group">
                    <label>New password</label>
                    <input type="password" class="new-password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label>Repeat new password</label>
                    <input type="password" class="confirm-new-password" placeholder="Enter new password again">
                </div>
                <button class="save-btn password-save-btn">Save changes</button>
            </form>
        </div>
    </div>
</div>


    
    
    <script src="/Cgp-sara/assets/js/script.js" defer></script>
<script src="/Cgp-sara/assets/js/setting.js" defer></script>
<script src="/Cgp-sara/assets/js/bootstrap.bundle.min.js" defer></script>


</body>
</html>