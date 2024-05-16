<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($action) == 'register_student' ? 'Regjistro' : 'Edito'; ?> Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo ucfirst($action) == 'register_student' ? 'Regjistro' : 'Edito'; ?> Student</h1>
    </header>

    <main>
        <form action="index.php?action=<?php echo $action; ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <?php if (isset($student)): ?>
                <input type="hidden" name="user_id" value="<?php echo $student['UserID']; ?>">
            <?php endif; ?>
            <label for="username">Përdoruesi:</label>
            <input type="text" id="username" name="username" value="<?php echo $student['Username'] ?? ''; ?>" required><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" <?php echo $action == 'edit_student' ? '' : 'required'; ?>><br>

            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" value="<?php echo $student['Name'] ?? ''; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $student['Email'] ?? ''; ?>" required><br>

            <input type="submit" value="<?php echo ucfirst($action) == 'register_student' ? 'Regjistro' : 'Përditëso'; ?>">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
