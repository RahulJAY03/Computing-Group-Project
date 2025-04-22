<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <!-- Include Bootstrap if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/forgotpassword.css">

</head>
<body>
  <h2>Reset Password</h2>
  
  <div id="resetForm">
    <p>Enter your email address to reset your password.</p>
    <input type="email" id="email" placeholder="Your email address" required>
    <div id="emailError" class="error"></div>
    <button onclick="checkEmail()">Continue</button>
  </div>

  <div id="passwordForm" style="display:none;">
    <p>Enter your new password.</p>
    <input type="password" id="newPassword" placeholder="New password" required>
    <input type="password" id="confirmPassword" placeholder="Confirm password" required>
    <div id="passwordError" class="error"></div>
    <button onclick="resetPassword()">Reset Password</button>
  </div>
  
  <div id="message" class="success"></div>

  <script>
    let userEmail = "";
    
    function checkEmail() {
      const email = document.getElementById("email").value.trim();
      document.getElementById("emailError").textContent = "";
      document.getElementById("message").textContent = "";
      
      if (!email) {
        document.getElementById("emailError").textContent = "Email is required";
        return;
      }
      
      // Check if email exists in database
      fetch("../api/auth/check_email.php", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({email})
      })
      .then(res => res.json())
      .then(data => {
        if (data.exists) {
          // Email exists, show password form
          userEmail = email;
          document.getElementById("resetForm").style.display = "none";
          document.getElementById("passwordForm").style.display = "block";
        } else {
          document.getElementById("emailError").textContent = "Email not found in our records";
        }
      })
      .catch(error => {
        document.getElementById("emailError").textContent = "An error occurred. Please try again.";
        console.error(error);
      });
    }
    
    function resetPassword() {
      const newPassword = document.getElementById("newPassword").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      document.getElementById("passwordError").textContent = "";
      
      if (!newPassword) {
        document.getElementById("passwordError").textContent = "New password is required";
        return;
      }
      
      if (newPassword.length < 8) {
        document.getElementById("passwordError").textContent = "Password must be at least 8 characters";
        return;
      }
      
      if (newPassword !== confirmPassword) {
        document.getElementById("passwordError").textContent = "Passwords do not match";
        return;
      }
      
      // Reset password in database
      fetch("../api/auth/update_password.php", {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({email: userEmail, password: newPassword})
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          document.getElementById("passwordForm").style.display = "none";
          document.getElementById("message").textContent = "Password updated successfully. Redirecting to login...";
          setTimeout(() => {
            window.location.href = "landingpage.php";
          }, 3000);
        } else {
          document.getElementById("passwordError").textContent = data.error || "Failed to update password";
        }
      })
      .catch(error => {
        document.getElementById("passwordError").textContent = "An error occurred. Please try again.";
        console.error(error);
      });
    }
  </script>
</body>
</html>