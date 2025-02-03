<?php

namespace app\controllers;

use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AlimentationController {

    public function __construct() {
    }

    public function showForm() {
        $generelaiserModel=Flight:: generaliserModel();
        $columns = $generelaiserModel->getTableHeaders("ferme_alimentation");
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
            'omitColumns' => ['id_alimentation'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => [],
            'title'=> 'Creation de type d\'animal',
            'redirect'=> 'createAlimentation'
        ]);
    }

    function createAlimentation(){
        $generelaiserModel= Flight:: generaliserModel();
        $uploadModel = Flight::uploadModel();
        $reponse= $generelaiserModel-> getFormData('ferme_alimentation',['id_alimentation'],'POST');
        $file=$_FILES['image'];
        if($uploadModel-> checkError($file)){
            Flight:: redirect('formAlimentation?error');
        }
        else{
            $upload_image = $uploadModel->uploadImg($file);
            $reponse['image']=$upload_image;
            $insert=$generelaiserModel->  insererDonnee('ferme_alimentation',$reponse);
            Flight:: redirect('tableAlimentation');
        }
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
        $data=$generelaiserModel-> getTableData('ferme_alimentation',[],[]);

        $omitColumns = ['id_alimentation'];  
    
        Flight::render('table', [
            'data' => $data,
            'columnTypes' => $columnTypes,
            'omitColumns' => $omitColumns,
            'redirectForm' => 'updateAlimentation',
            'column'=>'id_alimentation',
            'title' => 'Liste modifiable'
        ]);
    }

    function updateAlimentation() {
        $generelaiserModel = Flight::generaliserModel();
        $uploadModel = Flight::uploadModel();
    
        $id_alimentations = $_POST['id_alimentation']; 
        $images = $_FILES['image'];
        foreach ($id_alimentations as $index => $id_alimentation) {
            $data = [];
            foreach ($_POST as $key => $values) {
                if (is_array($values)) {
                    $data[$key] = $values[$index];
                } else {
                    $data[$key] = $values;
                }
            }
            if (!empty($images['name'][$index]) && $images['name'][$index] !== "old_image") {
                if ($uploadModel->checkError2($images, $index)) {
                    Flight::redirect('tableAlimentation?error');
                } else {
                    $upload_image = $uploadModel->uploadImg2($images, $index);
                    $data['image'] = $upload_image;
                }
            } else {
                $data['image'] = $_POST['old_image'][$index]; 
            }
            unset($data['old_image']);
            $update = $generelaiserModel->updateTableData('ferme_alimentation', $data, ['id_alimentation' => $id_alimentation]);
        }
        Flight::redirect('tableAlimentation?success');
    }
    
    

    
  
   
}