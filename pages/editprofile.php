<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/editprofile.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>
    
    <div class="container">
        <div class="profile-section">
            <img src="../assets/images/girl.png" alt="Profile Image" class="profile-img">
            <div>
                <h3>Sarali Balasinghe</h3>
                <button class="btn btn-outline-success">Change Picture</button>
            </div>
            
        </div>
        <div class="form-section mt-4">
            <h4>Edit Profile</h4>
            <form>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" value="Sarali Balasinghe">
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select">
                        <option selected>Female</option>
                        <option>Male</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">University</label>
                    <input type="text" class="form-control" value="University of Plymouth">
                </div>
                <div class="mb-3">
                    <label class="form-label">Study Programme</label>
                    <input type="text" class="form-control" value="Computer Science">
                </div>
                <div class="mb-3">
                    <label class="form-label">Graduate Year</label>
                    <input type="date" class="form-control" value="2027-09-27">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom">Save Changes</button>
                    <button type="reset" class="btn btn-outline-secondary">Discard Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>