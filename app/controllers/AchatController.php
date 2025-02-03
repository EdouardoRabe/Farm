<?php

namespace app\controllers;

use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AchatController {

    public function __construct() {
    }

   
    public function showEditableList() {
        $columnTypes = [
            'int' => 'number',
            'float' => 'number',
            'decimal' => 'number',
            'number' => 'number',
            'varchar' => 'text',
            'char' => 'text',
            'date' => 'date',
            'datetime' => 'datetime-local',
            'text' => 'textarea'
        ];
        $generelaiserModel= Flight:: generaliserModel();
        $data=$generelaiserModel-> getTableData('ferme_type_animal',[],[]);

        $omitColumns = ['id_typeAnimal','poids_minimal_vente','poids_maximal','prix_achat_kg','prix_vente_kg','jours_sans_manger','perte_poids_jour','consommation_jour'];  
    
        Flight::render('table', [
            'data' => $data,
            'columnTypes' => $columnTypes,
            'omitColumns' => $omitColumns,
            'redirectForm' => 'updateAlimentation',
            'column'=>'id_typeAnimal',
            'title' => 'Liste modifiable'
        ]);
    }

    
    
    

    
  
   
}