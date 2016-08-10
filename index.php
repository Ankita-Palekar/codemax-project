<?php 

  error_reporting(E_ALL);
  ini_set('display_errors','On');

  require_once('lib/config.php');
  require_once('models/database.php');
  require_once('models/model.php');
  require_once('models/carmodel.php');
  require_once('models/manufacturer.php');
  require_once('models/model_manufacturer.php');
  require_once('models/photo.php');
  require_once('lib/template.php');
  require_once('controllers/controller.php');
  require_once('controllers/carmodel_controller.php');
  require_once('controllers/manufacturer_controller.php');


  if (isset($_GET['action']) && isset($_GET['model'])) {
    $action = $_GET['action'];
    $model = ucfirst($_GET['model']);
    $controller = ucfirst($model)."Controller"; 
    $dispatch = new $controller($model, $controller, $action);
    $queryString = '';

    if ((int)method_exists($controller, $action)) {
      call_user_func_array(array($dispatch, $action), array($queryString));
    }
  }else {
      
  } 
  
   


   
   






