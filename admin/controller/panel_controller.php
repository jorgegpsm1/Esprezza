<?php
  class Panel_Controller{
    private $USER_ID;
    private $USER_SESSION;
    private $USER_INFO;
    private $USER_ACCESS;
    
    public function __construct(){
      $this->USER_ID        =   $_SESSION['ID'];
      $this->USER_SESSION   =   $_SESSION['SESSION'];
      //$this->get_USER_INFO();
      $this->get_USER_ACCESS();
    }
    /*private function get_USER_INFO(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_info_model.php');
      $this->USER_INFO = new User_Info_Model();
      $this->USER_INFO = $this->USER_INFO->get_Response();
    }*/
    private function get_user_access(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_access_model.php');
      $this->USER_ACCESS = new User_Access_Model();
      $this->USER_ACCESS = $this->USER_ACCESS->get_Response();
    }
    private function set_view(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/model/class/user_access_model.php');
      $this->USER_ACCESS = new User_Access_Model();
      $this->USER_ACCESS = $this->USER_ACCESS->get_Response();
    }
    public function Initialize(){
      require_once($_SESSION['BASE_DIR_BACKEND'].'/view/panel_view.php');
    }
    public function __destruct(){
    }
  }
?>