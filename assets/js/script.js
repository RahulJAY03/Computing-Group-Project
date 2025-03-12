document.addEventListener("DOMContentLoaded", function() {
    let modulesSidebar = document.getElementById("modulesSidebar");
    let openBtn = document.getElementById("openModulesSidebar");
    let openBtnMobile = document.getElementById("openModulesSidebarMobile");
    let closeBtn = document.getElementById("closeModulesSidebar");

    if (openBtn) {
        openBtn.addEventListener("click", function(e) {
            e.preventDefault();
            setTimeout(() => { 
                modulesSidebar.style.display = "block"; 
                setTimeout(() => { modulesSidebar.classList.add("show"); }, 10);
            }, 300); // Delay to ensure sidebar is visible first
        });
    }

    if (openBtnMobile) {
        openBtnMobile.addEventListener("click", function(e) {
            e.preventDefault();
            setTimeout(() => { 
                modulesSidebar.style.display = "block"; 
                setTimeout(() => { modulesSidebar.classList.add("show"); }, 10);
            }, 300);
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", function(e) {
            e.preventDefault();
            modulesSidebar.classList.remove("show");
            setTimeout(() => { modulesSidebar.style.display = "none"; }, 300);
        });
    }
});


function toggleProfilePopup() {
    const popup = document.getElementById('profilePopup');
    popup.classList.toggle('show');
}

document.addEventListener('click', function (event) {
    const profileIcon = document.querySelector('.profile-icon');
    const popup = document.getElementById('profilePopup');

    // Check if profileIcon and popup exist
    if (profileIcon && popup) {
        if (!profileIcon.contains(event.target) && !popup.contains(event.target)) {
            popup.classList.remove('show');
        }
    }
});
// Toggle profile popup
function toggleProfilePopup() {
    var popup = document.getElementById("profilePopup");
    popup.style.display = popup.style.display === "block" ? "none" : "block";
}



// Show logout confirmation popup
function confirmLogout(event) {
    event.preventDefault(); // Prevent default action (if it's inside a link)
    document.getElementById("logoutPopup").style.display = "flex"; // Show the confirmation popup
}

// Close popup when clicking "No" or outside the popup container
function closeLogoutPopup(event) {
    const popup = document.getElementById("logoutPopup");

    // Close when clicking the overlay (outside the popup container)
    if (!event || event.target.classList.contains("popup-overlay")) {
        popup.style.display = "none";
    }

    // Close when clicking the "No" button
    if (event && event.target.id === "noLogoutBtn") {
        popup.style.display = "none";
    }
}

// Redirect to logout script
function logoutUser() {
    window.location.href = "/Cgp-sara/api/auth/logout.php"; // Log the user out
}

// Attach event listener to logout buttons (for both inline and non-inline buttons)
document.addEventListener("DOMContentLoaded", function () {
    // Handle logout button in settings (on any page)
    const logoutButtons = document.querySelectorAll(".settings-btn i.fas.fa-sign-out-alt");

    // Add event listeners for each logout button
    logoutButtons.forEach(button => {
        button.parentElement.addEventListener("click", confirmLogout); // Show confirmation popup
    });

    // Handle the logout button on the user profile page (if it has a specific button with ID)
    const logoutButtonUserProfile = document.getElementById("logoutBtn"); // Adjust ID if necessary
    if (logoutButtonUserProfile) {
        logoutButtonUserProfile.addEventListener("click", confirmLogout);
    }

    // Attach event listener to the "No" button to close the popup
    const noLogoutBtn = document.getElementById("noLogoutBtn");
    if (noLogoutBtn) {
        noLogoutBtn.addEventListener("click", closeLogoutPopup);
    }
});



document.addEventListener("DOMContentLoaded", function () {
    const xpElement = document.getElementById("xp-value");
    if (!xpElement) return; // Avoid errors if element doesn't exist

    fetch(`${window.location.origin}/Cgp-sara/api/auth/getXP.php`) // Dynamic path
    .then(response => response.json())
    .then(data => {
        xpElement.innerText = (data.xp !== undefined) ? `${data.xp}XP` : "Error";
    })
    .catch(error => {
        console.error("Error fetching XP:", error);
        xpElement.innerText = "Error";
    });
});
