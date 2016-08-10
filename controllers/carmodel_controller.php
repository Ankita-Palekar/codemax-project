<?php 
/**
* 
*/
class CarmodelController extends Controller
{
  
  // 
  public function add_car($params){
    $c = Carmodel::create($params);
    return json_encode($c);
  }

  public function delete_car($id)
  {
    $c = Carmodel::find($id);
    $c->delete();
  }

  public function get_all_cars()
  {
    $cars = Carmodel::get_all_cars();
    $this->set('result', $cars);
    $this->template->render_html();
  }

}