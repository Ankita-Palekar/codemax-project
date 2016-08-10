<?php
class Controller {
  protected $model;
  protected $controller;
  protected $action;
  protected $template;

  function __construct($model, $controller, $action) {
    $this->model = $model;
    $this->controller = $controller;
    $this->action = $action;
    $this->template = new Template($controller, $action); 
  }

  function set($name,$value) {
    $this->template->set($name, $value);
  }

   

}
