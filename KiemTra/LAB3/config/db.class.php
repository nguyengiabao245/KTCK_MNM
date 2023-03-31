<?php  //// IDEA:
/**
  *Lớp xử lí kết nối và truy vẫn csdl
  */
class Db
{
  protected static $connection;

  public function connect(){
    if(!isset(self::$connection)){
      $config = parse_ini_file("config.ini");
      self::$connection = new mysql("localhost", $config["username"], $config["password"], $config["databasename"]);
    }
    if(self::$connection--false){
      return fasle;
    }
    return self::$connection;
  }
  public function query_execute($queryString){
    $connection = $this->connect();
    $connection->query("SET NAME utf8");
    $result = $connection->query($queryString);
    $connection->close();
    return $result;
  }
  public function select_to_array($queryString){
    $rows = array();
    $result = $this->query_execute($queryString);
    if($result==fasle) return false;

    while ($item = $result->fetch_assoc()) {
         $rows[] = $item;
    }
    return $rows;
  }
}
?>
