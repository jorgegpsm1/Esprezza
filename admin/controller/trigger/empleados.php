<?php namespace Admin\Controller\Trigger;

  if( !isset( $_GET['urls'] ) ||  !isset(  $_GET['action'] ) ){
    $Response = array('Success' => false);
    header('Content-Type: application/json');
    echo json_encode($Response);
  }
  else{
    $Response = array('Success' => false );
    date_default_timezone_set('America/Mexico_City');
    @session_start();
  }

  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/clase/empleados.php');
  use Admin\Model\Clase\Empleados as Empleado_Model;

  class Empleados{
    private static $Request;
    private static $Response;
    private static $Url;
    private static $Action;
    private static $Model;

    public function __construct(){
      die('No se instancian objetos');
    }
    private static function set_Request(){
      switch (self::$Url){
        case ('1.1.2'):
          switch (self::$Action){
            case ('1'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
            case ('2'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
            case ('3'):
              $Json   = file_get_contents('php://input');
              $Input  = json_decode($Json,true);
              self::$Request                    = $Input;
              self::$Request['Passwd']          = self::$Request['Username'].'?'.self::$Request['Passwd'].'?'.'uralvasm';
              self::$Request['Passwd']          = password_hash(self::$Request['Passwd'], PASSWORD_DEFAULT);           
              self::$Request['Gender']          = (!self::$Request['Gender']) ? "default_avatar_male.jpg" : "default_avatar_female.jpg";
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;
            case ('4'):
              $Json   = file_get_contents('php://input');
              $Input  = json_decode($Json,true);
              self::$Request['Username']        = $_GET['Username'];
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;
            case ('5'):
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;
          }
        break;
      }
    } 

    private static function get_Response(){
      self::$Response = Empleado_Model::Initialize(self::$Request);
      self::$Response['Success'] = (empty(self::$Response)) ? false : true;
      header('Content-Type: application/json');
      echo json_encode(self::$Response);
    }
    public static function Initialize(){   
      self::$Url     =   $_GET['urls'];
      self::$Action  =   $_GET['action'];
      self::set_Request();
      self::get_Response();
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }

  Empleados::Initialize();
?>
