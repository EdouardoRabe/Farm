<?php

use app\controllers\AchatAlimentationController;
use app\controllers\AchatController;
use app\controllers\AlimentationController;
use app\controllers\FormController;
use app\controllers\AnimalController;
use app\controllers\UtilisateurController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

$formController=new FormController();
$animalController= new AnimalController();

$alimentationController= new AlimentationController();
$utilisateurController = new UtilisateurController();
$achatController = new AchatController();
$achatAlimentController= new AchatAlimentationController();
$router-> get('/',[$formController,'showForm']); 
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
$router-> get('/acceuil',[$utilisateurController,'acceuilpage']);
$router-> get('/tableAchat',[$achatController,'showEditableList']); 
$router-> get('/tableAchatAlimentation',[$achatAlimentController,'showEditableList']); 
$router-> post('/achat',[$achatController,'achat']); 
$router-> post('/achatAlimentation',[$achatAlimentController,'achat']); 
