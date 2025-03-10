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
        },
        error: function () {
            alert("Failed to fetch user data.");
        }
    });
});

function logoutUser() {
    window.location.href = "/Cgp-sara/api/auth/logout.php";
}