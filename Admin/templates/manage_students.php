<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menaxho Studentët</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Menaxho Studentët</h1>
    </header>

    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Përdoruesi</th>
                    <th>Emri</th>
                    <th>Email</th>
                    <th>Veprime</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['UserID']; ?></td>
                    <td><?php echo $student['Username']; ?></td>
                    <td><?php echo $student['Name']; ?></td>
                    <td><?php echo $student['Email']; ?></td>
                    <td>
                        <a href="index.php?action=edit_student&id=<?php echo $student['UserID']; ?>">Edito</a> |
                        <a href="index.php?action=delete_student&id=<?php echo $student['UserID']; ?>" onclick="return confirm('A jeni i sigurt që doni të fshini këtë student?');">Fshi</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=register_student">Shto Student</a>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
