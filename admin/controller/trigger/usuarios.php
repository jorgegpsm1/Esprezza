<?php
  if(isset($_GET['action'])){
    @session_start();
    require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/users_load.php');
    class Usuarios{
      private static $Request;
      private static $Response;
      private static $Action;
      private static $Model;

      public function __construct(){
        die('No se instancian objetos');
      }
      private static function set_Response(){
        switch (self::$Action){
          case ('0'):
          self::$Request['Action'] = self::$Action;
          self::$Response = null;
          break;
        }
      } 
      private static function get_Request(){
        switch (self::$Action){
          case ('0'):
          self::$Response['Success'] = false;
          self::$Model[0] = new users_load(self::$Request);
          self::$Response = self::$Model[0]->get_Response();
          unset(self::$Model[0]);
          self::$Response['Success'] = true;
          header('Content-Type: application/json');
          echo json_encode(self::$Response);
          break;
        }
      }
      private static function is_Request($Request){
        return isset($Request) ? true : false;
      }
      private static function is_Autologin(){
      }

      public static function Initialize(){   
        self::$Action   =  $_GET['action'];
        self::$Model    =  array();
        self::set_Response();
        self::get_Request();
      }
      public function __destruct(){
        die('No se instancian objetos');
      }
    }

    Usuarios::Initialize();
  }
  else{
    die("Error Interno");
  }
 
?>
