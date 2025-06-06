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
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
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

        <!-- Delete Account Section -->
        <div class="section3 mt-4">
            <h3>Delete Account</h3>
            <button class="btn btn-danger delete-account-btn"><i class="bi bi-trash"></i> Delete Account</button>
            <p class="text-danger mt-2" style="font-size: 0.95em;">Warning: This action is irreversible. Your account will be deactivated and you will be logged out.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteBtn = document.querySelector('.delete-account-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                fetch('/Cgp-sara/api/auth/delete_account.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ delete: true })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Your account has been deleted.');
                        window.location.href = '/Cgp-sara/pages/landingpage.php';
                    } else {
                        alert(data.message || 'Failed to delete account.');
                    }
                })
                .catch(() => alert('An error occurred. Please try again.'));
            }
        });
    }
});
</script>

<script src="/Cgp-sara/assets/js/script.js" defer></script>
<script src="/Cgp-sara/assets/js/setting.js" defer></script>
<script src="/Cgp-sara/assets/js/bootstrap.bundle.min.js" defer></script>


</body>
</html>