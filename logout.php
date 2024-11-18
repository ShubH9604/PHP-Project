<?php
session_start();
session_destroy(); // Destroy the session

// Clear cookies only if "Remember Me" was not used
if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    setcookie('username', '', time() - 3600, "/");
    setcookie('password', '', time() - 3600, "/");
}

header("Location: index.php"); // Redirect to login page
exit;
?>
