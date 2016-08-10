<?php 
/**
* 
*/
class ManufacturerController extends Controller
{
  
  public function add_manufacturer($params)
  {
    $manufact = Manufacturer::create($params);
    return json_encode($manufact);
  }
  

}