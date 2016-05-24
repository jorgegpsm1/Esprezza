<?php
  class Login_Controller{
    private $Action = null;
    
    public function __construct(){
      $this->Action = $_SESSION['ACTION'];
    }
    public function Initialize(){
      switch($this->Action){
        case '1':
          require_once($_SESSION['BASE_DIR_BACKEND'].'/view/login_view.php');
          break;
        case '2':
          require_once($_SESSION['BASE_DIR_BACKEND'].'/controller/trigger/login_trigger.php');
          break;
        default:
          break;
      }
    }
    public function __destruct(){
    }
  }
?>