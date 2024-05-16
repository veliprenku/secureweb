<?php
require '../db.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function registerUser($username, $password, $name, $email, $userType) {
    global $conn;
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO Users (Username, Password, Name, Email, UserType) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $passwordHash, $name, $email, $userType);

    if ($stmt->execute()) {
        echo ucfirst($userType) . " u regjistrua me sukses.";
    } else {
        echo "Gabim gjatë regjistrimit. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

function updateUser($userID, $username, $name, $email, $password = null) {
    global $conn;
    if ($password) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("UPDATE Users SET Username = ?, Password = ?, Name = ?, Email = ? WHERE UserID = ?");
        $stmt->bind_param("ssssi", $username, $passwordHash, $name, $email, $userID);
    } else {
        $stmt = $conn->prepare("UPDATE Users SET Username = ?, Name = ?, Email = ? WHERE UserID = ?");
        $stmt->bind_param("sssi", $username, $name, $email, $userID);
    }

    if ($stmt->execute()) {
        echo "Përdoruesi u përditësua me sukses.";
    } else {
        echo "Gabim gjatë përditësimit. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

function deleteUser($userID, $userType) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Users WHERE UserID = ? AND UserType = ?");
    $stmt->bind_param("is", $userID, $userType);

    if ($stmt->execute()) {
        echo ucfirst($userType) . " u fshi me sukses.";
    } else {
        echo "Gabim gjatë fshirjes. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

function getUsersByType($userType) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Users WHERE UserType = ?");
    $stmt->bind_param("s", $userType);
    $stmt->execute();
    $result = $stmt->get_result();
    $users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $users;
}

function getUserByID($userID) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

function addSubject($subjectName) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Subjects (SubjectName) VALUES (?)");
    $stmt->bind_param("s", $subjectName);

    if ($stmt->execute()) {
        echo "Lënda u shtua me sukses.";
    } else {
        echo "Gabim gjatë shtimit të lëndës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

function updateSubject($subjectID, $subjectName) {
    global $conn;
    $stmt = $conn->prepare("UPDATE Subjects SET SubjectName = ? WHERE SubjectID = ?");
    $stmt->bind_param("si", $subjectName, $subjectID);

    if ($stmt->execute()) {
        echo "Lënda u përditësua me sukses.";
    } else {
        echo "Gabim gjatë përditësimit të lëndës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
}

function deleteSubject($subjectID) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM Subjects WHERE SubjectID = ?");
    $stmt->bind_param("i", $subjectID);

    if ($stmt->execute()) {
        echo "Lënda u fshi me sukses.";
    } else {
        echo "Gabim gjatë fshirjes së lëndës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
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

function getSubjectByID($subjectID) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Subjects WHERE SubjectID = ?");
    $stmt->bind_param("i", $subjectID);
    $stmt->execute();
    $result = $stmt->get_result();
    $subject = $result->fetch_assoc();
    $stmt->close();
    return $subject;
}

function assignSubject($professorID, $subjectID) {
    global $conn;
    error_log("ProfessorID: " . $professorID);
    error_log("SubjectID: " . $subjectID);

    $stmt = $conn->prepare("UPDATE Subjects SET ProfessorID = ? WHERE SubjectID = ?");
    if (!$stmt) {
        error_log("Gabim në përgatitjen e deklaratës: " . $conn->error);
        die("Gabim në përgatitjen e deklaratës.");
    }

    $stmt->bind_param("ii", $professorID, $subjectID);

    if ($stmt->execute()) {
        echo "Lënda u caktua me sukses.";
    } else {
        echo "Gabim gjatë caktimit të lëndës. Ju lutemi provoni përsëri.";
    }
    $stmt->close();
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
?>
