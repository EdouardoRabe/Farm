<?php

namespace app\controllers;

use Exception;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AlimentationController
{

    public function __construct() {}

    public function showForm()
    {
        $generelaiserModel = Flight::generaliserModel();
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

        Flight::render('template', [
            'columns' => $columns,
            'columnTypes' => $columnTypes,
            'omitColumns' => ['id_alimentation'],
            'hidden' => [],
            'canNull' => false,
            'numericDouble' => [],
            'title' => 'Creation de type d\'alimentation',
            'redirect' => 'createAlimentation'
        ]);
    }

    function createAlimentation()
    {
        $generelaiserModel = Flight::generaliserModel();
        $uploadModel = Flight::uploadModel();
        $reponse = $generelaiserModel->getFormData('ferme_alimentation', ['id_alimentation'], 'POST');
        $file = $_FILES['image'];
        if ($uploadModel->checkError($file)) {
            Flight::redirect('formAlimentation?error');
        } else {
            $upload_image = $uploadModel->uploadImg($file);
            $reponse['image'] = $upload_image;
            $insert = $generelaiserModel->insererDonnee('ferme_alimentation', $reponse);
            Flight::redirect('tableAlimentation');
        }
    }

    public function showEditableList()
    {
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
        $generelaiserModel = Flight::generaliserModel();
        $data = $generelaiserModel->getTableData('ferme_alimentation', [], []);

        $omitColumns = ['id_alimentation'];

        Flight::render('table', [
            'data' => $data,
            'columnTypes' => $columnTypes,
            'omitColumns' => $omitColumns,
            'redirectForm' => 'updateAlimentation',
            'column' => 'id_alimentation',
            'title' => 'Liste modifiable'
        ]);
    }

    function updateAlimentation()
    {
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



    function getGlobalResult()
    {
        try {
            $dateFin = Flight::request()->data->dateFin;
            $dateDebut = "2025-01-01"; 
    
            if (!$dateFin) {
                Flight::json(['error' => 'Date requise'], 400);
                return;
            }
    
            // Vérifie si le modèle est bien instancié
            $alimentModel = Flight::alimentationModel();
            if (!$alimentModel) {
                throw new Exception("Le modèle d'alimentation est introuvable.");
            }
    
            $result = $alimentModel->calculerStockFerme($dateDebut, $dateFin,1);
    
            // Simule les résultats, tu peux ajuster selon la structure de ton modèle
            if (!$result) {
                throw new Exception("Les résultats du calcul sont vides.");
            }
            $response = [
                'listanimaux' => $result['listanimaux'],
                'animaux' => $result['stock_animaux'] ?? 0,
                'nourriture' => $result['stock_nourriture'] ?? 0,
                'capitaux' => $result['capitaux'] ?? 0
            ];
    
            Flight::json($result);
        } catch (Exception $e) {
            // Log l'erreur pour mieux comprendre le problème
            error_log($e->getMessage());
            Flight::json(['error' => 'Erreur de calcul: ' . $e->getMessage()], 500);
        }
    }
    


    function redirectTableBord()
    {
        Flight::render('tableBord');
    }
}
