<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    try {
        $stmt = $conn->prepare("INSERT INTO students (name, email, age, grade) VALUES (:name, :email, :age, :grade)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':grade', $grade);
        $stmt->execute();
        header("Location: home.php"); // Redirect to home page
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
