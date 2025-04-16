<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:80px;">
    <div class="container-fluid">
        <button class="btn btn-outline-dark d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <i class="bi bi-list" style="font-size: 24px;"></i>
        </button>

        <div class="input-group me-auto" style="max-width: 400px;">
            <span class="input-group-text bg-light border-0">
                <i class="bi bi-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search Documents, Sessions">
        </div>

        <!-- Updated Navbar with Profile Popup -->
        <div class="d-flex align-items-center" style="position: relative;">
            <!-- Highlighted XP -->
            <span class="xp-highlight" id="xp-value">Loading XP...</span>
            <img id="profile-icon" src="../assets/images/profile.jpg" alt="Profile" class="profile-icon" onclick="toggleProfilePopup()">

            <!-- Profile Popup Dropdown -->
            <div class="profile-popup" id="profilePopup">
                <a href="userprofile.php">My Profile</a>
                <a href="setting.php">Settings</a>
                <a href="#" onclick="confirmLogout(event)">Logout</a>

            </div>
        </div>
    </div>
</nav>

<!-- Logout Confirmation Popup -->
<div id="logoutPopup" class="popup-overlay" onclick="closeLogoutPopup(event)">
    <div class="popup-container">
        <h2>Are you sure you want to logout?</h2>
        <div class="popup-buttons">
            <button onclick="logoutUser()">Yes</button>
            <button id="noLogoutBtn">No</button> <!-- Added ID for event listener -->
        </div>
    </div>
</div>
