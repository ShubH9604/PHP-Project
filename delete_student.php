<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Delete student from the database
        $stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirect back to the home page after deletion
        header("Location: home.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Student ID is missing.";
    exit;
}
?>
