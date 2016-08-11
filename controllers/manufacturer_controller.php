<?php 
/**
* 
*/
class ManufacturerController extends Controller
{
  
  public function add_manufacturer($params)
  {
    $manufact = Manufacturer::create($params);
    $this->template->render_json($manufact);
  }
  
  public function add_manufacturer_form($value='')
  {
    $this->template->render_html();
  }
}