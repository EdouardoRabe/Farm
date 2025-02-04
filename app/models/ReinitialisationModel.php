<?php 
namespace app\models;

use Exception;

class ReinitialisationModel{
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    function resetSelectedTables() {
        try {
            $this->bdd->exec("SET FOREIGN_KEY_CHECKS = 0");
    
            $tables = [
                "ferme_achat_alimentation",
                "ferme_achat_animal",
                "ferme_vente_animal",
                "ferme_gestion_capitaux"
            ];
    
            foreach ($tables as $table) {
                $this->bdd->exec("DELETE FROM $table");
                $this->bdd->exec("ALTER TABLE $table AUTO_INCREMENT = 1");
            }
    
            $this->bdd->exec("SET FOREIGN_KEY_CHECKS = 1");
    
            return "Réinitialisation réussie des tables sélectionnées !";
        } catch (Exception $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
    
    
    

}
?>