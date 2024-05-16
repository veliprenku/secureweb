<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'Admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="index.php?action=manage_students">Menaxho Studentët</a></li>
                <li><a href="index.php?action=manage_professors">Menaxho Profesorët</a></li>
                <li><a href="index.php?action=manage_subjects">Menaxho Lëndët</a></li>
                <li><a href="index.php?action=assign_subject">Cakto Lëndë Profesorëve</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($_GET['action'])): ?>
            <?php include 'manage.php'; ?>
        <?php else: ?>
            <h2>Mirë se vini në Admin Dashboard</h2>
            <p>Zgjidh një veprim nga menuja.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
