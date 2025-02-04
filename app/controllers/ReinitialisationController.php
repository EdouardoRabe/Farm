<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class ReinitialisationController {

    public function __construct() {
    }

   
    public function reset(){
        $resetModel= Flight:: resetModel();
        $reset=$resetModel->resetSelectedTables();
        Flight:: redirect("accueil");
    }
   
}