<?php namespace Admin\Controller;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/system/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\System\Info as UserInfo;
  use Admin\Model\System\Access as UserAccess;


  class Panel{
    private static $USER_INFO;
    private static $USER_ACCESS;
    
    public function __construct(){
      die('No se instancian objetos');
    }
    private static function get_user_info(){
      self::$USER_INFO = new UserInfo();
      self::$USER_INFO = self::$USER_INFO->get_Response();
    }
    private static function get_user_access(){
      self::$USER_ACCESS = new UserAccess(array("Action" => "0"));
      self::$USER_ACCESS = self::$USER_ACCESS->get_Response();
    }
    public static function Initialize(){
      self::get_user_info();
      self::get_user_access();
      require_once($_SESSION['BASE_DIR_BACKEND'].'/view/panel.php');
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>