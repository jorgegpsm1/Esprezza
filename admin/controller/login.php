<?php namespace Admin\Controller;

  class Login{
    public function __construct(){
      die('No se instancian objetos');
    }
    public static function Initialize(){
      switch($_SESSION['ACTION']){
        case ('1'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/view/login.php');
        break;
        case ('2'):
          $_GET['action'] = '2';
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/trigger/login.php');
        break;
      }
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>