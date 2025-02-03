<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/achat.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="grid-container">
            <?php foreach ($data as $animal) : ?>
                <div class="card">
                    <img src="assets/img/<?= htmlspecialchars($animal['image']) ?>" alt="Image de <?= htmlspecialchars($animal['espece']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($animal['espece']) ?></h5>
                        <h5 class="card-title"><?= htmlspecialchars($animal['prix_achat_kg']) ?> le kilo</h5>
                        <form method="POST" action="achat">
                            <input type="hidden" name="id_typeAnimal" value="<?= htmlspecialchars($animal['id_typeAnimal']) ?>">
                            <input type="hidden" name="prix_achat_kg" value="<?= htmlspecialchars($animal['prix_achat_kg']) ?>">
                            <input type="number" name="poids_initial" class="form-control mb-2" placeholder="Entrez le poids" required>
                            <button type="submit">Valider</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>