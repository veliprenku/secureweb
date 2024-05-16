<?php
session_start();
if ($_SESSION['user_type'] != 'Student') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';

function getAssignmentsForStudent($studentID) {
    global $conn;
    $stmt = $conn->prepare("SELECT a.AssignmentID, a.Title, a.Description, a.DueDate, s.SubjectName 
                            FROM Assignments a 
                            JOIN Subjects s ON a.SubjectID = s.SubjectID");
    if ($stmt === false) {
        error_log("Gabim në përgatitjen e deklaratës: " . $conn->error);
        die("Gabim në përgatitjen e deklaratës.");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result === false) {
        error_log("Gabim në ekzekutimin e query-t: " . $stmt->error);
        die("Gabim në ekzekutimin e query-t.");
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

$assignments = getAssignmentsForStudent($_SESSION['user_id']);
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
