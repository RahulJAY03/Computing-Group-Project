<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/createsessons.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>
     <div class="container">
        <h1>Create a Session</h1>
        <div class="form-container">
            <label for="category">Select a category</label>
            <select id="category">
                <option value="">Select a category</option>
                <option value="category1">IT</option>
                <option value="category2">Business</option>
                <option value="category2">Science</option>
            </select><br>

            <label for="topic">Topic :</label>
            <input type="text" id="topic"><br>

            <label for="hosted">Hosted by :</label>
            <input type="text" id="hosted"><br>

            <label for="duration">Duration :</label>
            <input type="text" id="duration"><br>

            <label for="date">Date :</label>
            <input type="date" id="date"><br>

            <label for="time">Time :</label>
            <input type="time" id="time"><br>

            <button type="submit">Create</button>
        </div>
    </div>
   

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>