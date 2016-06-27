<?php
  namespace Admin\Model\clases;
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php'); 

  class Users{
    private $user_id;
    private $user_name;
    private $user_pass;
    private $user_status;
    private static $table = "users";
    private $Request;
    private $Action = 1;

    public function __construct(){
      //$this->Connection   = Database::Connect();
    }
    public function set_Query(){
      switch($this->Action){
        case ('0'):
          return ("SELECT COUNT(user_id) AS USER_ID FROM ".Users::$table);
        break;
        case ('1'):
          return ("SELECT user_id, user_name, user_pass, user_status FROM ".Users::$table);
        break;
      }
    }
    /*private function set_Request($Input){
      $this->Request    = $Input;
      $this->Action     = $this->Request['Action'];
    }*/


    public function __destruct(){
      //Database::Disconnect();
    }
  }
?>
