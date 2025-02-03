<h1 class="login__title"><?= $title ?></h1>
<form method="post" action="<?= $redirect ?>" enctype="multipart/form-data">
    <div class="login__content grid">
        <?php foreach ($hidden as $hiddenName => $hiddenValue): ?>
            <input type="hidden" name="<?= $hiddenName ?>" value="<?= $hiddenValue ?>">
        <?php endforeach; ?>

        <?php foreach ($columns as $column):
            $columnName = $column['Field'];
            $columnType = strtolower($column['Type']);

            if (in_array($columnName, $omitColumns))
                continue;

            $inputType = 'text';
            if ($columnName === 'password') {
                $inputType = 'password';
            } elseif (strpos($columnName, 'image') !== false) {
                $inputType = 'file';
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
                    <input type="<?= $inputType ?>" name="min_<?= $columnName ?>" id="min_<?= $columnName ?>"
                        class="form-control" <?= $required ?>>
                </div>
                <div class="form-group">
                    <label for="max_<?= $columnName ?>">Max <?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                    <input type="<?= $inputType ?>" name="max_<?= $columnName ?>" id="max_<?= $columnName ?>"
                        class="form-control" <?= $required ?>>
                </div>
            <?php else: ?>


                <label for="<?= $columnName ?>"><?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                <?php if ($inputType === 'textarea'): ?>
                    <textarea name="<?= $columnName ?>" id="<?= $columnName ?>" class="form-control" <?= $required ?>></textarea>
                <?php else: ?>

                    <div class="login__box">
                        <input type="<?= $inputType ?>" name="<?= $columnName ?>" id="<?= $columnName ?>" <?= $inputType === 'file' ? 'accept="image/*"' : '' ?> <?= $required ?>class="login__input">
                    <?php endif; ?>
                    </div>

            <?php endif;
        endforeach; ?>


    </div>

    <button type="submit" class="login__button">Envoyer</button>

</form>