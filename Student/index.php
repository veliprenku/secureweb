<?php
session_start();
if ($_SESSION['user_type'] != 'Student') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard i Studentit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Mirë se vini, Student</h1>
        <ul>
            <li><a href="view_assignments.php">Shiko Detyrat</a></li>
            <li><a href="view_grades.php">Shiko Notat</a></li>
        </ul>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
