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


        Flight::render('template', [

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

            Flight:: redirect('tableAnimal');

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

    
        $id_typeAnimals = $_POST['id_typeAnimal']; 
        $images = $_FILES['image'];
        foreach ($id_typeAnimals as $index => $id_typeAnimal) {
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
                    Flight::redirect('tableAnimal?error');
                } else {
                    $upload_image = $uploadModel->uploadImg2($images, $index);
                    $data['image'] = $upload_image;
                }
            } else {
                $data['image'] = $_POST['old_image'][$index]; 
            }
            unset($data['old_image']);
            $update = $generelaiserModel->updateTableData('ferme_type_animal', $data, ['id_typeAnimal' => $id_typeAnimal]);
        }
        Flight::redirect('tableAnimal?success');
    }
    
    

    

  
   
}