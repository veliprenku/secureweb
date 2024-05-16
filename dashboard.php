<?php
session_start();
require 'db.php';
require 'csrf.php';

if (!isset($_SESSION['user_type'])) {
    header("Location: index.php");
    exit();
}

$userType = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($userType); ?> Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo ucfirst($userType); ?> Dashboard</h1>
        <nav>
            <ul>
                <?php if ($userType == 'Admin'): ?>
                    <li><a href="dashboard.php?action=register_student">Regjistro Student</a></li>
                    <li><a href="dashboard.php?action=register_professor">Regjistro Profesor</a></li>
                    <li><a href="dashboard.php?action=manage_students">Menaxho Studentët</a></li>
                    <li><a href="dashboard.php?action=manage_professors">Menaxho Profesorët</a></li>
                    <li><a href="dashboard.php?action=manage_subjects">Menaxho Lëndët</a></li>
                    <li><a href="dashboard.php?action=assign_subject">Cakto Lëndë Profesorëve</a></li>
                <?php elseif ($userType == 'Professor'): ?>
                    <!-- Lidhje për profesorët -->
                <?php else: ?>
                    <!-- Lidhje për studentët -->
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?php if (isset($_GET['action'])): ?>
            <?php include 'actions.php'; ?>
        <?php else: ?>
            <h2>Mirë se vini në Dashboard</h2>
            <p>Zgjidh një veprim nga menuja.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
