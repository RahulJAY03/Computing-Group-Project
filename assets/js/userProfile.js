$(document).ready(function () {
    $.ajax({
        url: "/Cgp-sara/api/auth/fetchUserProfile.php",
        method: "GET",
        dataType: "json",
        success: function (data) {
            if (data.error) {
                alert(data.error);
                return;
            }

            $("#user-name").text(data.fullName);
            $("#user-university").text(data.university);
            $("#user-studyProgram").text(data.studyProgram);
            $("#user-graduation").text(data.graduationDate);

            // Update profile image dynamically
            $("#profile-avatar").attr("src", data.profile_image);
        },
        error: function () {
            alert("Failed to fetch user data.");
        }
    });
});


function logoutUser() {
    window.location.href = "/Cgp-sara/api/auth/logout.php";
}

document.addEventListener("DOMContentLoaded", function () {
    const profileAvatar = document.getElementById("profile-avatar");
    const profileUpload = document.getElementById("profile-upload");

    console.log("Script loaded, event listeners attached");

    // When user clicks on the profile image, open file input
    profileAvatar.addEventListener("click", function () {
        console.log("Profile image clicked");
        profileUpload.click();
    });

    // When a file is selected, preview the image and upload it
    profileUpload.addEventListener("change", function () {
        console.log("File selected");

        if (profileUpload.files.length > 0) {
            const file = profileUpload.files[0];
            console.log("Selected file:", file.name, file.type, file.size);

            const formData = new FormData();
            formData.append("profile_image", file);

            // Preview the selected image before upload
            const reader = new FileReader();
            reader.onload = function (e) {
                profileAvatar.src = e.target.result;
                console.log("Preview updated");
            };
            reader.readAsDataURL(file);

            // Send the image to the backend
            console.log("Sending request to server...");
            fetch("/Cgp-sara/api/auth/upload_profile.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server response:", data);
                if (data.success) {
                    alert("Profile picture updated successfully!");
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Upload Error:", error));
        } else {
            console.log("No file selected");
        }
    });
});
