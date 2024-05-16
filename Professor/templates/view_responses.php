<table>
    <thead>
        <tr>
            <th>Detyra</th>
            <th>Studenti</th>
            <th>Përgjigja</th>
            <th>Data e Dorëzimit</th>
            <th>Vendos Nota</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($responses as $response): ?>
        <tr>
            <td><?php echo htmlspecialchars($response['Title']); ?></td>
            <td><?php echo htmlspecialchars($response['Name']); ?></td>
            <td><?php echo htmlspecialchars($response['Response']); ?></td>
            <td><?php echo htmlspecialchars($response['SubmittedAt']); ?></td>
            <td><a href="grade_response.php?assignment_id=<?php echo $response['AssignmentID']; ?>&student_id=<?php echo $response['StudentID']; ?>">Vendos Nota</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
