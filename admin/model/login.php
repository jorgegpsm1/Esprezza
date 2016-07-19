<?php namespace Admin\Model;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\Config\Database_a as Database_System;
  use \PDO;

  class Login{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct(  $Input ){
      $this->Connection   = Database_System::Connect();
      $this->set_Request( $Input );
    }
    private function set_Query( $KEY_1 = 0 ){
      switch ( $this->Action ){
        case ( '1' ):
          return (  "SELECT user_id, user_name, user_passwd, user_status  FROM users" );
        break;
        case ('1.1'):
          return (  "SELECT user_session, user_passwd FROM users_session WHERE user_id = :ID_USER"  );
        break;
        case ('1.2'):
          return (  "UPDATE users_session SET user_session = :ID_SESSION WHERE user_id = :ID_USER"  );
        break;
        case '1.3':
          return (  "INSERT INTO users_access_{$KEY_1} (session_id, user_passwd, user_date_created, user_date_current, user_date_temp, user_ip, user_browser, user_device) 
                                                      VALUES (:ID_SESSION, :PASSWORD, :DATE_CREATED, :DATE_CURRENT, :DATE_TEMP, :IP_USER, :BROWSER, :DEVICE)" );
        break;
        case '2':
          return (  "SELECT user_passwd, user_date_temp FROM users_access_{$KEY_1} WHERE session_id = :ID_SESSION"  );
        break;
        case '2.1':
          return (  "UPDATE users_access_{$KEY_1} SET user_date_current = :DATE_CURRENT WHERE session_id = :ID_SESSION"  );
        break;
      }
    }

    private function set_Request( $Input ){
      $this->Request    = $Input;
      $this->Action     = $this->Request['Action'];
    }

    public function get_Response(){
      $this->set_Response();
      return $this->Response;
    }

    private function set_Response(){
      switch($this->Action){ 
        case ( '1' ):
          try{
            $this->Response['Success'] = false;

            $result = $this->Connection->prepare($this->set_Query());
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              if( $row['user_name'] == $this->Request['NameUser'] ){
                if( password_verify(  $this->Request['PasswordUser']  ,  $row['user_passwd']) && $row['user_status'] == 1){
                  $this->Request['ID']   = $row['user_id'];
                  $this->Response['Success'] = true;
                  break;
                }
              }
            }

            if(!$this->Response['Success']){
              return; 
            }
            $result->closeCursor();
            $this->Action = '1.1';
            $this->Response['Success'] = false;

            $result = $this->Connection->prepare($this->set_Query());
            $result->bindParam(':ID_USER',$this->Request['ID']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              $this->Request['SESSION'] = $row['user_session'];
              $this->Request['PASSWD']  = $row['user_passwd'];
              $this->Response['Success'] = true;
            }

            if(!$this->Response['Success']){
              return; 
            }
            $result->closeCursor();
            $this->Action = '1.2';
            $this->Response['Success'] = false;

            $result = $this->Connection->prepare($this->set_Query());
            $this->Request['SESSION']++;
            $result->bindParam(':ID_USER',$this->Request['ID']);
            $result->bindParam(':ID_SESSION',$this->Request['SESSION']);
            $result->execute();
            $this->Response['Success'] = true;

            $result->closeCursor();
            $this->Action = '1.3';
            $this->Response['Success'] = false;

            $result = $this->Connection->prepare($this->set_Query($this->Request['ID']));
            $this->Request['PASSWD'] = sha1($this->Request['PASSWD'].'?'.$this->Request['SESSION']);
            $this->Request['SESSION']++;
            $result->bindParam(':ID_SESSION',$this->Request['SESSION']);
            $result->bindParam(':PASSWORD',$this->Request['PASSWD']);
            $result->bindParam(':DATE_CREATED',$this->Request['DATE']);
            $result->bindParam(':DATE_CURRENT',$this->Request['DATE']);
            $result->bindParam(':DATE_TEMP',$this->Request['DATE_TEMP']);
            $result->bindParam(':IP_USER',$this->Request['IP']);
            $result->bindParam(':BROWSER',$this->Request['BrowserUser']);
            $result->bindParam(':DEVICE',$this->Request['SystemrUser']);
            $result->execute();

            $this->Response['ID'] = $this->Request['ID'];
            $this->Response['PASSWD'] = $this->Request['PASSWD'];
            $this->Response['SESSION'] = $this->Request['SESSION'];
            $this->Response['Success'] = true;
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
            $this->Response['Success'] = false;
            $result = $this->Connection->prepare($this->set_Query($this->Request['__ugate']));
            $result->bindParam(':ID_SESSION',$this->Request['__uanchor']);
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              if( $this->Request['__ukey'] == $row['user_passwd'] ){
                if(strtotime(date('Y-m-d H:i:s')) <= strtotime($row['user_date_temp'])){
                  $this->Response['TEMP']    =  $row['user_date_temp'];
                  $this->Response['Success'] = true;
                }
              }
            }
            if($this->Response['Success']){
              $this->Action = '2.1';
              $this->Response['DATE'] = date('Y-m-d H:i:s');
              $result = $this->Connection->prepare($this->set_Query($this->Request['__ugate']));
              $result->bindParam(':ID_SESSION',$this->Request['__uanchor']);
              $result->bindParam(':DATE_CURRENT',$this->Request['DATE']);
              $result->execute();
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
      Database_System::Disconnect();
    }
  }
?>
