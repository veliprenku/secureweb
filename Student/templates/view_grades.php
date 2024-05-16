<table>
    <thead>
        <tr>
            <th>Lënda</th>
            <th>Detyra</th>
            <th>Nota</th>
            <th>Data e Vlerësimit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($grades as $grade): ?>
        <tr>
            <td><?php echo htmlspecialchars($grade['SubjectName']); ?></td>
            <td><?php echo htmlspecialchars($grade['Title']); ?></td>
            <td><?php echo htmlspecialchars($grade['Grade']); ?></td>
            <td><?php echo htmlspecialchars($grade['GradedAt']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
