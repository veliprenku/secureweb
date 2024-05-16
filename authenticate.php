<?php
session_start();
require 'db.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST['username']);
    $password = sanitizeInput($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = ?");
    if ($stmt === false) {
        error_log("Gabim gjatë përgatitjes së deklaratës: " . $conn->error);
        die("Gabim gjatë përgatitjes së deklaratës.");
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['username'] = $user['Username'];
            $_SESSION['user_type'] = $user['UserType'];

            if ($user['UserType'] == 'Admin') {
                header("Location: Admin/index.php");
            } elseif ($user['UserType'] == 'Professor') {
                header("Location: Professor/index.php");
            } else {
                header("Location: Student/index.php");
            }
            exit();
        } else {
            echo "Fjalëkalimi është i gabuar.";
        }
    } else {
        echo "Përdoruesi nuk ekziston.";
    }
    $stmt->close();
}

$conn->close();
?>
