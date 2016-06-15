<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class user_info{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct(){
      $this->Response         = array();
      $this->Response['INFO'] = array();
      $this->Connection       = Database::Connect();
      $this->Action           = '1';
    }
    public function get_Response(){
      while($this->Action != '0'){
        $this->set_Response();
      }
      return array($this->Response['INFO']);   
    }
    private function set_Query($_KEY = 0){
      switch($this->Action){
        case ('1'):
          return ("SELECT id_job, id_role, user_name, user_last_name, user_img FROM user_info WHERE id_user = :ID_USER_INFO");
        break;
        case ('2'):
          return ("SELECT job_name FROM jobs WHERE id_job = :ID_USER_JOB");
        break;
        case ('3'):
          return ("SELECT role_name FROM roles_{$_KEY} WHERE id_role = :ID_USER_ROLE");
        break;
      }
    }
    private function set_Response(){
      switch($this->Action){
        case ('1'):
          try{
            $result = $this->Connection->prepare($this->set_Query());
            $result->bindParam(':ID_USER_INFO',$_SESSION['ID']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              $this->Response['INFO']['JOB']      = $row['id_job'];
              $this->Response['INFO']['ROLE']     = $row['id_role'];
              $this->Response['INFO']['NAME']     = $row['user_name'].' '.$row['user_last_name'];
              $this->Response['INFO']['IMG']      = $row['user_img'];
            }
            $this->Action       = '2';       
          }
          catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
        break;
        case ('2'):
          try{
            $result = $this->Connection->prepare($this->set_Query());
            $result->bindParam(':ID_USER_JOB',$this->Response['INFO']['JOB']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              $this->Response['INFO']['JOB_NAME']    = $row['job_name'];
            }
            $this->Action       = '3';
          }
          catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
        break;
        case ('3'):
        try{
          $result = $this->Connection->prepare($this->set_Query($this->Response['INFO']['JOB']));
          $result->bindParam(':ID_USER_ROLE',$this->Response['INFO']['ROLE']);
          $result->execute();
          while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $this->Response['INFO']['ROLE_NAME']    = $row['role_name'];
          }
          $this->Action       = '0';
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

