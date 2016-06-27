<?php namespace Admin\Controller\Trigger;

  if(!isset($_GET['action']) || !is_numeric($_GET['action'])){
    $Response = array('Response' => false);
    header('Content-Type: application/json');
    echo json_encode($Response);
  }
  else{
    $Response = array('Response' => false );
    date_default_timezone_set('America/Mexico_City');
    @session_start();
  }

  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/login.php');
  use Admin\Model\Login as Login_Model;
  use \PDO;

  class Login{
    private static $Request;
    private static $Response;
    private static $Action;
    private static $Model;

    public function __construct(){
      die('No se instancian objetos');
    }
    private static function set_Request(){
      switch (self::$Action){
        case ('1'):
          self::$Request = null;
          $Json   = file_get_contents('php://input');
          $Input  = json_decode($Json,true);
          if(empty($Input)){
            die("Vacios");
          }
          self::$Request                      = $Input;
          self::$Request['NameUser']          = htmlspecialchars(trim(self::$Request['NameUser']));
          self::$Request['PasswordUser']      = htmlspecialchars(trim(self::$Request['PasswordUser']));
          self::$Request['CheckUser']         = htmlspecialchars(trim(self::$Request['CheckUser']));
          self::$Request['PasswordUser']      = self::$Request['NameUser'].'?'.self::$Request['PasswordUser'].'?'.'uralvasm';
          self::$Request['IP']                = $_SERVER['REMOTE_ADDR'];
          self::$Request['SystemrUser']       = htmlspecialchars(trim(self::$Request['SystemrUser']));
          self::$Request['BrowserUser']       = htmlspecialchars(trim(self::$Request['BrowserUser']));
          self::$Request['DATE_TEMP']         = (!self::$Request['CheckUser']) ? date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s').'+1 hours')) : date('Y-m-d H:i:s' , strtotime(date('Y-m-d H:i:s').'+10 year'));
          self::$Request['DATE']              = date('Y-m-d H:i:s');
          self::$Request['Action']            = self::$Action;
        break;

        case ('2'):
          if(empty($_COOKIE['__uanchor'])){
            die("Vacios");
          }
          self::$Request                      = $_COOKIE;
          self::$Request['__uanchor']         = htmlspecialchars(trim(self::$Request['__uanchor']));
          self::$Request['__ugate']           = htmlspecialchars(trim(self::$Request['__ugate']));
          self::$Request['__ukey']            = htmlspecialchars(trim(self::$Request['__ukey']));
          self::$Request['Action']            = self::$Action;
        break;

        default:
          echo json_encode($Response);
        break;
      }
    } 

    private static function get_Response(){
      switch (self::$Action){
        case ('1'):
          self::$Model = new Login_Model( self::$Request  );
          self::$Response = self::$Model->get_Response();
          if(self::$Response['Success']){
            if(self::is_Autologin()){
              self::set_Session();       
            }
            else{
              self::set_Session_temp();
            }
          }
          self::$Model = null;
          header('Content-Type: application/json');
          echo json_encode(self::$Response);
          break;

        case ('2'):
          self::$Model    = new Login_Model(  self::$Request  );
          self::$Response = self::$Model->get_Response();
          if(!self::$Response['Success'])
            self::unset_Session();
          else{
            self::$Model = null;
            $_SESSION['ID']       = $_COOKIE['__ugate'];
            $_SESSION['SESSION']  = $_COOKIE['__uanchor'];
            $_SESSION['TEMP']     = self::$Response['TEMP'];
            header("Location: {$_SESSION['BASE_DIR_FRONTEND']}/index.php");
            exit();
          }
        break;
      }
    }
    private static function is_Autologin(){
      return (self::$Request['CheckUser'])? true : false;
    }
    private static function unset_Session(){
      setcookie('__ugate', null, time()-1000, '/');
      setcookie('__uanchor', null, time()-1000, '/');
      setcookie('__ukey', null, time()-1000, '/');
    }
    private static function set_Session(){
      header('Cache-control: private'); 
      header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT'); 
      header('Cache-Control: no-store, no-cache, must-revalidate'); 
      header('Cache-Control: post-check=0, pre-check=0', false); 
      header('Pragma: no-cache');

      $cookie_time = (10 * 365 * 24 * 60 * 60);
      setcookie('__ugate',self::$Response['ID'],time() + $cookie_time, '/');
      setcookie('__uanchor',self::$Response['SESSION'],time() + $cookie_time, '/');
      setcookie('__ukey',self::$Response['PASSWD'],time() + $cookie_time, '/');
    }
    private static function set_Session_temp(){
      header('Cache-control: private'); 
      header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT'); 
      header('Cache-Control: no-store, no-cache, must-revalidate'); 
      header('Cache-Control: post-check=0, pre-check=0', false); 
      header('Pragma: no-cache');

      $cookie_time = (60 * 60);
      setcookie('__ugate',self::$Response['ID'],time() + $cookie_time, '/');
      setcookie('__uanchor',self::$Response['SESSION'],time() + $cookie_time, '/');
      setcookie('__ukey',self::$Response['PASSWD'],time() + $cookie_time, '/');
    }
    public static function Initialize(){   
      self::$Action   =  $_GET['action'];
      self::set_Request();
      self::get_Response();
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }

  Login::Initialize();
?>
