<?php
session_start();
if (isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'Admin') {
        header("Location: Admin/index.php");
    } elseif ($_SESSION['user_type'] == 'Professor') {
        header("Location: Professor/index.php");
    } else {
        header("Location: Student/index.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Admin/styles.css">
</head>
<body>
    <header>
        <h1>University Management System</h1>
    </header>

    <main>
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <label for="username">Përdoruesi:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
