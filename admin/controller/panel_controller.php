<?php
  class Panel_Controller{
    private static $USER_INFO;
    private static $USER_ACCESS;
    
    public function __construct(){
      die('No se instancian objetos');
    }
    private static function get_user_info(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_info.php');
      self::$USER_INFO = new user_info();
      self::$USER_INFO = self::$USER_INFO->get_Response();
    }
    private static function get_user_access(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_access.php');
      self::$USER_ACCESS = new user_access(array("Action" => "0"));
      self::$USER_ACCESS = self::$USER_ACCESS->get_Response();
    }
    public static function Initialize(){
      self::get_user_info();
      self::get_user_access();
      require_once($_SESSION['BASE_DIR_BACKEND'].'/view/panel_view.php');
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>