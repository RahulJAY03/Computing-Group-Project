<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap"> <!-- Modern Font -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/sessions.css">
    <title>Sessions</title>
</head>
<body>
    <?php
        include '../includes/navbar.php';  // Include Navbar
        include '../includes/sidebar.php'; // Include Sidebar
        include '../api/chatbot/Chatbot.php'; // Include Chatbot script

        require_once '../config/db.php'; // Make sure your db connection is included
        $sessionsCollection = $db->sessions;
        $sessions = $sessionsCollection->find();

        $categoriesCollection = $db->categories;
        $categories = $categoriesCollection->find();
        $categoryNames = [];
        foreach ($categories as $category) {
            $categoryNames[(string)$category['_id']] = $category['categoryName'];
        }
    ?>

    <main class="sessions-container">

        <div class="sessions-header">
            <button class="create-session-btn" onclick="window.location.href='createsessions.php'">Create a Session</button>
        </div>

        <div class="category-filter">
            <label for="category-select">Filter by category:</label>
            <select id="category-select">
                <option value="">All Categories</option>
                <option value="it">IT</option>
                <option value="business">Business</option>
                <option value="science">Science</option>
            </select>
        </div>

        <h2 class="page-title">Recommended Sessions</h2>

        <div class="sessions-grid" id="sessions-grid">
            <?php
                foreach ($sessions as $session) {
                    $categoryId = isset($session['category']) ? (string)$session['category'] : null;
                    $categoryName = isset($categoryNames[$categoryId]) ? $categoryNames[$categoryId] : 'Unknown Category';

                    if (isset($session['date'])) {
                        $date = $session['date']->toDateTime();
                        $formattedDate = $date->format('d M Y');
                    } else {
                        $formattedDate = 'N/A';
                    }

                    echo "<div class='session-card' data-category='$categoryName'>";
                    echo "<h3 class='session-topic'>" . htmlspecialchars($session['topic']) . "</h3>";
                    echo "<p><strong>Hosted by:</strong> " . htmlspecialchars($session['hostedBy']) . "</p>";
                    echo "<p><strong>Duration:</strong> " . htmlspecialchars($session['duration']) . "</p>";
                    echo "<p><strong>Date:</strong> " . $formattedDate . "</p>";
                    echo "<p><strong>Time:</strong> " . date('h:i A', strtotime($session['time'])) . "</p>";
                    echo "<button class='join-btn' onclick='window.location.href=\"" . htmlspecialchars($session['meetingLink']) . "\"'>Join</button>";
                    echo "</div>";
                }
            ?>
        </div>
    </main>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('category-select').addEventListener('change', function() {
            var selectedCategory = this.value.toLowerCase();
            var sessionCards = document.querySelectorAll('.session-card');
            var pageTitle = document.querySelector('.page-title');

            // Update the heading based on the selected category
            if (selectedCategory === '') {
                pageTitle.textContent = 'Recommended Sessions';
            } else {
                pageTitle.textContent = selectedCategory.charAt(0).toUpperCase() + selectedCategory.slice(1);
            }

            sessionCards.forEach(function(card) {
                var category = card.getAttribute('data-category').toLowerCase();
                if (selectedCategory === '' || category === selectedCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
