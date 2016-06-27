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

  /*foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/clase/*.php' ) as $Filename){
      require_once (  $Filename );
  }*/
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/clase/catalogo.php');
  use Admin\Model\Clase\Catalogo as Catalogo_Model;

  class Catalogo{
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
        case ('1.4.1'):
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
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;

            case ('4'):
              $Json   = file_get_contents('php://input');
              $Input  = json_decode($Json,true);
              self::$Request                    = $Input;
              self::$Request['ProyectID']       = self::$Request['ProyectID'];
              self::$Request['UserID']          = self::$Request['UserID'];
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;

            case ('5'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
          }
        break;
        case ('1.4.2'):
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
              self::$Request['ProyectID']       = self::$Request['ProyectID'];
              self::$Request['ColorSelection']  = self::$Request['ColorSelection'];
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;

            case ('4'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
          }
        break;
        case ('1.4.3'):
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
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;

            case ('4'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
          }
        break;
        case ('1.4.4'):
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
              self::$Request['ProyectID']       = self::$Request['ProyectID'];
              self::$Request['ColorSelection']  = self::$Request['ColorSelection'];
              self::$Request['url']             = self::$Url;
              self::$Request['action']          = self::$Action;
            break;

            case ('4'):
              self::$Request['url']     = self::$Url;
              self::$Request['action']  = self::$Action;
            break;
          }
        break;
      }
    } 

    private static function get_Response(){
      self::$Response = Catalogo_Model::Initialize(self::$Request);
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

  Catalogo::Initialize();
?>
