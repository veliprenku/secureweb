<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($action) == 'add_subject' ? 'Shto' : 'Edito'; ?> Lëndë</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?php echo ucfirst($action) == 'add_subject' ? 'Shto' : 'Edito'; ?> Lëndë</h1>
    </header>

    <main>
        <form action="index.php?action=<?php echo $action; ?>" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <?php if (isset($subject)): ?>
                <input type="hidden" name="subject_id" value="<?php echo $subject['SubjectID']; ?>">
            <?php endif; ?>
            <label for="subject_name">Emri i Lëndës:</label>
            <input type="text" id="subject_name" name="subject_name" value="<?php echo $subject['SubjectName'] ?? ''; ?>" required><br>
            <input type="submit" value="<?php echo ucfirst($action) == 'add_subject' ? 'Shto' : 'Përditëso'; ?>">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
