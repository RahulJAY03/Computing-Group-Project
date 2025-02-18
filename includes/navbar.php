<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:80px; ">
    <div class="container-fluid">
        <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <i class="bi bi-list" style="font-size: 24px;"></i>
        </button>

        <div class="input-group me-auto" style="max-width: 400px;"> <span class="input-group-text bg-light border-0">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search Documents, Sessions">
        </div>

        <!-- Updated Navbar with Profile Popup -->
<div class="d-flex align-items-center" style="position: relative;">
    <span class="me-2" style="font-size: 18px;">780XP</span>
    <span class="me-2" style="font-size: 18px;">🪙 19</span>
    <img src="../assets/images/profile.jpg" alt="Profile" class="profile-icon" onclick="toggleProfilePopup()">

    <!-- Profile Popup Dropdown -->
    <div class="profile-popup" id="profilePopup">
        <a href="userprofile.php">My Profile</a>
        <a href="settings.php">Settings</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

    </div>
</nav>

