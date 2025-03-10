<?php

// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page or homepage
header("Location: /Cgp-sara/pages/landingpage.php");
exit;


?>
