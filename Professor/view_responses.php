<?php
session_start();
if ($_SESSION['user_type'] != 'Professor') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';

function getResponsesByProfessor($professorID) {
    global $conn;
    $stmt = $conn->prepare("SELECT ar.*, a.Title, u.Name FROM AssignmentResponses ar 
                            JOIN Assignments a ON ar.AssignmentID = a.AssignmentID 
                            JOIN Users u ON ar.StudentID = u.UserID 
                            WHERE a.ProfessorID = ?");
    $stmt->bind_param("i", $professorID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

$responses = getResponsesByProfessor($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Përgjigjet e Studentëve</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Përgjigjet e Studentëve</h1>
        <?php include 'templates/view_responses.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
