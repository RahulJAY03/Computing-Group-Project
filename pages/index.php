<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/leaderboard.css">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->

    
    <title>Document</title>
</head>
<body>
   
    <?php
        include '../includes/navbar.php';  //meee wageeeee karannnn
        include '../includes/sidebar.php'; //meee wageeeee karannnn
    ?>
    
    <div class="content">
      
    </div>
    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script>
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(event) {
        let href = this.getAttribute('href');
        if (href !== '#' && href) {
            window.location.href = href;
        }
    });
});
</script>


</body>
</html>
