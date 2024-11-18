<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    try {
        // Fetch user data from the database
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['username'] = $username;

            // Handle 'Remember Me'
            if ($remember) {
                // Set cookies if "Remember Me" is checked
                setcookie('username', $username, time() + (86400 * 30), "/"); // 30 days
                setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
            } else {
                // Clear cookies if "Remember Me" is not checked
                setcookie('username', '', time() - 3600, "/");
                setcookie('password', '', time() - 3600, "/");
            }

            header("Location: home.php"); // Redirect to home page
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
