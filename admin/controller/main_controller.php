<?php
  // Clase Controladora Principal
  class Main_Controller{
    private static $Instance  = null;

    public function __construct(){
      die('No se instancian objetos');
    }
    // Comprueba si existen las cookies
    private static function is_Cookies(){
      return (isset($_COOKIE['__ugate']) && isset($_COOKIE['__uanchor']) && isset($_COOKIE['__ukey']))  ?  '2' : '1';
    }
    // Comprueba si la session se incicializo correctamente
    private static function is_Session(){
      $_SESSION['ACTION'] = isset($_SESSION['ID']) ? '3' : self::is_Cookies();
    }
    //  SESSION ACTION
    // 1. Si no existen cookies
    // 2. Si existen las cookies
    // 3. Si session ID esta seteado
    public static function Initialize(){
      self::is_Session();
      switch($_SESSION['ACTION']){ 
        case ('1'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/login_controller.php');
          Login_Controller::Initialize();
          break;
        case ('2'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/login_controller.php');
          Login_Controller::Initialize();
          break;
        case ('3'):
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/panel_controller.php');
          $Instance = new Panel_Controller();
          $Instance->Initialize();
          break;
        default:
          break;
      }
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
  Main_Controller::Initialize();
?>

