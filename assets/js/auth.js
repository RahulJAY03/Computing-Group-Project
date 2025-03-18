// Include Google API
const googleScript = document.createElement("script");
googleScript.src = "https://accounts.google.com/gsi/client";
googleScript.async = true;
googleScript.defer = true;
document.head.appendChild(googleScript);

// Google Sign-In Callback Function
function handleCredentialResponse(response) {
    console.log("Google Token Received:", response.credential);

    fetch("/Cgp-sara/api/auth/google_auth.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ token: response.credential }),
    })
    .then(res => res.json())
    .then(data => {
        console.log("Backend Response:", data); // Check backend response in console

        if (data.status === "success") {
            console.log("Redirecting to:", data.redirect);
            window.location.href = data.redirect; // Redirect to index.php
        } else {
            alert("Google login failed: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}


// Initialize Google Sign-In
function initGoogleAuth() {
    if (window.google) {
        google.accounts.id.initialize({
            client_id: "53507074052-dr4sgdektjv7u13rhe3b5ob636qol59m.apps.googleusercontent.com", // Replace with actual Client ID
            callback: handleCredentialResponse,
        });

        google.accounts.id.renderButton(
            document.getElementById("signup-google-btn"),
            { theme: "outline", size: "large" }
        );

        google.accounts.id.renderButton(
            document.getElementById("login-google-btn"),
            { theme: "outline", size: "large" }
        );
    } else {
        console.error("Google API failed to load.");
    }
}

// Run Google Auth Initialization
window.addEventListener("load", initGoogleAuth);
