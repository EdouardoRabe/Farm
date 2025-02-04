<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class AchatController {

    public function __construct() {
    }

   
    public function showEditableList() {
        $generelaiserModel= Flight:: generaliserModel();
        $data=$generelaiserModel-> getTableData('ferme_type_animal',[],[]);
        Flight::render('achat', [
            'data' => $data,
        ]);
    }

    public function achat(){
        $generelaiserModel= Flight:: generaliserModel();
        $gestionModel=Flight:: gestionModel();
        $result = $gestionModel->calculerCapital(date("Y-m-d H:i:s"));
        if($result<$_POST['prix_achat_kg']*$_POST['poids_initial']){
            Flight::redirect('tableAchat?error');
        }
        $reponse=[
            "id_typeAnimal"=> $_POST['id_typeAnimal'],
            'poids_initial'=> $_POST['poids_initial']
        ];
        $insertAnimal=$generelaiserModel-> insererDonnee('ferme_animal',$reponse,'POST');
        $animal_id=$generelaiserModel-> getLastInsertedId('ferme_animal','id_animal');
        $donnee=[
            'id_animal'=>$animal_id['last_id'],
            'date_achat'=>$_POST['date_achat'],
            'id_user'=>$_SESSION['id_user'],
            'montant'=>$_POST['prix_achat_kg']*$_POST['poids_initial'],
        ];
       
        $insertAchat=$generelaiserModel-> insererDonnee('ferme_achat_animal',$donnee,'POST');
        Flight::redirect('tableAchat?success');
    }

    
    
    

    
  
   
}