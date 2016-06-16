<?php
  if(!isset($_GET['action'])){
    die('Error Intenro');
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
          case ('0'):
          self::$Request['Action'] = self::$Action;
          self::$Response = null;
          break;
          case ('1'):
          self::$Request['Action'] = self::$Action;
          self::$Response = null;
          break;
          case ('2'):
          self::$Request['Action'] = self::$Action;
          self::$Response = null;
          break;
          case ('5'):
          $Json   = file_get_contents('php://input');
          $Input  = json_decode($Json,true);
          if(!self::is_Request($Input)){
            die("Error Interno");
          }
          self::$Request                      = $Input;
          self::$Request['NameUser']          = htmlspecialchars(trim(self::$Request['NameUser']));
          self::$Request['PasswordUser']      = htmlspecialchars(trim(self::$Request['PasswordUser']));
          self::$Request['Name_first']        = htmlspecialchars(trim(self::$Request['Name_first']));
          self::$Request['Name_last']         = (isset(self::$Request['Name_last'])) ? htmlspecialchars(trim(self::$Request['Name_last'])) : "";
          self::$Request['first_name']        = htmlspecialchars(trim(self::$Request['first_name']));
          self::$Request['last_name']         = htmlspecialchars(trim(self::$Request['last_name']));
          self::$Request['Gener']             = htmlspecialchars(trim(self::$Request['Gener']));
          self::$Request['Gener']             = (self::$Request['Gener']==0) ? "default_avatar_male.jpg" : "default_avatar_female.jpg";
          self::$Request['Departamento']      = htmlspecialchars(trim(self::$Request['Departamento']));
          self::$Request['Area']              = htmlspecialchars(trim(self::$Request['Area']));
          self::$Request['PasswordUser']      = self::$Request['NameUser'].'?'.self::$Request['PasswordUser'].'?'.'uralvasm';
          self::$Request['PasswordUser']      = password_hash(self::$Request['PasswordUser'], PASSWORD_DEFAULT);
          self::$Request['Action']            = self::$Action;
          self::$Response = null;
          /*echo "<pre>";
          print_r(self::$Request);
          echo "</pre>";
          die("gfg");*/
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
        }
      }
      private static function is_Request($Request){
        return isset($Request) ? true : false;
      }
      public static function Initialize(){   
        self::$Action   =  $_GET['action'];
        self::$Model    =  array();
        self::$Request  = null;
        self::set_Response();
        self::get_Request();
      }
      public function __destruct(){
        die('No se instancian objetos');
      }
    }

    Usuarios::Initialize();
?>
