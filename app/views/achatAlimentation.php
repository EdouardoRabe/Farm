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
            <?php foreach ($data as $alimentation) : ?>
                <div class="card">
                    <img src="assets/img/<?= htmlspecialchars($alimentation['image']) ?>" alt="Image de <?= htmlspecialchars($alimentation['nom']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($alimentation['nom']) ?></h5>
                        <h5 class="card-title"><?= htmlspecialchars($alimentation['prix_achat_kg']) ?>Ar le kilo</h5>
                        <form method="POST" action="achatAlimentation">
                            <input type="hidden" name="id_alimentation" value="<?= htmlspecialchars($alimentation['id_alimentation']) ?>">
                            <input type="hidden" name="prix_achat_kg" value="<?= htmlspecialchars($alimentation['prix_achat_kg']) ?>">
                            <input type="date" name="date_achat" class="form-control mb-2" required>
                            <input type="number" name="quantiteKg" class="form-control mb-2" placeholder="Entrez la quantite" required>
                            <button type="submit">Valider</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
