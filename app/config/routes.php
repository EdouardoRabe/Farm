<?php

use app\controllers\FormController;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

$formController=new FormController();
$router-> get('/',[$formController,'showForm']); 
$router-> get('/t',[$formController,'test']); 

