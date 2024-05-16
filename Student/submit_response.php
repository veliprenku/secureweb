<?php
session_start();
if ($_SESSION['user_type'] != 'Student') {
    header("Location: ../login.php");
    exit();
}
require '../db.php';
require '../csrf.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function submitAssignmentResponse($assignmentID, $studentID, $response) {
    global $conn;
    $submittedAt = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("INSERT INTO AssignmentResponses (AssignmentID, StudentID, Response, SubmittedAt) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        error_log("Gabim gjatë përgatitjes së deklaratës: " . $conn->error);
        die("Gabim gjatë përgatitjes së deklaratës.");
    }
    $stmt->bind_param("iiss", $assignmentID, $studentID, $response, $submittedAt);

    if ($stmt->execute()) {
        echo "Përgjigjja e detyrës u dorëzua me sukses.";
    } else {
        error_log("Gabim gjatë ekzekutimit: " . $stmt->error);
        echo "Gabim gjatë dorëzimit të përgjigjjes. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Token CSRF është i pavlefshëm.");
    }

    $assignmentID = sanitizeInput($_POST['assignment_id']);
    $response = sanitizeInput($_POST['response']);
    
    error_log("Të dhënat: AssignmentID: $assignmentID, Response: $response");
    submitAssignmentResponse($assignmentID, $_SESSION['user_id'], $response);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dorëzo Përgjigjjen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'templates/header.php'; ?>
    <main>
        <h1>Dorëzo Përgjigjjen</h1>
        <?php include 'templates/form_submit_response.php'; ?>
    </main>
    <?php include 'templates/footer.php'; ?>
</body>
</html>
