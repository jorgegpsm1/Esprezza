<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class Login_Model{
    private $Request;
    private $Response;
    private $Connection;
    private $Query;
    private $Action;
    
    public function __construct(){
      $this->Connection   = Database::Connect();
    }
    private function set_Query(){
      switch ($this->Action){
        case '1':
          $this->Query['SQL_A']       = "SELECT ID_USER, USER_LOGIN_NAME, USER_LOGIN_PASS, USER_STATUS  FROM USER_ACCESS";
          break;
        case '1.1':
          $this->Query['SQL_A']       = "SELECT ID_USER, USER_SESSIONS, USER_SESSION_PASS FROM USER_SESSION_ACCESS";
          $this->Query['SQL_B']       = "UPDATE USER_SESSION_ACCESS SET USER_SESSIONS = :SESSION WHERE ID_USER = :ID";
          break;

        case '1.2':
          $this->Query['SQL_A']       = "INSERT INTO USER_SESSIONS_ACCESS_{$this->Request['ID']} (ID_SESSION, USER_KEY, USER_IP, USER_BROWSER, USER_SESSION_TEMP) 
                                                                                          VALUES (:SESSION, :KEY, :IP, :BROWSER, :SESSION_TEMP)";
          break;

        case '2':
          $this->Query['SQL_A']       = "SELECT  ID_SESSION, USER_KEY FROM  USER_SESSIONS_ACCESS_{$this->Request['__ugate']}";
          break;

        default:
          break;
      }
    }
    private function get_Request($Request){
      $this->Request    = $Request;
      $this->Response   = null;
      $this->Query      = null;
      $this->Action     = $this->Request['Action'];
    }
    public function get_Response($Input){
      $this->get_Request($Input);
      $this->set_Query();
      $this->set_Response();
      return $this->Response;
    }
    private function set_Response(){
      switch($this->Action){ 
        case '1':
          try{
            $this->Response['Success'] = false;
            $result_1 = $this->Connection->prepare($this->Query['SQL_A']);
            $result_1->execute();
            while($row = $result_1->fetch(PDO::FETCH_ASSOC)){
              if($row['USER_LOGIN_NAME'] == $this->Request['NameUser']){
                if(password_verify($this->Request['PasswordUser'],$row['USER_LOGIN_PASS']) && $row['USER_STATUS'] == 1){
                  $this->Response['Success'] = true;
                  $this->Response['ID']   = $row['ID_USER'];
                  break;
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

          case '1.1':
          $this->Response['Success'] = false;
          try{
            $result_1 = $this->Connection->prepare($this->Query['SQL_A']);
            $result_2 = $this->Connection->prepare($this->Query['SQL_B']);
            $result_1->execute();
            while($row = $result_1->fetch(PDO::FETCH_ASSOC)){
              if($row['ID_USER'] == $this->Request['ID']){
                $this->Response['ID']       = $row['ID_USER'];
                $this->Response['Session']  = $row['USER_SESSIONS'];
                $this->Response['Key']      = $row['USER_SESSION_PASS'];
                $this->Response['Session']+=1;
                break;
                }
              }
            $result_2->bindParam(':ID',$this->Response['ID']);
            $result_2->bindParam(':SESSION',$this->Response['Session']);
            $result_2->execute();
            $this->Response['Success']  = true;
          }
          catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
          break;
        case '1.2':
          try{
            $this->Response['Success'] = false;
            $result_1 = $this->Connection->prepare($this->Query['SQL_A']);
            $result_1->bindParam(':SESSION',$this->Request['Sessions']);
            $result_1->bindParam(':KEY',$this->Request['Key']);
            $result_1->bindParam(':IP',$this->Request['Ip']);
            $result_1->bindParam(':BROWSER',$this->Request['Browser']);
            $result_1->bindParam(':SESSION_TEMP',$this->Request['Temp']);
            $result_1->execute();
            $this->Response['Success']  = true;
          }
          catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
          break;

        case '2':
          try{
            $this->Response['Success'] = false;
            $result = $this->Connection->prepare($this->Query['SQL_A']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              if($row['ID_SESSION'] == $this->Request['__uanchor']){
                if($row['USER_KEY'] == $this->Request['__ukey']){
                  $this->Response['Success']  = true;
                  break;
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
