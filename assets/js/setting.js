function showModal() {
    document.getElementById("deleteModal").style.display = "block"; // Show modal
}

function closeModal() {
    document.getElementById("deleteModal").style.display = "none"; // Hide modal
}

document.addEventListener("DOMContentLoaded", function () {
    
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

});



document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".email-save-btn").addEventListener("click", function (event) {
        event.preventDefault();
        changeEmail();
    });

    document.querySelector(".password-save-btn").addEventListener("click", function (event) {
        event.preventDefault();
        changePassword();
    });
});

function changeEmail() {
    const currentPassword = document.querySelector(".email-current-password").value;
    const newEmail = document.querySelector(".new-email").value;
    const confirmNewEmail = document.querySelector(".confirm-new-email").value;

    if (newEmail !== confirmNewEmail) {
        alert("New emails do not match!");
        return;
    }

    fetch("/Cgp-sara/api/auth/change_email.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ currentPassword, newEmail })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) window.location.reload();
    })
    .catch(error => console.error("Error:", error));
}

function changePassword() {
    const currentPassword = document.querySelector(".password-current-password").value;
    const newPassword = document.querySelector(".new-password").value;
    const confirmNewPassword = document.querySelector(".confirm-new-password").value;

    if (newPassword !== confirmNewPassword) {
        alert("New passwords do not match!");
        return;
    }

    fetch("/Cgp-sara/api/auth/change_password.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ currentPassword, newPassword })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) window.location.reload();
    })
    .catch(error => console.error("Error:", error));
}
