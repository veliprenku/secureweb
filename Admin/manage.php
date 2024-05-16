<?php
require '../db.php';
require '../csrf.php';
require 'admin_functions.php';

$action = $_GET['action'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!verifyCSRFToken($_POST['csrf_token'])) {
        die("Token CSRF është i pavlefshëm.");
    }

    if ($action == 'register_student' || $action == 'edit_student') {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password'] ?? '');
        $name = sanitizeInput($_POST['name']);
        $email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);

        if ($email === false) {
            echo "Emaili është i pavlefshëm.";
        } else {
            if ($action == 'register_student') {
                registerUser($username, $password, $name, $email, 'Student');
            } else {
                $userID = $_POST['user_id'];
                updateUser($userID, $username, $name, $email, $password);
            }
        }
    } elseif ($action == 'register_professor' || $action == 'edit_professor') {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password'] ?? '');
        $name = sanitizeInput($_POST['name']);
        $email = filter_var(sanitizeInput($_POST['email']), FILTER_VALIDATE_EMAIL);

        if ($email === false) {
            echo "Emaili është i pavlefshëm.";
        } else {
            if ($action == 'register_professor') {
                registerUser($username, $password, $name, $email, 'Professor');
            } else {
                $userID = $_POST['user_id'];
                updateUser($userID, $username, $name, $email, $password);
            }
        }
    } elseif ($action == 'add_subject' || $action == 'edit_subject') {
        $subjectName = sanitizeInput($_POST['subject_name']);
        if ($action == 'add_subject') {
            addSubject($subjectName);
        } else {
            $subjectID = $_POST['subject_id'];
            updateSubject($subjectID, $subjectName);
        }
    } elseif ($action == 'assign_subject') {
        $professorID = sanitizeInput($_POST['professor_id']);
        $subjectID = sanitizeInput($_POST['subject_id']);
        
        // Mesazh debug për të parë vlerat
        error_log("Professori ID: $professorID, Subject ID: $subjectID");
        
        assignSubject($professorID, $subjectID);
    }
}

if ($action == 'manage_students') {
    $students = getUsersByType('Student');
    include 'templates/manage_students.php';
} elseif ($action == 'manage_professors') {
    $professors = getUsersByType('Professor');
    include 'templates/manage_professors.php';
} elseif ($action == 'manage_subjects') {
    $subjects = getSubjects();
    include 'templates/manage_subjects.php';
} elseif ($action == 'register_student' || $action == 'edit_student') {
    if ($action == 'edit_student') {
        $student = getUserByID($_GET['id']);
    }
    include 'templates/form_student.php';
} elseif ($action == 'register_professor' || $action == 'edit_professor') {
    if ($action == 'edit_professor') {
        $professor = getUserByID($_GET['id']);
    }
    include 'templates/form_professor.php';
} elseif ($action == 'add_subject' || $action == 'edit_subject') {
    if ($action == 'edit_subject') {
        $subject = getSubjectByID($_GET['id']);
    }
    include 'templates/form_subject.php';
} elseif ($action == 'assign_subject') {
    $professors = getUsersByType('Professor');
    $subjects = getSubjects();
    include 'templates/form_assign_subject.php';
} elseif (str_starts_with($action, 'delete_')) {
    if ($action == 'delete_student') {
        deleteUser($_GET['id'], 'Student');
    } elseif ($action == 'delete_professor') {
        deleteUser($_GET['id'], 'Professor');
    } elseif ($action == 'delete_subject') {
        deleteSubject($_GET['id']);
    }
    header("Location: index.php?action=manage_" . explode('_', $action)[1] . "s");
    exit();
}

$conn->close();
?>
