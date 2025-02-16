<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="../assets/css/Signup.css">
    
</head>
<body>

    <div class="container">
        <div class="left">
            <h2>Study easier together!</h2>
            <p>Get access to all documents, groups, questions, and answers.</p>
        </div>
        <div class="right">
            <h2>Signup</h2>
            <div class="input-group">
                <label for="email">Email address</label>
                <input type="email" id="email" placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password">
            </div>
            <button class="signup-btn" onclick="signUp()">Sign up for free</button>

            <p>with</p>
            <div class="social-login">
                <a href="https://accounts.google.com/signup" target="_blank">
                    <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google">
                </a>
                <a href="https://appleid.apple.com/sign-in" target="_blank">
                    <img src="https://img.icons8.com/ios-filled/50/000000/mac-os.png" alt="Apple">
                </a>
            </div>
        </div>
    </div>

    <script>
        function signUp() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            
            if(email === "" || password === "") {
                alert("Please fill in both fields.");
            } else {
                alert("Signup Successful!");
            }
        }   
    </script>

</body>
</html>