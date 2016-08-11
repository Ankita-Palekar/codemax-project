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
  public $picture1_path;
  public $picture2_path;
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
    if($dbo->execute()) {
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

  public static function add_uploaded_photos(){
    $photo_paths = array();
    // TODO - please make this dynamic
    for($i=0; $i< 2 ; $i++){
      $date = new DateTime();
      $time_stamp = $date->getTimeStamp();
      $time_stamp += $date->format('gis');
      $time_stamp += "{$i}";

      $file_path = "assets/img/".$time_stamp.".".pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
      
      $upload_file = "/var/www/html/codemax_assignment/assets/img/".$time_stamp.".".pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);

      if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $upload_file)) {
        array_push($photo_paths, $file_path);
      }
    }
    return $photo_paths;
  }

  static public function create($params)
  {
    // TODO - This query should be  retrieve from the db class. Will need little more research on current framework to check how they do.
    
    // add all the files to the db first 
    $photos = self::add_uploaded_photos();

    // TODO- this needs to be dynamic
    $params['picture1_path'] = $photos[0];
    $params['picture2_path'] = $photos[1];

    $query = "INSERT INTO ".self::CAR_TABLE." (name, color, manufacturing_year, reg_no, note, picture1_path, picture2_path, manufacturer_id) VALUES (:name, :color, :manufacturing_year, :reg_no, :note, :picture1_path, :picture2_path, :manufacturer_id)";                      
    
    $db = self::get_db_object();

    $dbo = $db->prepare($query);
    
    foreach ($params as $key => $value) {
      self::bind_key_value_for_class($dbo, $key, $value);
    }

    if(!$dbo->execute()) {
      foreach ($photos as $p) {
        unlink('/var/www/html/codemax_assignment/'.$p);
      }
      throw new Exception("car model cannot be added");
    } 
    return self::find($db->lastInsertId());
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
  static public function get_cars_and_manufacturers(){
    $db = self::get_db_object();
    $result = array();
    $query = "SELECT ".self::CAR_TABLE.".name as car_name, ".self::MANUFACT_TABLE.".name as manufacturer_name, count(*) AS count, group_concat(car_models.id SEPARATOR ',') as ids FROM car_models INNER JOIN manufacturers ON manufacturers.id = car_models.manufacturer_id GROUP BY car_models.name, manufacturers.name";
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

  // ids is a comma seperated string
  static public function get_required_cars($ids)
  {
    if (!isset($ids)) {
       throw new Exception("ids cannot be blanks");
    }  
    
    $result = array();
    $query = " SELECT * from ".self::CAR_TABLE." where id in (".$ids.") ";
    $db = self::get_db_object();
    $dbo = $db->prepare($query);
    $dbo->bindParam(':ids', $ids, PDO::PARAM_STR);
    if($dbo->execute()) {
      while($row = $dbo->fetch(PDO::FETCH_ASSOC)) {
        array_push($result, $row);
      }
    }else{
      throw new Exception("Error while execution");
    }  
    return $result;
  }

}

