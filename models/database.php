<?php

class Database{
  private $connection;
  public $table;  
  function __construct($db_host, $db_user, $db_pass, $db_name)
  { 
    $this->open_connection($db_host, $db_user, $db_pass, $db_name);
  }
  
  public function open_connection($db_host, $db_user, $db_pass, $db_name)
  {
    // ATTR_PERSISTENT is used for the persistant connection so that db connection will be cached in case there is a next request
    try {
      $this->connection = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true));
    } catch (Exception $e) {
      throw new Exception("DB connection cannot be established");
    }
  }

  public function close_connection()
  {
    if(isset($this->connection))
    {
      mysqli_close($this->connection);
      unset($this->connection);
    }
  }

  public function select()
  {
    return "SELECT * FROM ".$this->table." WHERE id = :id"; 
  }

  public function delete($id)
  {
    return "DELETE FROM ".$this->table." WHERE id=:id";
  }

  public function sanity_table_check(){
    if (!isset($this->_table)) {
      throw new Exception("table does not exist for class {get_class($this)}");
    }  
  }
  
  public function prepare($query)
  { 
    return $this->connection->prepare($query);
  }


  public function lastInsertId()
  {
    return $this->connection->lastInsertId();
  }
  
}



 
