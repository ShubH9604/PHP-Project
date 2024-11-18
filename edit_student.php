<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Fetch student data
        $stmt = $conn->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$student) {
            echo "Student not found!";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    try {
        // Update student data
        $stmt = $conn->prepare("UPDATE students SET name = :name, email = :email, age = :age, grade = :grade WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: home.php"); // Redirect to home page
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form action="edit_student.php" method="POST">
        <input type="hidden" name="id" value="<?= $student['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($student['name']); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?= htmlspecialchars($student['age']); ?>" required>
        <br>
        <label for="grade">Grade:</label>
        <input type="text" name="grade" value="<?= htmlspecialchars($student['grade']); ?>" required>
        <br>
        <button type="submit">Update Student</button>
    </form>
</body>
</html>
