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

  // find and destroy element
  $m = CarModel::get_all_cars();
  var_dump($m);
  //  Inserting in the table
   


   
   






