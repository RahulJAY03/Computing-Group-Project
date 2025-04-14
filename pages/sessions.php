<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/sessions.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>
    
    

     <!-- Sidebar and Navbar (To be included from separate files) -->
     <main class="sessions-container">

     <!-- Top Section with Button -->
     <div class="sessions-header">
        <button class="create-session-btn" onclick="window.location.href='createsessions.php'">Create a Session</button>
    </div>

    <!-- Category Dropdown -->
    <div class="category-filter">
        <label for="category-select">Select a category:</label>
        <select id="category-select">
            <option value="">All Categories</option>
            <option value="it">IT</option>
            <option value="business">Business</option>
            <option value="science">Science</option>
        </select>
    </div>

    <h2>Recommended Sessions</h2>

    

    <div class="sessions-grid">
        <div class="session-card" data-category="it">
            <h3>Topic: Web Development Basics</h3>
            <p><strong>Hosted by:</strong> John Doe</p>
            <p><strong>Duration:</strong> 1 Hour</p>
            <p><strong>Date:</strong> 15 Feb 2025</p>
            <p><strong>Time:</strong> 10:00 AM</p>
            <label><input type="checkbox"> Remind me later</label>
            <button class="join-btn">Join</button>
        </div>
        <div class="session-card" data-category="business">
            <h3>Topic: Business Strategies</h3>
            <p><strong>Hosted by:</strong> Jane Smith</p>
            <p><strong>Duration:</strong> 2 Hours</p>
            <p><strong>Date:</strong> 16 Feb 2025</p>
            <p><strong>Time:</strong> 2:00 PM</p>
            <label><input type="checkbox"> Remind me later</label>
            <button class="join-btn">Join</button>
        </div>
        <div class="session-card" data-category="science">
            <h3>Topic: Scientific Research</h3>
            <p><strong>Hosted by:</strong> Alan Turing</p>
            <p><strong>Duration:</strong> 1.5 Hours</p>
            <p><strong>Date:</strong> 18 Feb 2025</p>
            <p><strong>Time:</strong> 4:00 PM</p>
            <label><input type="checkbox"> Remind me later</label>
            <button class="join-btn">Join</button>
        </div>
    </div>
</main>


    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>


</body>
</html>