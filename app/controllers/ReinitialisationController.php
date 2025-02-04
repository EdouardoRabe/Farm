<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class ReinitialisationController {

    public function __construct() {
    }

   
    public function reset(){
        $gestionModel=Flight:: gestionModel();
        $resetModel= Flight:: resetModel();
        $reset=$resetModel->resetSelectedTables();
        $result = $gestionModel->calculerCapital(date("Y-m-d H:i:s"),$_SESSION['id_user']);
        $_SESSION['result']=$result;
        Flight:: redirect("accueil");
    }
   
}