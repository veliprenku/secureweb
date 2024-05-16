<form action="grade_response.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <input type="hidden" name="assignment_id" value="<?php echo $_GET['assignment_id']; ?>">
    <input type="hidden" name="student_id" value="<?php echo $_GET['student_id']; ?>">
    <label for="grade">Nota:</label>
    <input type="number" id="grade" name="grade" step="0.01" min="0" max="100" required><br>
    <input type="submit" value="Vendos Nota">
</form>
