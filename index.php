<?php
session_start();

// Auto-fill fields if cookies are set
$saved_username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$saved_password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        
        input[type="text"], input[type="password"] {
            padding: 8px;
            margin: 10px 0;
            width: 200px;
        }
        
        button {
            padding: 8px 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <form action="login.php" method="POST">
        <h2>Login</h2>
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($saved_username); ?>" required><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" value="<?= htmlspecialchars($saved_password); ?>" required><br>
        <input type="checkbox" name="remember" id="remember" <?= ($saved_username && $saved_password) ? 'checked' : ''; ?>>
        <label for="remember">Remember Me</label><br>
        <button type="submit">Login</button>
    </form>

</body>
</html>
