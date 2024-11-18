<?php
session_start();
require 'db.php';

// Redirect to login if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Fetch all students
try {
    $stmt = $conn->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .form-container {
            margin: 20px 0;
        }
        .form-container input, .form-container button {
            padding: 10px;
            margin: 5px;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?></h1>
    <a href="logout.php">Logout</a>

    <h2>Student Management</h2>

    <!-- Add Student Form -->
    <div class="form-container">
        <h3>Add Student</h3>
        <form action="add_student.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="number" name="age" placeholder="Age" required>
            <input type="text" name="grade" placeholder="Grade" required>
            <button type="submit">Add Student</button>
        </form>
    </div>

    <!-- Student List -->
    <h3>Student List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id']; ?></td>
                <td><?= htmlspecialchars($student['name']); ?></td>
                <td><?= htmlspecialchars($student['email']); ?></td>
                <td><?= htmlspecialchars($student['age']); ?></td>
                <td><?= htmlspecialchars($student['grade']); ?></td>
                <td>
                    <a href="edit_student.php?id=<?= $student['id']; ?>">Edit</a> |
                    <a href="delete_student.php?id=<?= $student['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
