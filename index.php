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
  $m = CarModel::find(4);
  $m->destroy();
  //  Inserting in the table
  $m = new CarModel();
  $array = array('name' => 'farari', 'color' => 'red', 'manufacturing_year' => 2016, 'reg_no' => '1234', 'note' => '12334', 'picture1_id' => 0, 'picture2_id' => 0);
  $m->add($array);


   
   






