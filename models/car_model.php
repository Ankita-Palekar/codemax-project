<?php 
/**
* 
*/
class CarModel extends Model
{
  public $id;
  public $name;
  public $color;
  public $manufacturing_year;
  public $reg_no;
  public $note;
  public $picture1_id;
  public $picture2_id;

  function __construct()
  {
    $this->table = "car_models";
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

  public function add($params)
  {
    // TODO - This query should be should be retrieve from the db class. Will need little more research on current framework to check how they do.
    $query = "INSERT INTO ".$this->table." (name, color, manufacturing_year, reg_no, note, picture1_id, picture2_id) VALUES (:name, :color, :manufacturing_year, :reg_no, :note, :picture1_id, :picture2_id)";                      
    
    $dbo = $this->prepare($query);
    
    foreach ($params as $key => $value) {
      $this->bind_key_value($dbo, $key, $value);
    }

    if(!$dbo->execute()) {
      var_dump($dbo->errorInfo());
      throw new Exception("car model cannot be added");
      // TODO please remove the image inserted also;
    }
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

}

