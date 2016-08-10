<?php 
/**
* 
*/
  
class Carmodel extends Model
{
  public $id;
  public $name;
  public $color;
  public $manufacturing_year;
  public $reg_no;
  public $note;
  public $picture1_id;
  public $picture2_id;
  const CAR_TABLE = 'car_models';
  const MANUFACT_TABLE = "manufacturers";

  function __construct()
  {
    $this->table = self::CAR_TABLE;
    parent::__construct();
  }

  // class level function to find element
  public static function find($id){ 
    // form a object and then try to select
    $c = new CarModel();
 
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

  static public function create($params)
  {
    // TODO - This query should be  retrieve from the db class. Will need little more research on current framework to check how they do.
    $query = "INSERT INTO ".self::CAR_TABLE." (name, color, manufacturing_year, reg_no, note, picture1_id, picture2_id, manufacturer_id) VALUES (:name, :color, :manufacturing_year, :reg_no, :note, :picture1_id, :picture2_id, :manufacturer_id)";                      
    
    $db = self::get_db_object();

    $dbo = $db->prepare($query);
    
    foreach ($params as $key => $value) {
      self::bind_key_value_for_class($dbo, $key, $value);
    }

    if(!$dbo->execute()) {
      var_dump($dbo->errorInfo());
      throw new Exception("car model cannot be added");
      // TODO please remove the image inserted also;
    } 
    // return self::find($dbo->lastInsertId());
  }

  public function destroy()
  {
    if (!isset($this->id)) {
      throw new Exception("You are trying to delete not existing object");
    }  
  
    $query = $this->delete($this->id);
    $dbo = $this->prepare($query);
    $dbo->bindParam(':id', $this->id);
    if (!$dbo->execute()) {
      throw new Exception("Your entry could not be deleted");
    }
  }

  // TODO - not sure if this particular function needs to be in this model or seperate model should be created.
  static public function get_all_cars(){
    $db = self::get_db_object();
    $result = array();
    $query = "SELECT ".self::CAR_TABLE.".name, ".self::MANUFACT_TABLE.".name, count(*) AS count FROM car_models INNER JOIN manufacturers ON manufacturers.id = car_models.manufacturer_id GROUP BY car_models.name, manufacturers.name";
    $dbo = $db->prepare($query);
    
    if ($dbo->execute()) {
      while ($row = $dbo->fetch(PDO::FETCH_ASSOC)) {
        array_push($result, $row);
      }
    } else {
      throw new Exception("There is some error while retrieving the solution");
    }
    return $result;
  }

}
