<table>
    <thead>
        <tr>
            <th>Titulli</th>
            <th>Përshkrimi</th>
            <th>Data e Afatit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($assignments as $assignment): ?>
        <tr>
            <td><?php echo htmlspecialchars($assignment['Title']); ?></td>
            <td><?php echo htmlspecialchars($assignment['Description']); ?></td>
            <td><?php echo htmlspecialchars($assignment['DueDate']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
