<table>
    <thead>
        <tr>
            <th>Lënda</th>
            <th>Titulli</th>
            <th>Përshkrimi</th>
            <th>Data e Afatit</th>
            <th>Veprimi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($assignments)): ?>
            <tr>
                <td colspan="5">Nuk ka detyra për t'u shfaqur.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($assignments as $assignment): ?>
            <tr>
                <td><?php echo htmlspecialchars($assignment['SubjectName']); ?></td>
                <td><?php echo htmlspecialchars($assignment['Title']); ?></td>
                <td><?php echo htmlspecialchars($assignment['Description']); ?></td>
                <td><?php echo htmlspecialchars($assignment['DueDate']); ?></td>
                <td><a href="submit_response.php?assignment_id=<?php echo $assignment['AssignmentID']; ?>">Dorëzo Përgjigjjen</a></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
