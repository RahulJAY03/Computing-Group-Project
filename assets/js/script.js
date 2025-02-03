document.addEventListener("DOMContentLoaded", function() {
    let menuItems = document.querySelectorAll(".menu-item");

    menuItems.forEach(item => {
        item.addEventListener("click", function() {
            menuItems.forEach(i => i.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

// Toggle sidebar on mobile
function toggleSidebar() {
    document.querySelector(".sidebar").classList.toggle("open");
}
