<?php

namespace app\controllers;

use DateTime;
use Flight;
use flight\debug\tracy\FlightPanelExtension;

class LoginController {

    public function __construct() {
    }

   
    public function getLogin() {
        Flight::render('login');
    }

    public function checkLogin(){
        $gestionModel=Flight:: gestionModel();
        $generaliserModel=Flight::generaliserModel();
        $data= $generaliserModel-> checkLogin("ferme_user",["id_user","name", "first_name","role","phone_number"],'POST',["id_user"]);
        if($data["success"]==false){
            Flight::redirect('/');
        }
        else{
            $_SESSION["id_user"]=$data["data"]["id_user"];
            $user=$generaliserModel-> getTableData('ferme_user',['id_user'=>$data["data"]["id_user"]]);
            $_SESSION['user']=$user;
            $result = $gestionModel->calculerCapital(date("Y-m-d H:i:s"),$_SESSION['id_user']);
            $_SESSION['result']=$result;
            Flight::redirect('accueil');
        }
    }
   
}