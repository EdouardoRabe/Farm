<?php
if (isset($_GET['error'])) {
    echo "<div class='error'>Une erreur s'est produite lors de l'ajout de l'achat.</div>";
}
?>

<div class="login container grid" id="loginAccessRegister">
         <!--===== LOGIN ACCESS =====-->

        

         <div class="login__access">
<h1 class="login__title"><?= $title ?></h1>
<div class="login__area">
<form method="post" action="<?= $redirect ?>" enctype="multipart/form-data" class="login__form">

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
            
                <label for="min_<?= $columnName ?>">Min <?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                <input type="<?= $inputType ?>" name="min_<?= $columnName ?>" id="min_<?= $columnName ?>" class="form-control"
                    <?= $required ?>>
            
            
                <label for="max_<?= $columnName ?>">Max <?= ucfirst(str_replace('_', ' ', $columnName)) ?></label>
                <input type="<?= $inputType ?>" name="max_<?= $columnName ?>" id="max_<?= $columnName ?>" class="form-control"
                    <?= $required ?>>
           
        <?php else: ?>

            
            
            <div class="login__box">
                <?php if ($inputType === 'textarea'): ?>
                    <textarea name="<?= $columnName ?>" id="<?= $columnName ?>"  <?= $required ?>></textarea>
                <?php else: ?>

                    
                    <input type="<?= $inputType ?>" name="<?= $columnName ?>" id="<?= $columnName ?>" <?= $inputType === 'file' ? 'accept="image/*"' : '' ?>         required placeholder=" "    class="login__input">
                    <label for="email" class="login__label"><?= $columnName ?></label>

                <?php endif; ?>
            </div>
        <?php endif;
    endforeach; ?>


</div>

    <button type="submit" class="login__button">Envoyer</button>

</form>
</div>
</div>
</div>



