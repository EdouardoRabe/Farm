<?php

namespace app\controllers;

use Flight;

class AnimalController {

    public function __construct() {
    }

    public function showForm() {
        $generelaiserModel=Flight:: generaliserModel();
        $columns = $generelaiserModel->getTableHeaders("ferme_type_animal");
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
            'omitColumns' => ['id_typeAnimal','role'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => [],
            'title'=> 'Creation de type d\'animal',
            'redirect'=> 'createAnimal'
        ]);
    }
   
}