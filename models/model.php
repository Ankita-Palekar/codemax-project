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


  // in case of object we can very well connect to db since its inherited from database. In case of class level function we cannot use object so tats why creating a new class level function.
  

  static public function get_db_object()
  {
    return new Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  }


  // shitty php... Why the hell there is no way to give same name for class and instance level functions. It makes my life difficult here.
  static public function bind_key_value_for_class($obj, $key, $value){
    // TODO -- This code Needs optimization 
    if (is_numeric($value)) {
      return $obj->bindParam($key, $value, PDO::PARAM_INT);
    } else {
      return $obj->bindParam($key, $value, PDO::PARAM_STR);
    }
  } 
  
  public function bind_key_value($obj, $key, $value)
  {
    self::bind_key_value_for_class($obj, $key, $value);
  }
}
