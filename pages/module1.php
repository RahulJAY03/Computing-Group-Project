<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/module1.css">
    <title>Modules</title>
</head>
<body>
    <?php
        include '../includes/navbar.php';
        include '../includes/sidebar.php';
    ?>
    
    <div class="container">
        <div class="module-header">
            <h2>Modules</h2>
        </div>
        
        <div class="module-content">
            <div class="module-category">
                <h3>Select a Category</h3>
                <div class="category-list">
                    <button class="category-btn active">IT</button>
                    <button class="category-btn">Business</button>
                    <button class="category-btn">Science</button>
                    <button class="category-btn"><i class="bi bi-plus"></i> Add</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>