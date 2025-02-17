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

