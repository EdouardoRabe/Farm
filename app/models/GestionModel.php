<?php 
namespace app\models;

class GestionModel{
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }


    function calculerCapital($date) {
        $queryCapitaux = "SELECT SUM(montant) AS total_capitaux FROM ferme_gestion_capitaux WHERE capitaux_date <= :date";
        $stmt = $this->bdd->prepare($queryCapitaux);
        $stmt->execute(['date'=>$date]);
        echo "Date utilisée pour la requête: " . $date . "<br>";
        $capitaux = $stmt->fetch()['total_capitaux'] ?? 0;
        $queryAchatAnimal = "SELECT SUM(montant) AS total_achat_animal FROM ferme_achat_animal WHERE date_achat <= :date";
        $stmt = $this->bdd->prepare($queryAchatAnimal);
        $stmt->execute(['date'=>$date]);
        $achatAnimal = $stmt->fetch()['total_achat_animal'] ?? 0;
        $queryAchatAlimentation = "SELECT SUM(montant) AS total_achat_aliment FROM ferme_achat_alimentation WHERE date_achat <= :date";
        $stmt = $this->bdd->prepare($queryAchatAlimentation);
        $stmt->execute(['date'=>$date]);
        $achatAlimentation = $stmt->fetch()['total_achat_aliment'] ?? 0;
        $queryVenteAnimal = "SELECT SUM(prix_vente) AS total_vente_animal FROM ferme_vente_animal WHERE date_vente <= :date";
        $stmt = $this->bdd->prepare($queryVenteAnimal);
        $stmt->execute(['date'=>$date]);
        $venteAnimal = $stmt->fetch()['total_vente_animal'] ?? 0;
        $capital = ($capitaux + $venteAnimal) - ($achatAnimal + $achatAlimentation);
        return $capital;
    }
    

}
?>