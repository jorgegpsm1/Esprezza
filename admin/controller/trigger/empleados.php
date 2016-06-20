<?php
  if(!isset($_GET['action']) && !is_numeric($_GET['action'])){
    $Response = array('Response' => false);
    header('Content-Type: application/json');
    echo json_encode($Response);
  }
  else{
    $Response = array('Response' => false );
  }
    @session_start();
    require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_load.php');
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

          default:
            echo json_encode($Response);
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
          case ('1'):
            self::$Response['Success'] = false;
            self::$Model[0] = new users_load(self::$Request);
            self::$Response = self::$Model[0]->get_Response();
            unset(self::$Model[0]);
            self::$Response['Success'] = true;
            header('Content-Type: application/json');
            echo json_encode(self::$Response);
          break;
          case ('2'):
            self::$Response['Success'] = false;
            self::$Model[0] = new users_load(self::$Request);
            self::$Response = self::$Model[0]->get_Response();
            unset(self::$Model[0]);
            self::$Response['Success'] = true;
            header('Content-Type: application/json');
            echo json_encode(self::$Response);
          break;
          case ('5'):
            self::$Response['Success'] = false;
            self::$Model[0] = new users_load(self::$Request);
            self::$Response = self::$Model[0]->get_Response();
            unset(self::$Model[0]);
            self::$Response['Success'] = true;
            header('Content-Type: application/json');
            echo json_encode(self::$Response);
          break;
          case ('1.3.0'):
            self::$Response['Response'] = false;
            self::$Model[0] = new users_load(self::$Request);
            self::$Response = self::$Model[0]->get_Response();
            unset(self::$Model[0]);
            self::$Response['Response'] = true;
            header('Content-Type: application/json');
            echo json_encode(self::$Response);
          break;
        }
      }
      private static function is_Request($Request){
        return isset($Request) ? true : false;
      }
      public static function Initialize(){   
        self::$Action   =  $_GET['action'];
        self::$Model    =  array();
        self::$Request  =  null;
        self::set_Response();
        self::get_Request();
      }
      public function __destruct(){
        die('No se instancian objetos');
      }
    }

    Usuarios::Initialize();
?>
