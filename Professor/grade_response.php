<?php
session_start();
if ($_SESSION['user_type'] != 'Professor') {
    header("Location: http://localhost/secureweb/index.php");
    exit();
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}


require '../db.php';
require '../csrf.php';


function gradeAssignment($assignmentID, $studentID, $grade) {
    global $conn;
    $gradedAt = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO Grades (AssignmentID, StudentID, Grade, GradedAt) VALUES (?, ?, ?, ?) 
                            ON DUPLICATE KEY UPDATE Grade = VALUES(Grade), GradedAt = VALUES(GradedAt)");
    if ($stmt === false) {
        error_log("Gabim gjatë përgatitjes së deklaratës: " . $conn->error);
        die("Gabim gjatë përgatitjes së deklaratës.");
    }
    $stmt->bind_param("iiss", $assignmentID, $studentID, $grade, $gradedAt);

    if ($stmt->execute()) {
        echo "Nota u vendos me sukses.";
    } else {
        error_log("Gabim gjatë ekzekutimit: " . $stmt->error);
        echo "Gabim gjatë vendosjes së notës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Token CSRF është i pavlefshëm.");
    }

    $assignmentID = sanitizeInput($_POST['assignment_id']);
    $studentID = sanitizeInput($_POST['student_id']);
    $grade = sanitizeInput($_POST['grade']);

    error_log("Assignment ID: $assignmentID, Student ID: $studentID, Grade: $grade");

    gradeAssignment($assignmentID, $studentID, $grade);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendos Nota</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Vendos Nota</h1>
        <?php include 'templates/form_grade_response.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
