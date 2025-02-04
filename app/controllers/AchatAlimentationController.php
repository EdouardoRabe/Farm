<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AchatAlimentationController {

    public function __construct() {
    }

   
    public function showEditableList() {
        $generelaiserModel= Flight:: generaliserModel();
        $data=$generelaiserModel-> getTableData('ferme_alimentation',[],[]);
        Flight::render('achatAlimentation', [
            'data' => $data,
        ]);
    }

    public function achat(){
        $generelaiserModel= Flight:: generaliserModel();
        $gestionModel=Flight:: gestionModel();
        echo $result = $gestionModel->calculerCapital($_POST['date_achat'],$_SESSION['id_user']);echo '</br>';
        echo $_POST['prix_achat_kg']*$_POST['quantiteKg'];
        if($result<$_POST['prix_achat_kg']*$_POST['quantiteKg']){
            Flight::redirect('tableAchatAlimentation?error');
        }
        else{
            $reponse=[
                "id_alimentation"=> $_POST['id_alimentation'],
                'quantiteKg'=> $_POST['quantiteKg'],
                'montant'=>$_POST['prix_achat_kg']*$_POST['quantiteKg'],
                'date_achat'=>$_POST['date_achat'],
                'id_user'=>$_SESSION['id_user']
            ];
            $insertAnimal=$generelaiserModel-> insererDonnee('ferme_achat_alimentation',$reponse,'POST');
            $result = $gestionModel->calculerCapital(date("Y-m-d H:i:s"),$_SESSION['id_user']);
            $_SESSION['result']=$result;
            Flight::redirect('tableAchatAlimentation?success');
        }
    }

    
    
    

    
  
   
}