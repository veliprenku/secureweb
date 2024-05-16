<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menaxho Profesorët</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Menaxho Profesorët</h1>
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
                <?php foreach ($professors as $professor): ?>
                <tr>
                    <td><?php echo $professor['UserID']; ?></td>
                    <td><?php echo $professor['Username']; ?></td>
                    <td><?php echo $professor['Name']; ?></td>
                    <td><?php echo $professor['Email']; ?></td>
                    <td>
                        <a href="index.php?action=edit_professor&id=<?php echo $professor['UserID']; ?>">Edito</a> |
                        <a href="index.php?action=delete_professor&id=<?php echo $professor['UserID']; ?>" onclick="return confirm('A jeni i sigurt që doni të fshini këtë profesor?');">Fshi</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=register_professor">Shto Profesor</a>
    </main>

    <footer>
        <p>&copy; 2024 University Management System</p>
    </footer>
</body>
</html>
