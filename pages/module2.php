<?php
require_once __DIR__ . '/../config/db.php'; // MongoDB connection script

// Check if category is passed via URL, if not default to "IT"
$categoryName = isset($_GET['category']) ? $_GET['category'] : 'IT';

// Fetch the category ID for the given category name
$category = $db->categories->findOne(['categoryName' => $categoryName]);

if ($category) {
    $categoryId = $category['_id']; // Get category ID
    $modules = $db->modules->find(['categoryId' => $categoryId]); // Fetch modules for this category
} else {
    $modules = []; // If category not found, return empty array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/module2.css">
    <title><?php echo htmlspecialchars($categoryName); ?> Modules</title>
</head>
<body>
    <?php
        include '../includes/navbar.php';
        include '../includes/sidebar.php';
        include '../api/chatbot/Chatbot.php'; // Include the Chatbot script here
    ?>

    <div class="container">
        <h2 class="page-title"><?php echo htmlspecialchars($categoryName); ?> Section Modules</h2>
        <div class="modules-grid">
            <?php if (!empty($modules)) : ?>
                <?php foreach ($modules as $module) : ?>
                    <button class="module-item" onclick="window.location.href='discussion_document.php?module=<?php echo urlencode($module['moduleName']); ?>'">
                        <?php echo htmlspecialchars($module['moduleName']); ?>
                    </button>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No modules available for this category.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
