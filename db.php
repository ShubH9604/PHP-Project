<?php
$host = '127.0.0.1'; // Database host
$dbname = 'student_management'; // Database name
$username = 'root'; // Database username (default for XAMPP)
$password = ''; // Database password (default for XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error mode
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>
