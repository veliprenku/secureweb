<?php
session_start();
if ($_SESSION['user_type'] != 'Professor') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard i Profesorit</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Mirë se vini, Profesor</h1>
        <ul>
            <li><a href="add_assignment.php">Shto Detyrë</a></li>
            <li><a href="view_assignments.php">Shiko Detyrat</a></li>
            <li><a href="view_responses.php">Shiko Përgjigjet e Studentëve</a></li>
            
        </ul>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
