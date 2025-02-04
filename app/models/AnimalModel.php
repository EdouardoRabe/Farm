<?php

namespace app\models;

use DateTime;
use Flight;
use PDO;

class AnimalModel
{
    private $bdd;

    public function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    function calculerStockAnimaux($dateDebut, $dateFin, $id_user)
    {
        $stockAnimaux = 0;
        $stockNourriture = 0;
        $capitaux = 0;
        $animaux = [];

        $date = new DateTime($dateDebut);
        $dateFin = new DateTime($dateFin);


        while ($date <= $dateFin) {
            $dateStr = $date->format('Y-m-d');

            // 1. Achats d'animaux
            $sqlAchat = "SELECT a.id_animal, animal.id_typeAnimal, a.date_achat, ta.prix_achat_kg ,ta.image,animal.poids_initial,a.auto_vente,ta.poids_minimal_vente,ta.espece,ta.prix_vente_kg 
                        FROM ferme_achat_animal a
                        JOIN ferme_animal animal ON animal.id_animal = a.id_animal
                        JOIN ferme_type_animal ta ON animal.id_typeAnimal = ta.id_typeAnimal
                        WHERE a.date_achat = :date";

            $stmtAchat = $this->bdd->prepare($sqlAchat);
            $stmtAchat->execute(['date' => $dateStr]);


            while ($achat = $stmtAchat->fetch(PDO::FETCH_ASSOC)) {
                $animaux[] = [
                    'id_animal' => $achat['id_animal'],
                    'id_typeAnimal' => $achat['id_typeAnimal'],
                    'date_achat' => $achat['date_achat'],
                    'prix_achat' => $achat['prix_achat_kg'],
                    'image' => $achat['image'],
                    'joursSansManger' => 0,
                    'poids' => $achat['poids_initial'],
                    'date_mort'=>null,
                    'possibleVente'=>false,
                    'autoVente'=>$achat['auto_vente'],
                    'poidsMin'=>$achat['poids_minimal_vente'],
                    'espece'=>$achat['espece'],
                    'prix_vente'=>$achat['prix_vente_kg']

                ];
            }
           

            // 2. Ventes d'animaux
            $sqlVente = "SELECT id_animal, prix_vente FROM ferme_vente_animal WHERE date_vente = :date";
            $stmtVente = $this->bdd->prepare($sqlVente);
            $stmtVente->execute(['date' => $dateStr]);

            while ($vente = $stmtVente->fetch(PDO::FETCH_ASSOC)) {
                $animaux = array_values(array_filter($animaux, function ($animal) use ($vente) {
                    return $animal['id_animal'] != $vente['id_animal'];
                }));                
            }

            // 4. Total capitaux
            $sqlCapitaux = "SELECT SUM(montant) AS total FROM ferme_gestion_capitaux WHERE capitaux_date = :date and id_user= :id_user";
            $stmtCapitaux = $this->bdd->prepare($sqlCapitaux); 
            $stmtCapitaux->execute(['date' => $dateStr,'id_user'=> $id_user]);
            $montant = $stmtCapitaux->fetch(PDO::FETCH_ASSOC);
            $capitaux += ($montant && isset($montant['total'])) ? $montant['total'] : 0;

            // 3. Achats d'aliments
            $sqlAliment = "SELECT COALESCE(SUM(aa.quantiteKg), 0) AS totalNourriture,
            COALESCE(SUM(a.prix_achat_kg * aa.quantiteKg), 0) AS coutTotal
            FROM ferme_achat_alimentation aa
            JOIN ferme_alimentation a ON aa.id_alimentation = a.id_alimentation
            WHERE aa.date_achat = :date";

            $stmtAliment = $this->bdd->prepare($sqlAliment);
            $stmtAliment->execute(['date' => $dateStr]);

            $achatNourriture = $stmtAliment->fetch(PDO::FETCH_ASSOC);
            $stockNourriture += $achatNourriture['totalNourriture'];
            $capitaux -= $achatNourriture['coutTotal'];

            // 4. Gestion nourriture et mortalité
            foreach ($animaux as $key => &$animal) {
                $sqlConso = "SELECT consommation_jour, jours_sans_manger,pourcentage_gain,perte_poids_jour
                             FROM ferme_type_animal t JOIN ferme_alimentation a
                             on t.id_typeAnimal = a.id_typeAnimal
                             WHERE t.id_typeAnimal = :typeAnimal";
                $stmtConso = $this->bdd->prepare($sqlConso);
                $stmtConso->execute(['typeAnimal' => $animal['id_typeAnimal']]);
                $data = $stmtConso->fetch(PDO::FETCH_ASSOC);

                if ($stockNourriture >= $data['consommation_jour']) {
                    $stockNourriture -= $data['consommation_jour'];
                    $animaux[$key]['poids'] += $data['consommation_jour']*$data['pourcentage_gain'];
                    $animal['joursSansManger'] = 0;
                } else {
                    $animal['joursSansManger']++;
                    if($animaux[$key]['date_mort'] != null){
                        $animaux[$key]['poids'] -= $data['perte_poids_jour'];
                    }
                    if ($animal['joursSansManger'] > $data['jours_sans_manger']) {
                        $animaux[$key]['date_mort'] = $dateStr;
                    }
                }
                if($animaux[$key]['poids']>=$animal['poidsMin']){
                    $animaux[$key]['possibleVente'] = true;
                }
                
            }

            $stockAnimaux = count($animaux);
            $date->modify('+1 day');
        }
        return  $animaux;
    }
}