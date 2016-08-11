<?php 
/**
* 
*/
class Photo extends Model
{
  public $table;
  public $path;
  public $id;
  const PHOTO_TABLE='pictures';

  function __construct()
  {
    $this->table = self::PHOTO_TABLE;
    parent::__construct();
  }

  public static function find($id){ 
    // form a object and then try to select
    $p = new Photo();
    $query = $p->select();
    $dbo = $p->prepare($query);
    $dbo->bindParam(':id', $id, PDO::PARAM_INT);

    if ($dbo->execute()) {
      while ($row = $dbo->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $key => $value) {
          // below code will set above declared variables to the object;
          if (!isset($c->$key)) {
            $p->$key = $value;
          }  
        }
      }
    }else{
      // uncomment this code in case you want to see if there are any errors from the pdo executuin
      // var_dump($dbo->errorInfo());
      throw new Exception("There was Error while executing SQL Statement");
    }
    return $p;
  }


  public static function add_photo($file_path){
    $query = "INSERT INTO ".self::PHOTO_TABLE." (path) VALUES(:path)";
    $db = self::get_db_object();
    $dbo = $db->prepare($query);
    $dbo->bindParam(':path', $file_path);
    if (!$dbo->execute()) {
      throw new Exception("There is some error while updating");
    }  
    return self::find($db->lastInsertId());
  }

  public static function add_uploaded_photos(){
    $photos = array();
    // TODO - please make this dynamic
    for($i=0; $i< 2 ; $i++){
      $date = new DateTime();
      $time_stamp = $date->getTimeStamp().$i;
      $file_path = "assets/img/".$time_stamp.".".pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
      $upload_file = "/var/www/html/codemax_assignment/assets/img/".$time_stamp.".".pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);

 
      if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $upload_file)) {
        $p = self::add_photo($file_path);
        array_push($photos, $p);
      }
    }
    return $photos;
  }
}