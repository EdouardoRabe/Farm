<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AchatAnimalController {

    public function __construct() {
    }

    public function showForm() {
        $generelaiserModel=Flight:: generaliserModel();
        $columns = $generelaiserModel->getTableHeaders("ferme_gestion_capitaux");
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

        Flight::render('form', [
            'columns' => $columns,
            'columnTypes' => $columnTypes,
            'omitColumns' => ['id_capitaux','capitaux_date','id_user'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => [],
            'title'=> 'Ajout de capitaux',
            'redirect'=> 'ajoutCapitaux'
        ]);
    }

    function ajoutCapitaux(){
        $generelaiserModel= Flight:: generaliserModel();
       $reponse= $generelaiserModel-> getFormData('ferme_gestion_capitaux', ['id_capitaux','capitaux_date','id_user'],'POST');
        $reponse['capitaux_date'] = date("Y-m-d H:i:s");
        $reponse['id_user'] = $_SESSION['id_user'];
        $insertion = $generelaiserModel->insererDonnee('ferme_gestion_capitaux',$reponse);
        Flight:: redirect('formCapitaux?success');
    }
    
}