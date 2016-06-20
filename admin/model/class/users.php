<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php'); 
  class Users{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct($Input){
      $this->Connection   = Database::Connect();

    }
    private function set_Query($KEY_1 = 0, $KEY_2 = 0, $KEY_3 = 0){
      switch($this->Action){
        case '0':
          return ("SELECT ID_DEPARTMENT, DEPARTMENT_NAME, DEPARTMENT_STATUS FROM DEPARTMENT");
        break;
        case '0.1':
          return ("SELECT USER_DEPARTMENT_STATUS FROM DEPARTMENT_USER_ACCESS_{$KEY_1} WHERE ID_USER = :USER_ID");
        break;
        case '0.2':
          return ("SELECT ID_AREA, AREA_NAME, AREA_STATUS FROM DEPARTMENT_AREA_{$KEY_1}");
        break;
        case '0.3':
          return ("SELECT USER_DEPARTMENT_AREA_STATUS FROM DEPARTMENT_AREA_USER_ACCESS_{$KEY_1}_{$KEY_2} WHERE ID_USER = :USER_ID");
        break;
        case '0.4':
          return ("SELECT id_module, module_name, module_status FROM module_{$KEY_1}_{$KEY_2}");
        break;
        case '0.5':
          return ("SELECT module_status FROM module_access_{$KEY_1}_{$KEY_2}_{$KEY_3} WHERE ID_USER = :USER_ID");
        break;
      }
    }
    private function set_Request($Input){
      $this->Request    = $Input;
      $this->Action     = $this->Request['Action'];
    }
    public function get_Response(){
      $this->set_Response();
      return $this->Response;
    }
    private function set_Response(){

    }
    public function __destruct(){
      Database::Disconnect();
    }
  }
?>
