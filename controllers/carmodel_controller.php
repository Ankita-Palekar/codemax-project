<?php 
/**
* 
*/
class CarmodelController extends Controller
{
  
  // 
  public function add_car($params){
    $params = $this->process_params($params);
    $c = Carmodel::create($params);
    $this->template->render_json($c);
  }

  public function delete_car($id_param)
  {
    $c = Carmodel::find($id_param['id']);
    $c->destroy();
  }

  public function get_cars_and_manufacturers()
  {
    $cars = Carmodel::get_cars_and_manufacturers();
    $this->set('result', $cars);
    $this->template->render_html();
  }

  public function add_car_form()
  {
    $manufacturers = Manufacturer::get_manufacturers();
    $this->set('result', $manufacturers);
    $this->template->render_html();
  }

  public function get_required_cars($params)
  {
    $cars = Carmodel::get_required_cars($params['ids']);
    $this->template->render_json($cars);
  }

  public function process_params($params)
  {
    // remove unwanted keys
    $unwanted_keys = Array('submit');
    foreach ($unwanted_keys as $key ) {
      unset($params[$key]);
    }
    return $params;
  }

}