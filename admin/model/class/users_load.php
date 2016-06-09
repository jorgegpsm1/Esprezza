<?php
   @session_start();
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class users_load{
    private $Request;
    private $Response;
    private $Connection;
    private $Query;
    private $Action;
    
    public function __construct($Input){
      $this->Connection    = Database::Connect();
      $this->set_Request($Input);
    }
    private function set_Query(){
      switch ($this->Action){
        case ('0'):
          $this->Query['SQL_A']  = "SELECT id_user AS usuario, CONCAT(user_name,' ',user_last_name) AS nombre, id_job AS puesto FROM user_info";
          $this->Query['SQL_B']  = "SELECT job_name AS puesto_nombre FROM user_job WHERE id_job = :ID_JOB_USER";
          break;
      }
    }
    private function set_Request($Input){
      $this->Request    = $Input;
      $this->Action     = $this->Request['Action'];
    }
    public function get_Response(){
      $this->set_Query();
      $this->set_Response();
      return $this->Response;
    }
    private function set_Response(){
      switch($this->Action){ 
        case ('0'):
          try{
            $this->Response['Columnas']   =  array('ID','Empleado','Puesto','Acciones');
            $this->Response['Filas']   =  array();
            $result = $this->Connection->prepare($this->Query['SQL_A']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_NUM)){
               array_push($this->Response['Filas'],$row);
            }
          }
         catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
          try{
            $index   =  count($this->Response['Filas']);
            for($x=0;$x<$index;$x++){
               for($y=0;$y<=2;$y++){
                  if($y==2){
                     $result = $this->Connection->prepare($this->Query['SQL_B']);
                     $result->bindParam(':ID_JOB_USER',$this->Response['Filas'][$x][$y]);
                     $result->execute();
                     while($row = $result->fetch(PDO::FETCH_NUM)){
                        $this->Response['Filas'][$x][$y] = $row[0];
                     }
                     $result->closeCursor();
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
      }
    }
    public function __destruct(){
      Database::Disconnect();
    }
  }
?>

