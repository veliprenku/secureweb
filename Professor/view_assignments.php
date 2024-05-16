<?php
session_start();
if ($_SESSION['user_type'] != 'Professor') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';

function getAssignmentsByProfessor($professorID) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Assignments WHERE ProfessorID = ?");
    $stmt->bind_param("i", $professorID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

$assignments = getAssignmentsByProfessor($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detyrat e Mia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Detyrat e Mia</h1>
        <?php include 'templates/view_assignments.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
