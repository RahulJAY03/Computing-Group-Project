<?php
require_once __DIR__ . '/../config/db.php'; // Include the MongoDB connection script

$collection = $db->categories; // Connect to the 'categories' collection

$categories = $collection->find(); // Fetch all categories
?>

<!-- Sidebar - Visible on larger screens -->
<div class="d-none d-lg-block bg-light text-black sidebar">
    <div class="offcanvas-body d-flex flex-column p-3">
        <!-- Logo -->
        <div class="mb-4">
            <img src="../assets/images/The Kuppiya 1.png" alt="Logo" class="img-fluid">
        </div>

        <!-- Sidebar Menu (Large screen) -->
        <div class="nav flex-column gap-3" style="font-size: 18px;">
            <a href="index.php" class="nav-link text-black active">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
            <a href="#" class="nav-link text-black" id="openModulesSidebar">
                <i class="bi bi-grid me-2"></i> Modules
            </a>
            <a href="sessions.php" class="nav-link text-black">
                <i class="bi bi-clock me-2"></i> Sessions
            </a>
            <a href="leaderboard.php" class="nav-link text-black">
                <i class="bi bi-trophy me-2"></i> Leaderboard
            </a>
        </div>

        <!-- Add Button -->
        <a href="addnote2.php" class="btn btn-success mt-5 w-100" 
   style="font-size: 18px; background-color: #74E685; color: black; font-weight: bold; border-radius: 18px;"
   onmouseover="this.style.backgroundColor='#62d677'" 
   onmouseout="this.style.backgroundColor='#74E685'">
    + Contribute
</a>

    </div>
</div>

<!-- Sidebar - Offcanvas for smaller screens -->
<div class="offcanvas offcanvas-start bg-light text-black" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    
    <div class="offcanvas-body d-flex flex-column p-3">
        <!-- Logo -->
        <div class="mb-4">
            <img src="../assets/images/The Kuppiya 1.png" alt="Logo" class="img-fluid">
        </div>

        <!-- Sidebar Menu -->
        <div class="nav flex-column gap-3" style="font-size: 18px;">
            <a href="index.php" class="nav-link text-black">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
            <a href="#" class="nav-link text-black" id="openModulesSidebarMobile">
                <i class="bi bi-grid me-2"></i> Modules
            </a>
            <a href="sessions.php" class="nav-link text-black">
                <i class="bi bi-clock me-2"></i> Sessions
            </a>
            <a href="leaderboard.php" class="nav-link text-black">
                <i class="bi bi-trophy me-2"></i> Leaderboard
            </a>
        </div>

        <!-- Add Button -->
        <button class="btn btn-success mt-5 w-100"
            style="font-size: 18px; background-color: #74E685; color: black; font-weight: bold; border-radius: 18px;"
            onmouseover="this.style.backgroundColor='#62d677'" 
            onmouseout="this.style.backgroundColor='#74E685'">
            + Contribute
        </button>
    </div>
</div>


<!-- module side bar -->
<div id="modulesSidebar" class="modules-sidebar">
    <div class="modules-header">
        <h5>Select a Category</h5>
        <button class="btn-close" id="closeModulesSidebar"></button>
    </div>
    <div class="modules-body">
        <?php foreach ($categories as $category) : ?>
            <button class="category-btn" onclick="window.location.href='module2.php?category=<?php echo urlencode($category['categoryName']); ?>'">
                <?php echo htmlspecialchars($category['categoryName']); ?>
            </button>
        <?php endforeach; ?>
    </div>
</div>


