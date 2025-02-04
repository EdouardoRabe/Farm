<?php

use app\controllers\AchatAlimentationController;
use app\controllers\AchatController;
use app\controllers\AlimentationController;
use app\controllers\FormController;
use app\controllers\AnimalController;
use app\controllers\LoginController;
use app\controllers\ReinitialisationController;
use app\controllers\UtilisateurController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

$animalController= new AnimalController();
$loginController=new LoginController();
$alimentationController= new AlimentationController();
$utilisateurController = new UtilisateurController();
$achatController = new AchatController();
$achatAlimentController= new AchatAlimentationController();
$resetController = new ReinitialisationController();
$router-> get('/',[$loginController,'getLogin']); 
$router-> post('/checkLogin',[$loginController,'checkLogin']);
$router-> get('/formAnimal',[$animalController,'showForm']); 
$router-> get('/formAlimentation',[$alimentationController,'showForm']); 
$router-> post('/createAnimal',[$animalController,'createAnimal']); 
$router-> post('/createAlimentation',[$alimentationController,'createAlimentation']); 
$router-> post('/updateAnimal',[$animalController,'updateAnimal']); 
$router-> post('/updateAlimentation',[$alimentationController,'updateAlimentation']); 
$router-> get('/tableAnimal',[$animalController,'showEditableList']); 
$router->get('/formCapitaux',[$utilisateurController,'showForm']);
$router->post('/ajoutCapitaux',[$utilisateurController,'ajoutCapitaux']);
$router-> get('/tableAlimentation',[$alimentationController,'showEditableList']); 
$router-> get('/admin',[$utilisateurController,'adminpage']);
$router-> get('/accueil',[$utilisateurController,'acceuilpage']);
$router-> get('/tableAchat',[$achatController,'showEditableList']); 
$router-> get('/reinitialisation',[$resetController,'reset']); 
$router-> get('/tableAchatAlimentation',[$achatAlimentController,'showEditableList']); 
$router-> post('/achat',[$achatController,'achat']); 
$router-> post('/achatAlimentation',[$achatAlimentController,'achat']); 
