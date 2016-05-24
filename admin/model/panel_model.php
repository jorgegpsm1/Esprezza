<?php
  require_once('../config/database.php');
  class Read{
    
    private $Obj  = null;
    
    public function __construct(){
      $Obj = Database::connect();
    }
    public function get_Instance(){
      return $Obj;
    }
    public function __destruct(){
      $Obj = Database::disconnect();
    }
  }
?>