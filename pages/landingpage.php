<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Add Bootstrap Icons CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Custom Styles -->
    <link rel="stylesheet" href="../assets/css/landingpage.css"> <!-- Custom Styles -->


    
    <title>sessions</title>
</head>
<body>
   
     <!-- Navbar -->
     <div class="navbar">
        <div class="logo"><img src="../assets/images/The Kuppiya 1.png" alt="Access Notes"></div>
        <div class="nav-links">
        <a href="#" class="login-btn" onclick="openLogin()">Login</a>

            <a href="#" class="signup-btn" onclick="openSignup()">Sign up for free</a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="Main-container">
        <h1>Free study notes, summaries & answers for your studies</h1>
        <p>Study easier, faster & better.</p>
        
        <a href="#" class="cta-btn" onclick="openLogin()">Get Started</a>

    </div>

    <div class="what-container">
        <h2>What We Offer ?</h2>
        <div class="features">
            <div class="feature">
                <img src="https://img.icons8.com/ios-filled/100/000000/note.png" alt="Access Notes">
                <h3>Access Notes</h3>
                <p>Get high-quality study materials shared by peers and experts</p>
            </div>
            <div class="feature">
                <img src="https://img.icons8.com/ios-filled/100/000000/video-conference.png" alt="Join Live Sessions">
                <h3>Join Live Sessions</h3>
                <p>Attend scheduled Zoom meetings for various subjects and discuss topics in real-time</p>
            </div>
            <div class="feature">
                <img src="https://img.icons8.com/ios-filled/100/000000/collaboration.png" alt="Share & Collaborate">
                <h3>Share & Collaborate</h3>
                <p>Upload your own notes and contribute to the community</p>
            </div>
        </div>
    </div>

    

    <div class="why-container">
        <div class="text-section">
            <h2>Why Study With Us ?</h2>
            <ul class="list">
                <li><span>📌</span>Updated Resources</li>
                <li><span>📌</span>Interactive Learning</li>
                <li><span>📌</span>Student-Driven</li>
                <li><span>📌</span>Seamless Accessibility</li>
            </ul>
        </div>
        <div class="image-section">
            <img src="../assets/images/why study.png.png" alt="Online Learning Illustration">
        </div>
        <a href="#" class="signup-btn1" onclick="openSignup()">Sign up for free</a>

    </div>
    

    <div class="testimonials">
        <h2>What Our Students Say ?</h2>
        <div class="testimonial-container">
            <div class="testimonial">
                <img src="../assets/images/p1.png" alt="Amanda">
                <h3>Amanda De Silva</h3>
                <p>This platform has been a lifesaver! Finding well-organized notes and joining live discussions has made studying easier.</p>
                <span>(Business Student)</span>
            </div>
            <div class="testimonial">
                <img src="../assets/images/p2.png" alt="Arvin">
                <h3>Arvin Perera</h3>
                <p>It's great to have a student-driven platform to share knowledge and help each other out. Highly recommend it!</p>
                <span>(Cyber Security Student)</span>
            </div>
            <div class="testimonial">
                <img src="../assets/images/p3.png" alt="Rahul">
                <h3>Rahul Jay</h3>
                <p>I love how interactive the Zoom sessions are. It feels like a real classroom, and I can clear my doubts instantly.</p>
                <span>(Software Eng. Student)</span>
            </div>
            <div class="testimonial">
                <img src="../assets/images/p4.png" alt="Julia">
                <h3>Julia Spencer</h3>
                <p>As someone who struggles with last-minute cramming, having access to shared notes and recorded sessions has been a huge help.</p>
                <span>(Engineering Student)</span>
            </div>
        </div>
    </div>
    <button class="signup-btn2" onclick="openSignup()">Sign up for free</button>



    <footer class="footer">
        <div class="footer-logo">
            <img src="../assets/images/The Kuppiya 1.png" alt="The Kuppiya">
        </div>
        <div class="footer-text">
            Copyright &copy; 2022 BRIX Templates | All Rights Reserved
        </div>
    </footer>

    <script src="../assets/js/script.js"></script>


<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!-- Signup Popup -->
<div class="popup-overlay" id="signupPopup">
    <div class="popup-container">
        <!-- Left Side: Message -->
        <div class="popup-left">
            <h1>Study easier together</h1>
            <p>Get access to all documents, groups, questions, and answers.</p>
        </div>

        <!-- Right Side: Signup Form -->
        <div class="popup-right">
            <span class="close-btn" onclick="closePopup('signupPopup')">&#10006;</span>
            <h2>Signup</h2>
            <div class="input-group">
                <label for="email">Email address</label>
                <input type="email" id="email" placeholder="Enter your email">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password">
            </div>
            <button class="signup-btn"onclick="signUp(event)">Sign up for free</button>

            <p>Or with</p>
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
</div>
<!-- Login Popup -->
<div class="popup-overlay" id="loginPopup">
    <div class="popup-container">
        <!-- Left Side: Message -->
        <div class="popup-left">
            <h1>Welcome back</h1>
            <p>Login to access your documents, groups, questions, and answers.</p>
        </div>

        <!-- Right Side: Login Form -->
        <div class="popup-right">
            <span class="close-btn" onclick="closePopup('loginPopup')">&#10006;</span>
            <h2>Login</h2>
            <form onsubmit="login(event)">
                <div class="input-group">
                    <label for="login-email">Email address</label>
                    <input type="email" id="login-email" placeholder="Enter your email">
                </div>
                <div class="input-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" placeholder="Enter your password">
                </div>
                <div class="checkbox-group">
                    <div class="remember-me">
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember me</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="signup-btn">Login</button>
            </form>

            <p class="center-text">
                No account? 
                <a href="#" class="signup-link" onclick="openSignupFromLogin()">Register for free</a>
            </p>

            <p class="center-text">Or login with</p>
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
</div>


