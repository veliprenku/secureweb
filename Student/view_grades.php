<?php
session_start();
if ($_SESSION['user_type'] != 'Student') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';

function getGradesForStudent($studentID) {
    global $conn;
    $stmt = $conn->prepare("SELECT g.Grade, g.GradedAt, a.Title, s.SubjectName 
                            FROM Grades g 
                            JOIN Assignments a ON g.AssignmentID = a.AssignmentID 
                            JOIN Subjects s ON a.SubjectID = s.SubjectID 
                            WHERE g.StudentID = ?");
    $stmt->bind_param("i", $studentID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

$grades = getGradesForStudent($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notat e Mia</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Notat e Mia</h1>
        <?php include 'templates/view_grades.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
