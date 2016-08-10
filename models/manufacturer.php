<?php 
/**
* 
*/
class Manufacturer extends Model
{
  public $table;  
    const MANUFACT_TABLE = "manufacturers";

  function __construct()
  {
    $this->table = self::MANUFACT_TABLE;
    parent::__construct();
  }

  // TODO this and car model functions are duplicate please optimize it
  public static function find($id){ 
    // form a object and then try to select
    $c = new Manufacturer();
  
    $query = $c->select();
    $dbo = $c->prepare($query);
    $dbo->bindParam(':id', $id, PDO::PARAM_INT);

    if ($dbo->execute()) {
      while ($row = $dbo->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $key => $value) {
          // below code will set above declared variables to the object;
          if (!isset($c->$key)) {
            $c->$key = $value;
          }  
        }
      }
    }else{
      // uncomment this code in case you want to see if there are any errors from the pdo executuin
      // var_dump($dbo->errorInfo());
      throw new Exception("There was Error while executing SQL Statement");
    }
    return $c;
  }

  static public function FunctionName($value='')
  {
    # code...
  }

  static public function create($params)
  {
    $query = "INSERT INTO ".self::MANUFACT_TABLE." (name) VALUES (:name)";
    $db = self::get_db_object();
    $dbo = $db->prepare($query);
    
    foreach ($params as $key => $value) {
      self::bind_key_value_for_class($dbo, $key, $value);
    }

    if(!$dbo->execute()) {
      var_dump($dbo->errorInfo());
      throw new Exception("Manufacturer model cannot be added");
    }
    // var_dump($db->lastInsertId());
    return self::find($db->lastInsertId());
  }
}