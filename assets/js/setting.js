function showModal() {
    document.getElementById("deleteModal").style.display = "block"; // Show modal
}

function closeModal() {
    document.getElementById("deleteModal").style.display = "none"; // Hide modal
}

document.querySelector(".modal-delete").addEventListener("click", function () {
    fetch("/Cgp-sara/api/auth/delete_account.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({}) // No need to send email
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Your account has been deactivated.");
            window.location.href = "/Cgp-sara/pages/landingpage.php"; // Redirect to home
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});
