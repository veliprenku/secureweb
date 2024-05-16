<?php
require 'db.php';
require 'csrf.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function registerAdmin($username, $password, $name, $email) {
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO Users (Username, Password, Name, Email, UserType) VALUES (?, ?, ?, ?, 'Admin')");
    $stmt->bind_param("ssss", $username, $passwordHash, $name, $email);

    if ($stmt->execute()) {
        echo "Admini u regjistrua me sukses.";
    } else {
        echo "Gabim gjatë regjistrimit. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);
    $name = sanitizeInput($_POST['name']);
    $email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);

    if ($email === false) {
        echo "Emaili është i pavlefshëm.";
    } else {
        registerAdmin($username, $password, $name, $email);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistro Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Regjistro Admin</h1>
    </header>

    <main>
        <form action="register_admin.php" method="post">
            <label for="username">Përdoruesi:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <input type="submit" value="Regjistro">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
