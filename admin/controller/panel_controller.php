<?php
  class Panel_Controller{
    private $USER_ID;
    private $USER_SESSION;
    private $USER_INFO;
    private $USER_ACCESS;
    
    public function __construct(){
      $this->USER_ID        =   $_SESSION['ID'];
      $this->USER_SESSION   =   $_SESSION['SESSION'];
      $this->get_user_info();
      $this->get_user_access();
    }
    private function get_user_info(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_info.php');
      $this->USER_INFO = new user_info();
      $this->USER_INFO = $this->USER_INFO->get_Response();
    }
    private function get_user_access(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_access.php');
      $this->USER_ACCESS = new user_access();
      $this->USER_ACCESS = $this->USER_ACCESS->get_Response();
    }
    public function Initialize(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/view/panel_view.php');
      }
    public function __destruct(){
    }
  }
?>