<!-- Additional Signup Details Popup -->
<div class="popup-overlay" id="additionalSignupPopup">
    <div class="popup-container">
        <!-- Left Side: Message -->
        <div class="popup-left">
            <h1>Just a small step here :)</h1>
        </div>

        <!-- Right Side: Additional Signup Form -->
        <div class="popup-right">
            <span class="close-btn" onclick="closePopup('additionalSignupPopup')">&#10006;</span>
            <h2>Complete Your Profile</h2>

            <form id="additionalSignupForm">
                <div class="input-group">
                    <label for="username">Name</label>
                    <input type="text" id="username" placeholder="Enter your name" required>
                </div>

                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="not_prefer">Prefer not to say</option>
                    </select>
                </div>

                <div class="input-group">
                    <label for="university">University</label>
                    <input type="text" id="university" placeholder="Enter your university" required>
                </div>

                <div class="input-group">
                    <label for="study-programme">Study Programme</label>
                    <input type="text" id="study-programme" placeholder="Enter your study programme" required>
                </div>

                <div class="input-group">
                    <label for="graduate-year">Graduate Year</label>
                    <input type="date" id="graduate-year" required>
                </div>

                <button type="submit" class="signup-btn">Submit</button>
            </form>
        </div>
    </div>
</div>




<script>
function openSignup() {
    document.getElementById('signupPopup').style.display = 'flex';
}

function openLogin() {
    document.getElementById('loginPopup').style.display = 'flex';
}

function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}

function signUp(event) {
    event.preventDefault(); // Prevent form submission

    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    // Basic frontend validation
    if (!email || !password) {
        alert("All fields are required!");
        return;
    }

    fetch("/Cgp-sara/api/auth/signup.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.status === "success") {
            alert("Signup successful! Redirecting to complete profile...");
            sessionStorage.setItem("userEmail", email); // Store email
            closePopup("signupPopup");
            openAdditionalSignupPopup(); // Open additional details popup only after success
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error("Error during signup:", error);
        alert("An error occurred during signup. Please try again later.");
    });
}

function openAdditionalSignupPopup() {
    document.getElementById("additionalSignupPopup").style.display = "flex";
}

function closePopup(popupId) {
    document.getElementById(popupId).style.display = "none";
}

document.addEventListener("DOMContentLoaded", function () {
    let additionalSignupForm = document.getElementById("additionalSignupForm");

    if (additionalSignupForm) {
        additionalSignupForm.addEventListener("submit", function(event) {
            event.preventDefault();  // Prevent default form submission

            console.log("Submit button clicked!");  // Debugging step

            let email = sessionStorage.getItem("userEmail"); // Get stored email
            if (!email) {
                console.error("Email is missing!");
                alert("Email is missing! Please refresh and try again.");
                return;
            }

            let gender = document.getElementById("gender").value;
            let university = document.getElementById("university").value;
            let studyProgram = document.getElementById("study-programme").value;
            let graduationDate = document.getElementById("graduate-year").value;

            fetch("/Cgp-sara/api/auth/updateProfile.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `email=${encodeURIComponent(email)}&gender=${encodeURIComponent(gender)}&university=${encodeURIComponent(university)}&studyProgram=${encodeURIComponent(studyProgram)}&graduationDate=${encodeURIComponent(graduationDate)}`
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === "success") {
                    alert("Profile updated successfully! Redirecting to dashboard...");
                    window.location.href = "index.php";
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error during profile update:", error));
        });
    }
});

function login(event) {
    event.preventDefault(); // Prevent the form from submitting
    console.log("Login function triggered");

    let email = document.getElementById("login-email").value;
    let password = document.getElementById("login-password").value;

    // Basic frontend validation
    if (!email || !password) {
        alert("Both email and password are required!");
        return;
    }

    console.log(`Sending login request for email: ${email}`);

    // Send login request to the backend
    fetch("/Cgp-sara/api/auth/login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
    })
    .then(response => {
        console.log("Response status:", response.status);  // Log status code
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Log the response from the backend
        if (data.status === "success") {
            // If login is successful, store user information in the session
            sessionStorage.setItem("userEmail", email);
            alert("Login successful! Redirecting...");
            window.location.href = "index.php";  // Change to the appropriate page
        } else {
            alert("Login failed: " + data.message); // Show error message from backend
        }
    })
    .catch(error => {
        console.error("Error during login:", error);
        alert("An error occurred during login. Please try again later.");
    });
}



</script>

</body>
</html>