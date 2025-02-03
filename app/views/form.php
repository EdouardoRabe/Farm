<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?= $title ?></h1>
        <form method="post" action="<?= $redirect ?>">
            <?php foreach ($hidden as $hiddenName => $hiddenValue): ?>
                <input type="hidden" name="<?= $hiddenName ?>" value="<?= $hiddenValue ?>">
            <?php endforeach; ?>

            <?php foreach ($columns as $column): 
                $columnName = $column['Field'];
                $columnType = strtolower($column['Type']);
                
                if (in_array($columnName, $omitColumns)) continue;
                
                $inputType = 'text';
                if ($columnName === 'password') {
                    $inputType = 'password';
                } else {
                    foreach ($columnTypes as $dbType => $inputTypeValue) {
                        if (strpos($columnType, $dbType) !== false) {
                            $inputType = $inputTypeValue;
                            break;
                        }
                    }
                }
                
                $required = $canNull ? '' : 'required';
                
                if (in_array($columnName, $numericDouble)): ?>
                    <div class="form-group">
                        <label for="min_<?= $columnName ?>">Min <?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                        <input type="<?= $inputType ?>" 
                               name="min_<?= $columnName ?>" 
                               id="min_<?= $columnName ?>" 
                               class="form-control" 
                               <?= $required ?>>
                    </div>
                    <div class="form-group">
                        <label for="max_<?= $columnName ?>">Max <?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                        <input type="<?= $inputType ?>" 
                               name="max_<?= $columnName ?>" 
                               id="max_<?= $columnName ?>" 
                               class="form-control" 
                               <?= $required ?>>
                    </div>
                <?php else: ?>
                    <div class="form-group">
                        <label for="<?= $columnName ?>"><?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                        <?php if ($inputType === 'textarea'): ?>
                            <textarea name="<?= $columnName ?>" 
                                      id="<?= $columnName ?>" 
                                      class="form-control" 
                                      <?= $required ?>></textarea>
                        <?php else: ?>
                            <input type="<?= $inputType ?>" 
                                   name="<?= $columnName ?>" 
                                   id="<?= $columnName ?>" 
                                   class="form-control" 
                                   <?= $required ?>>
                        <?php endif; ?>
                    </div>
                <?php endif;
            endforeach; ?>
            
            <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
        </form>
    </div>
</body>
</html>