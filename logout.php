
<?php

session_set_cookie_params([
    "httponly" => true,
    "samesite" => "Lax",
    "secure" => false
]);

session_start();

// Remove all session data
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: index.php");
exit;

