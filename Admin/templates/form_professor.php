<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $action == 'register_professor' ? 'Regjistro' : 'Edito'; ?> Profesor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo $action == 'register_professor' ? 'Regjistro' : 'Edito'; ?> Profesor</h1>
    </header>

    <main>
        <form action="index.php?action=<?php echo $action; ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <?php if (isset($professor)): ?>
                <input type="hidden" name="user_id" value="<?php echo $professor['UserID']; ?>">
            <?php endif; ?>
            <label for="username">Përdoruesi:</label>
            <input type="text" id="username" name="username" value="<?php echo $professor['Username'] ?? ''; ?>" required><br>

            <label for="password">Fjalëkalimi:</label>
            <input type="password" id="password" name="password" <?php echo $action == 'edit_professor' ? '' : 'required'; ?>><br>

            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" value="<?php echo $professor['Name'] ?? ''; ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $professor['Email'] ?? ''; ?>" required><br>

            <input type="submit" value="<?php echo $action == 'register_professor' ? 'Regjistro' : 'Përditëso'; ?>">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
