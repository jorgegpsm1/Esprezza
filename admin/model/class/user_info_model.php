<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class User_Info_Model{
    private $Request;
    private $Response;
    private $Connection;
    private $Query;
    private $Action;

    public function __construct(){
      $this->Connection   = Database::Connect();
      $this->Action       = '1';
    }
    private function get_Response(){
      $this->set_Query();
      $this->set_Response();
      return $this->Response;   
    }
    private function set_Query(){
      switch($this->Action){
        case '1':
          $this->Query['KEY']   =   null;
          $this->Query['SQL_A'] =   "SELECT ID_DEPARTMENT, DEPARTMENT_STATUS FROM DEPARTMENT";
          $this->Query['SQL_B'] =   "SELECT USER_DEPARTMENT_STATUS FROM DEPARTMENT_USER_ACCESS_{$this->Query[KEY]} WHERE ID_USER = {$_SESSION[ID]}";
          break;
        
        default:
          break;
      }
    }
    private function set_Response(){
      switch($this->Action){
        case '1':
        try{
          $this->Response['DEPARTMENT'] = array();
          $this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'] = array();
          $result_1 = $this->Connection->prepare($this->Query['SQL_A']);
          $result_1->execute();
          while($row = $result_1->fetch(PDO::FETCH_ASSOC)){
            if($row['ID_DEPARTMENT'] == 1){
              array_push($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'],$row['ID_DEPARTMENT']);
            }
          }
          $Count = count($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS']);
          $result_2->closeCursor();
          for(int $i=1; $i<=$Count; $i++){
            $this->Query['KEY'] = $i;
            $result_2 = $this->Connection->prepare($this->Query['SQL_B']);
            $result_2->execute();
            while($row = $result_2->fetch(PDO::FETCH_ASSOC)){
              if($row['USER_DEPARTMENT_STATUS'] == 1){
                array_push($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'],$i);
              }
            }
          }
        }
        catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
        catch(Exception $e){
          echo "General Error: The user could not be added.<br>".$e->getMessage();
        }
        break;
        
        default:
          break;
      }

    }
    public function __destruct(){
      Database::Disconnect();
    }
  }
?>

