<form action="add_assignment.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <label for="subject_id">Zgjedh Lëndën:</label>
    <select id="subject_id" name="subject_id" required>
        <?php
        $subjects = getSubjects();
        foreach ($subjects as $subject): ?>
            <option value="<?php echo $subject['SubjectID']; ?>"><?php echo $subject['SubjectName']; ?></option>
        <?php endforeach; ?>
    </select><br>
    <label for="title">Titulli:</label>
    <input type="text" id="title" name="title" required><br>
    <label for="description">Përshkrimi:</label>
    <textarea id="description" name="description" required></textarea><br>
    <label for="due_date">Data e Afatit:</label>
    <input type="datetime-local" id="due_date" name="due_date" required><br>
    <input type="submit" value="Shto Detyrë">
</form>
