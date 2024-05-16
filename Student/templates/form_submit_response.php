<form action="submit_response.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
    <input type="hidden" name="assignment_id" value="<?php echo $_GET['assignment_id']; ?>">
    <label for="response">Përgjigjja:</label>
    <textarea id="response" name="response" required></textarea><br>
    <input type="submit" value="Dorëzo">
</form>
