<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menaxho Lëndët</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Menaxho Lëndët</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Emri i Lëndës</th>
                    <th>ID i Profesorit</th>
                    <th>Veprime</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subjects as $subject): ?>
                <tr>
                    <td><?php echo $subject['SubjectID']; ?></td>
                    <td><?php echo $subject['SubjectName']; ?></td>
                    <td><?php echo $subject['ProfessorID']; ?></td>
                    <td>
                        <a href="index.php?action=edit_subject&id=<?php echo $subject['SubjectID']; ?>">Edito</a> |
                        <a href="index.php?action=delete_subject&id=<?php echo $subject['SubjectID']; ?>" onclick="return confirm('A jeni i sigurt që doni të fshini këtë lëndë?');">Fshi</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=add_subject">Shto Lëndë të Re</a>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
