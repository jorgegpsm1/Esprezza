<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class user_info{
    private $Request;
    private $Response;
    private $Connection;
    private $Query;
    private $Action;

    public function __construct(){
      $this->Response     = array();
      $this->Connection   = Database::Connect();
      $this->Action       = '1';
    }
    public function get_Response(){
      $this->set_Response();
      return array($this->Response['INFO']);   
    }
    private function set_Query($KEY_1 = 0){
      switch($this->Action){
        case ('1'):
          return ("SELECT id_job, user_name, user_last_name, user_img FROM user_info WHERE id_user = {$KEY_1}");
        break;
        case ('2'):
          return ("SELECT job_name FROM user_job WHERE id_job = {$KEY_1}");
        break;
      }
    }
    private function set_Response(){
      $this->Response['INFO'] = array();
      switch($this->Action){
        case ('1'):
        try{
          $result = $this->Connection->prepare($this->set_Query($_SESSION['ID']));
          $result->execute();
          while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $this->Response['INFO']['JOB']    = $row['id_job'];
            $this->Response['INFO']['NAME']   = $row['user_name'].' '.$row['user_last_name'];
            $this->Response['INFO']['IMG']    = $row['user_img'];
          }
          $this->Action       = '2';
        }
        catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
        catch(Exception $e){
          echo "General Error: The user could not be added.<br>".$e->getMessage();
        }

        try{
          $result = $this->Connection->prepare($this->set_Query($this->Response['INFO']['JOB']));
          $result->execute();
          while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $this->Response['INFO']['JOB']    = $row['job_name'];
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

