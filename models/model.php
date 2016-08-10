<?php 
/**
* Note : This is a base model which will be inherited by all the Model. 
*/
class Model extends Database
{
  public $table;
  public function __construct()
  {
    $this->open_connection(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  }

  public function bind_key_value($obj, $key, $value)
  {
    // TODO -- This code Needs optimization 
    if (is_numeric($value)) {
      return $obj->bindParam($key, $value, PDO::PARAM_INT);
    } else {
      return $obj->bindParam($key, $value, PDO::PARAM_STR);
    }
  }
}
