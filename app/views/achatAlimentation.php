<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Pet Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/achat.css" rel="stylesheet">

</head>
<body>



<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand ms-lg-5">
            <h1 class="m-0 text-uppercase text-dark"><i class="bi bi-shop fs-1 text-primary me-3"></i>Farm Shop</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="accueil" class="nav-item nav-link">Home</a>
                <a href="tableAchat" class="nav-item nav-link ">Achat</a>
                <a href="venteAnimal" class="nav-item nav-link ">Vente</a>
                <a href="tableAchatAlimentation" class="nav-item nav-link active">Alimentation</a>
               
                <a href="/ETU003285/20250204" class="nav-item nav-link nav-contact bg-primary text-white px-5 ms-lg-5">Log out <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </nav>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="border-start border-5 border-primary ps-5 mb-5" style="max-width: 600px;">
                <h6 class="text-primary text-uppercase">Farm Shop</h6>
                <h1 class="display-5 text-uppercase mb-0">Achat Animaux</h1>
            </div>

            </div>
            </div>


    <div class="container">
         <?php if (isset($_GET['error'])) : ?>
                <div class="error-message">
                    ❌ Une erreur s'est produite lors de l'ajout de l'achat. Veuillez réessayer !
                </div>
            <?php endif; ?>
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

    <footer>
    <div class="footer-content">
      <p>&copy; 2025 MonSiteWeb. Tous droits réservés.</p>
      <ul class="social-links">
        <li><h1><a href="#" class="social-link">ETU003169 - TOAVINA</a></h1></li>
        <li><h1><a href="#" class="social-link">ETU003285 - EDOUARDO</a></h1></li>
        <li><h1><a href="#" class="social-link">ETU003263 - MITIA</a></h1></li>
      </ul>
    </div>
  </footer>
</body>
</html>
