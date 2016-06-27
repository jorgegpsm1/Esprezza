<?php namespace Admin\Model\System;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\Config\Database_a as Database_System;
  use \PDO;

  class Info{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct(){
      $this->Response         = array();
      $this->Response['INFO'] = array();
      $this->Connection       = Database_System::Connect();
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
          return ("SELECT job_id, role_id, user_name, user_first_name, user_img FROM users_info WHERE user_id = :ID_USER");
        break;
        case ('2'):
          return ("SELECT job_name FROM jobs WHERE job_id = :ID_JOB");
        break;
        case ('3'):
          return ("SELECT role_name FROM roles_{$_KEY} WHERE role_id = :ID_USER_ROLE");
        break;
      }
    }
    private function set_Response(){
      switch($this->Action){
        case ('1'):
          try{
            $result = $this->Connection->prepare($this->set_Query());
            $result->bindParam(':ID_USER',$_SESSION['ID']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              $this->Response['INFO']['JOB']      = $row['job_id'];
              $this->Response['INFO']['ROLE']     = $row['role_id'];
              $this->Response['INFO']['NAME']     = $row['user_name'].' '.$row['user_first_name'];
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
            $result->bindParam(':ID_JOB',$this->Response['INFO']['JOB']);
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
      Database_System::Disconnect();
    }
  }
?>

