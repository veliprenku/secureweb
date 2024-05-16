<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cakto Lëndë Profesorëve</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Cakto Lëndë Profesorëve</h1>
    </header>

    <main>
        <form action="index.php?action=assign_subject" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
            <label for="professor_id">Zgjedh Profesorin:</label>
            <select id="professor_id" name="professor_id" required>
                <?php foreach ($professors as $professor): ?>
                <option value="<?php echo $professor['UserID']; ?>"><?php echo $professor['Name']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="subject_id">Zgjedh Lëndën:</label>
            <select id="subject_id" name="subject_id" required>
                <?php foreach ($subjects as $subject): ?>
                <option value="<?php echo $subject['SubjectID']; ?>"><?php echo $subject['SubjectName']; ?></option>
                <?php endforeach; ?>
            </select><br>

            <input type="submit" value="Cakto">
        </form>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
