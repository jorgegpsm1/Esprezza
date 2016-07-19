<?php namespace Admin\Model\Clase;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\Config\Database_sqlserver as Database_SQLSERVER;
  use Admin\Model\Config\Database_mysql as Database_MYSQL;
  use \PDO;

  class Empleados{
    private static $Request;
    private static $Response;
    private static $Connection;
    private static $Url;
    private static $Action;

    public function __construct( ){
      die('No se instancian objetos');
    }
    private static function set_Query(  $KEY_1 = 0, $KEY_2 = 0, $KEY_3 = 0 ){
      switch (self::$Url){
        case ('1.1.2'):
          switch (self::$Action){
            case ('1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM jobs)  THEN '1'  ELSE '0'  END job_id");
            break;
            case ('1.1'):
              return  ("SELECT job_id, job_name FROM jobs ORDER BY job_id ASC");
            break;
            case ('1.2'):
              return  ("SELECT role_id, role_name FROM roles_{$KEY_1}");
            break;
            case ('2'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM departments)  THEN '1'  ELSE '0'  END department_id");
            break;
            case ('2.1'):
              return  ("SELECT department_id, department_name FROM departments ORDER BY department_id ASC");
            break;
            case ('2.2'):
              return  ("SELECT area_id, area_name FROM area_{$KEY_1} ORDER BY area_id ASC");
            break;
            case ('2.3'):
              return  ("SELECT module_id, module_name FROM module_{$KEY_1}_{$KEY_2} ORDER BY module_id ASC");
            break;
            case ('3'):
              return ("SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1");
            break;
            case ('3.1'):
              return ("INSERT INTO users (user_id, user_name, user_passwd ) VALUES (:ID_USER, :USER_NAME, :USER_PASSWD)");
            break;
            case ('3.2'):
              return ("INSERT INTO users_session (user_id, user_session, user_passwd) VALUES (:ID_USUARIO, :SESSION_USUARIO, :SESSION_PASSWORD)");
            break;
            case ('3.3'):
              return ("create table IF NOT EXISTS users_access_{$KEY_1}(
                    session_id tinyint unsigned NOT NULL UNIQUE,
                    user_passwd varchar(255) NOT NULL,
                    user_date_created TIMESTAMP,
                    user_date_current TIMESTAMP,
                    user_date_temp TIMESTAMP,
                    user_ip varchar(50) NOT NULL,
                    user_browser varchar(50) NOT NULL,
                    user_device varchar(50) NOT NULL
                  )ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;");
            break;
            case ('3.4'):
              return ("INSERT INTO users_info (user_id, job_id, role_id, user_firstname, user_lastname, user_first_name, user_last_name, user_img) VALUES (:ID_USUARIO, :ID_JOB, :ID_ROL, :NOMBRE_1, :NOMBRE_2, :APELLIDO_PATERNO, :APELLIDO_MATERNO, :USER_IMG)");
            break;
            case ('3.5'):
              return ("INSERT INTO department_user_{$KEY_1} (user_id, user_status) VALUES (:ID_USUARIO, :ID_STATUS)");
            break;
            case ('3.6'):
              return ("INSERT INTO area_user_{$KEY_1}_{$KEY_2} (user_id, user_status) VALUES (:ID_USUARIO, :ID_STATUS)");
            break;
            case ('3.7'):
              return ("INSERT INTO module_access_{$KEY_1}_{$KEY_2}_{$KEY_3} (user_id, user_status) VALUES (:ID_USUARIO, :ID_STATUS)");
            break;
            case ('4'):
              return ("SELECT user_name FROM users");
            break;
          }
        break;
      }
    }
    private static function get_Response(){
      switch (self::$Url){
        case ('1.1.2'):
          switch (self::$Action){
            case ('1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['job_id']==0){
                    self::$Response['jobs'] = 0;
                  }
                  else{
                    self::$Response['jobs'] = 1;
                    self::$Response['Data']=array();
                  }
                }
                self::$Action = '1.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;    
            case ('1.1'):
              try{
                if(self::$Response['jobs']){
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['job_id'],$row['job_name']));
                  }
                }
                self::$Action = '1.2';
                self::get_Response();
                self::closeConnection();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break; 
            case ('1.2'):
              try{
                if(self::$Response['jobs']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    self::$Response['Data'][1][$x]=array();
                    $result = self::$Connection->prepare(self::set_Query(self::$Response['Data'][0][$x][0]));
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1][$x],array($row['role_id'],$row['role_name']));
                    }
                  }
                }
                self::$Response['Data'] = (empty(self::$Response['Data'][1])) ? 0 : self::$Response['Data'];
                self::closeConnection();
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
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['department_id']==0){
                    self::$Response['department'] = 0;
                  }
                  else{
                    self::$Response['department'] = 1;
                    self::$Response['Data']=array();
                  }
                }
                self::$Action = '2.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('2.1'):
              try{
                if(self::$Response['department']){
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['department_id'],$row['department_name']));
                  }
                }
                self::$Action = '2.2';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('2.2'):
              try{
                if(self::$Response['department']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    self::$Response['Data'][1][$x]=array();
                    $result = self::$Connection->prepare(self::set_Query(self::$Response['Data'][0][$x][0]));
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1][$x],array($row['area_id'],$row['area_name']));
                    }
                  }
                }
                self::$Action = '2.3';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('2.3'):
              try{
                if(self::$Response['department']){
                  self::$Response['Data'][2]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    self::$Response['Data'][2][$x]=array();
                    for($y=0; $y<count(self::$Response['Data'][1][$x]); $y++){
                      self::$Response['Data'][2][$x][$y]=array();
                      $result = self::$Connection->prepare(self::set_Query(self::$Response['Data'][0][$x][0],self::$Response['Data'][1][$x][$y][0]));
                      $result->execute();
                      while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        array_push(self::$Response['Data'][2][$x][$y],array($row['module_id'],$row['module_name']));
                      }
                    }
                  }
                }
                self::closeConnection();
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
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  self::$Request['Data']=$row['user_id'];
                }
                self::$Request['Data']++;
                self::$Action = '3.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->bindParam(':ID_USER',self::$Request['Data']);
                $result->bindParam(':USER_NAME',self::$Request['Username']);
                $result->bindParam(':USER_PASSWD',self::$Request['Passwd']);
                $result->execute();
                self::$Action = '3.2';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.2'):
              try{
                self::$Request['SessionUser']=0;
                self::$Request['PasswordSession'] = sha1(self::$Request['Passwd']."?".self::$Request['Data']."?".self::$Request['SessionUser']) 
                $result = self::$Connection->prepare(self::set_Query());
                $result->bindParam(':ID_USUARIO',self::$Request['Data']);
                $result->bindParam(':SESSION_USUARIO',self::$Request['SessionUser']);
                $result->bindParam(':SESSION_PASSWORD',self::$Request['PasswordSession']);
                $result->execute();
                self::$Action = '3.3';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.3'):
              try{
                $result = self::$Connection->prepare(self::set_Query(self::$Request['Data']));
                $result->execute();
                self::$Action = '3.4';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.4'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->bindParam(':ID_USUARIO',self::$Request['Data']);
                $result->bindParam(':ID_JOB',self::$Request['Jobs']);
                $result->bindParam(':ID_ROL',self::$Request['Rol']);
                $result->bindParam(':NOMBRE_1',self::$Request['Name_first']);
                $result->bindParam(':NOMBRE_2',self::$Request['Name_last']);
                $result->bindParam(':APELLIDO_PATERNO',self::$Request['FirstName']);
                $result->bindParam(':APELLIDO_MATERNO',self::$Request['LastName']);
                $result->bindParam(':USER_IMG',self::$Request['Gender']);
                $result->execute();
                self::$Action = '3.5';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.5'):
              try{
                for($x=0; $x<count(self::$Request['Departaments']); $x++){
                  $result = self::$Connection->prepare(self::set_Query(self::$Request['Departaments'][$x][0]));
                  $result->bindParam(':ID_USUARIO',self::$Request['Data']);
                  $result->bindParam(':ID_STATUS',self::$Request['Departaments'][$x][1]);
                  $result->execute();
                }
                self::$Action = '3.6';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.6'):
              try{
                for($x=0; $x<count(self::$Request['Areas']); $x++){
                  $result = self::$Connection->prepare(self::set_Query(self::$Request['Areas'][$x][0],self::$Request['Areas'][$x][1]));
                  $result->bindParam(':ID_USUARIO',self::$Request['Data']);
                  $result->bindParam(':ID_STATUS',self::$Request['Areas'][$x][2]);
                  $result->execute();
                }
                self::$Action = '3.7';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('3.7'):
              try{
                for($x=0; $x<count(self::$Request['Modules']); $x++){
                  $result = self::$Connection->prepare(self::set_Query(self::$Request['Modules'][$x][0],self::$Request['Modules'][$x][1],self::$Request['Modules'][$x][2]));
                  $result->bindParam(':ID_USUARIO',self::$Request['Data']);
                  $result->bindParam(':ID_STATUS',self::$Request['Modules'][$x][3]);
                  $result->execute();
                }
                self::$Response['Data']=true;
                self::closeConnection();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('4'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['user_name']==self::$Request['Username']){
                    self::$Response['Data'] = 1;
                    break;
                  }
                  else{
                    self::$Response['Data'] = 0;
                  }
                }
                self::closeConnection();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
          }
        break;
      }
    } 
    public static function Initialize( $Input ){
      self::$Connection   =   Database_MYSQL::Connect();
      self::$Request      =   $Input;   
      self::$Url          =   self::$Request['url'];
      self::$Action       =   self::$Request['action'];
      self::get_Response();
      return self::$Response;
    }
    private static function closeConnection(){
      Database_SQLSERVER::Disconnect();
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>
