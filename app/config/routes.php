<?php

use app\controllers\FormController;
use app\controllers\AnimalController;
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
