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
    event.preventDefault(); // Prevent the default link action
    document.getElementById("logoutPopup").style.display = "flex";
}

// Close logout popup when clicking "No" or outside the popup
function closeLogoutPopup(event) {
    if (!event || event.target.classList.contains("popup-overlay")) {
        document.getElementById("logoutPopup").style.display = "none";
    }
}
function logoutUser() {
    window.location.href = "/Cgp-sara/api/auth/logout.php";
}


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
