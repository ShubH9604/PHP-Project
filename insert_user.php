<?php
require 'db.php'; // Include the database connection

// Define the username and password
$username = 'admin';
$password = password_hash('yourpassword', PASSWORD_DEFAULT); // Replace 'yourpassword' with your desired password

// Insert the user into the database
try {
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    echo "User inserted successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
