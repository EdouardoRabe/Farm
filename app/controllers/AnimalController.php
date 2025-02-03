<?php

namespace app\controllers;

use Flight;
use flight\debug\tracy\FlightPanelExtension;

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
            'omitColumns' => ['id_typeAnimal'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => [],
            'title'=> 'Creation de type d\'animal',
            'redirect'=> 'createAnimal'
        ]);
    }

    function createAnimal(){
        $generelaiserModel= Flight:: generaliserModel();
        $uploadModel = Flight::uploadModel();
        $reponse= $generelaiserModel-> getFormData('ferme_type_animal',['id_typeAnimal'],'POST');
        $file=$_FILES['image'];
        if($uploadModel-> checkError($file)){
            Flight:: redirect('formAnimal?error');
        }
        else{
            $upload_image = $uploadModel->uploadImg($file);
            $reponse['image']=$upload_image;
            $insert=$generelaiserModel->  insererDonnee('ferme_type_animal',$reponse);
            Flight:: redirect('formAnimal?success');
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
        $data=$generelaiserModel-> getTableData('ferme_type_animal',[],[]);

        $omitColumns = ['id_typeAnimal'];  
    
        Flight::render('table', [
            'data' => $data,
            'columnTypes' => $columnTypes,
            'omitColumns' => $omitColumns,
            'redirectForm' => 'updateAnimal',
            'column'=>'id_typeAnimal',
            'title' => 'Liste modifiable'
        ]);
    }

    function updateAnimal() {
        $generelaiserModel = Flight::generaliserModel();
        $uploadModel = Flight::uploadModel();
        $reponse = $generelaiserModel->getFormData('ferme_type_animal', ['id_typeAnimal', 'old_image'], 'POST');
        $file = $_FILES['image'];
        if (!empty($file['name']) && $file['name'] !== "old_image") {
            if ($uploadModel->checkError($file)) {
                Flight::redirect('tableAnimal?error');
            } else {
                $upload_image = $uploadModel->uploadImg($file);
                $reponse['image'] = $upload_image;
            }
        } else {
            $reponse['image'] = $_POST['old_image'];
        }
        $reponse['id_typeAnimal']=$_POST['id_typeAnimal'];
        $update = $generelaiserModel->updateTableData('ferme_type_animal', $reponse, ['id_typeAnimal' => $_POST['id_typeAnimal']]);
        Flight::redirect('tableAnimal?success');
    }
    

    
  
   
}