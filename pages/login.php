<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/login.css"> <!-- Custom Styles -->
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-container">
            <h2 class="text-center">LOGIN</h2>
            <form id="loginForm">
                <div class="mb-3">
                   
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <input type="checkbox" id="stayLoggedIn">
                        <label for="stayLoggedIn">Stay logged in</label>
                    </div>
                    <a href="#" class="text-decoration-none">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-success w-100">Log in</button>
            </form>
            <p class="text-center my-3">or log in with</p>
            <div class="d-flex justify-content-center gap-4">
                <button class="btn btn-light social-btn p-4">
                    <img src="../assets/images/google logo.png" alt="Google">
                </button>
                <button class="btn btn-light social-btn p-4">
                    <img src="../assets/images/facebook logo.png" alt="Facebook">
                </button>
                <button class="btn btn-dark social-btn p-4">
                    <img src="../assets/images/apple logo.jpg" alt="Apple">
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("loginForm").addEventListener("submit", function(event) {
                event.preventDefault();
                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;
                if (email && password) {
                    alert("Login successful for: " + email);
                } else {
                    alert("Please enter both email and password.");
                }
            });
        });
    </script>
</body>
</html>
