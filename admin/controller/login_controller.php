<?php
  class Login_Controller{
    
    public function __construct(){
      die('No se instancian objetos');
    }
    public static function Initialize(){
      switch($_SESSION['ACTION']){
        case ('1'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/view/login_view.php');
          break;
        case ('2'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/trigger/login_trigger.php');
          break;
        default:
          break;
      }
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>