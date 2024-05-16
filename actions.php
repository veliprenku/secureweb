<?php
require 'db.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Token CSRF është i pavlefshëm.");
    }

    if (isset($_POST['register_student'])) {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);
        $name = sanitizeInput($_POST['name']);
        $email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);

        if ($email === false) {
            echo "Emaili është i pavlefshëm.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO Users (Username, Password, Name, Email, UserType) VALUES (?, ?, ?, ?, 'Student')");
            $stmt->bind_param("ssss", $username, $passwordHash, $name, $email);

            if ($stmt->execute()) {
                echo "Studenti u regjistrua me sukses.";
            } else {
                echo "Gabim gjatë regjistrimit. Ju lutemi provoni përsëri.";
            }

            $stmt->close();
        }
    }

    /
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'register_student') {
        ?>
        <h2>Regjistro Student</h2>
        <form action="dashboard.php?action=register_student" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <label for="username">Përdoruesi:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <input type="submit" name="register_student" value="Regjistro">
        </form>
        <?php
    }

}
?>
