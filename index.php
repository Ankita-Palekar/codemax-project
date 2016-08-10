<?php 

  error_reporting(E_ALL);
  ini_set('display_errors','On');

  require_once('lib/config.php');
  require_once('models/database.php');
  require_once('models/model.php');
  require_once('models/car_model.php');
  require_once('models/manufacturer.php');
  require_once('models/model_manufacturer.php');
  require_once('models/photo.php');
  require_once('controllers/controller.php');
  require_once('controllers/car_model_controller.php');
  require_once('controllers/manufacturer_controller.php');

  $c =  new ManufacturerController('Manufacturer', 'ManufacturerController', 'add_manufacturer');

  $manufact = $c->add_manufacturer(array('name' => 'Tesla'));
   


   
   






