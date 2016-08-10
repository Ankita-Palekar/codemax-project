<?php 
/**
* 
*/
class Manufacturer extends Database
{
  function __construct()
  {
    # code...
  }

  public function add($params)
  {
    $query = "INSERT INTO ".$this->table." (name) VALUES (:name)";                      
    
    $dbo = $this->prepare($query);
    
    foreach ($params as $key => $value) {
      $this->bind_key_value($dbo, $key, $value);
    }

    if(!$dbo->execute()) {
      var_dump($dbo->errorInfo());
      throw new Exception("Manufacturer model cannot be added");
    }
  }
}