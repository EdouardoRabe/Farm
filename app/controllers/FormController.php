<?php

namespace app\controllers;

use Flight;

class FormController {

    public function __construct() {
    }

    public function showForm() {
        $generelaiserModel=Flight:: generaliserModel();
        $columns = $generelaiserModel->getTableHeaders("ferme_user");
        
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
            'omitColumns' => ['ferme_user','role'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => []
        ]);
    }
}