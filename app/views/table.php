

<?php if (!empty($data)) { ?>
    <form method="post" action="<?= $redirectForm ?>" enctype="multipart/form-data">
        <table>
            <thead>
                <tr>
                    <?php foreach (array_keys($data[0]) as $header): ?>
                        <?php if (!is_numeric($header) && !in_array($header, $omitColumns)): ?>
                            <th><?= htmlspecialchars($header) ?></th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $key => $value): ?>
                            <?php if (!is_numeric($key) && !in_array($key, $omitColumns)): ?>
                                <td>
                                    <?php if ($key === 'image'): ?>
                                        <?php if (!empty($value)): ?>
                                            <img src="assets/img/<?= htmlspecialchars($value) ?>" alt="Image" style="max-width: 100px; height: auto; margin-top: 5px;">
                                        <?php endif; ?>
                                        
                                        <input 
                                            type="file" 

                                            name="<?= $key ?>[]" 
                                            class="form-control mt-2"
                                        >
                                        
                                        <input 
                                            type="hidden" 
                                            name="old_<?= $key ?>[]" 
                                            value="<?= htmlspecialchars($value) ?>"
                                        >

                                    <?php else: ?>
                                        <input 
                                            type="<?= $columnTypes[$key] ?? 'text' ?>" 

                                            name="<?= $key ?>[]" 
                                            value="<?= htmlspecialchars($value) ?>" 
                                            class="form-control"
                                        >
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <input type="hidden" name="<?= $column ?>[]" value="<?= htmlspecialchars($row[$column]) ?>">
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </form>
<?php } else { ?>
    <p>Aucune donnée disponible.</p>
<?php } ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('change', function() {
            this.classList.add('bg-warning', 'text-dark');
        });
    });
});
</script>


