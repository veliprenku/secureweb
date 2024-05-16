<?php
session_start();
if ($_SESSION['user_type'] != 'Professor') {
    header("Location: http://localhost/secureweb/index.php");
    exit();
}
require '../db.php';
require '../csrf.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function getSubjects() {
    global $conn;
    $result = $conn->query("SELECT SubjectID, SubjectName FROM Subjects");
    if (!$result) {
        error_log("Gabim në query: " . $conn->error);
        die("Gabim në query.");
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

function createAssignment($subjectID, $professorID, $title, $description, $dueDate) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Assignments (SubjectID, ProfessorID, Title, Description, DueDate) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        error_log("Gabim gjatë përgatitjes së deklaratës: " . $conn->error);
        die("Gabim gjatë përgatitjes së deklaratës.");
    }
    $stmt->bind_param("iisss", $subjectID, $professorID, $title, $description, $dueDate);

    if ($stmt->execute()) {
        echo "Detyra u krijua me sukses.";
    } else {
        error_log("Gabim gjatë ekzekutimit: " . $stmt->error);
        echo "Gabim gjatë krijimit të detyrës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Token CSRF është i pavlefshëm.");
    }

    $subjectID = sanitizeInput($_POST['subject_id']);
    $title = sanitizeInput($_POST['title']);
    $description = sanitizeInput($_POST['description']);
    $dueDate = sanitizeInput($_POST['due_date']);
    
    error_log("Të dhënat: SubjectID: $subjectID, Title: $title, Description: $description, DueDate: $dueDate");
    createAssignment($subjectID, $_SESSION['user_id'], $title, $description, $dueDate);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shto Detyrë</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Shto Detyrë</h1>
        <?php include 'templates/form_add_assignment.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
