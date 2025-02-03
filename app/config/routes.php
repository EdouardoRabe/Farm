<?php

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
$router-> get('/',[$formController,'showForm']); 
$router-> get('/formAnimal',[$animalController,'showForm']); 
$router-> post('/createAnimal',[$animalController,'createAnimal']); 
$router-> post('/updateAnimal',[$animalController,'updateAnimal']); 
$router-> get('/tableAnimal',[$animalController,'showEditableList']); 


$utilisateurController = new UtilisateurController();
$router->get('/formCapitaux',[$utilisateurController,'showForm']);
$router->post('/ajoutCapitaux',[$utilisateurController,'ajoutCapitaux']);
