<?php 
/**
* 
*/
class Template
{

  protected $variables = array();
  protected $action;
  protected $controller;
  function __construct($controller, $action)
  {
    $this->action = $action;
    $this->controller = $controller;
  }

  public function set($name, $value)
  {
    $this->variables[$name] = $value;
  }


  public function render_html()
  {
    extract($this->variables);
    include ('views/header.php');

    if (isset($this->action)) {
      include ('views/'.$this->action.'.php');
    }
    include ('views/footer.php');
  }

  public function render_json($result)
  {
    return print_r(json_encode($result));
  }
}
