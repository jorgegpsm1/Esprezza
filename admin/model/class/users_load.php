<?php
   @session_start();
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php');
  class users_load{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;
    
    public function __construct($Input){
      $this->Connection    = Database::Connect();
      $this->set_Request($Input);
    }
    private function set_Query($KEY_1 = 0, $KEY_2 = 0){
      switch ($this->Action){
        case ('0'):
          /*return ("SELECT id_user AS usuario, CONCAT(user_name,' ',user_last_name) AS nombre, id_job AS puesto FROM user_info");
          return ("SELECT job_name AS puesto_nombre FROM user_job WHERE id_job = :ID_JOB_USER");*/
        break;
        case ('1'):
          return ("SELECT job_name FROM jobs");
        break;
        case ('1.1'):
          return ("SELECT COUNT(id_job) FROM jobs");
        break;
        case ('1.2'):
          return ("SELECT role_name FROM roles_{$KEY_1}");
        break;
        case ('2'):
          return ("SELECT DEPARTMENT_NAME FROM department");
        break;
        case ('2.1'):
          return ("SELECT COUNT(ID_DEPARTMENT) FROM department");
        break;
        case ('2.2'):
          return ("SELECT AREA_NAME FROM department_area_{$KEY_1}");
        break;
        case ('5'):
          return ("INSERT INTO user_access (USER_LOGIN_NAME, USER_LOGIN_PASS) VALUES (:USER_NAME, :USER_PASSWD)");
        break;
        case ('5.1'):
          return ("SELECT ID_USER FROM user_access ORDER BY ID_USER DESC LIMIT 1");
        break;
        case ('5.2'):
          return ("INSERT INTO user_session_access (ID_USER, USER_SESSIONS, USER_SESSION_PASS) VALUES (:USER_ID, :USER_SESSION, :USER_SESSION_PASSWD)");
        break;
        case ('5.3'):
          return ("create table IF NOT EXISTS user_sessions_access_{$KEY_1}(
                  id_session tinyint  NOT NULL,
                  user_key  varchar(255) NOT NULL,
                  user_date_created TIMESTAMP ,
                  user_date_current TIMESTAMP,
                  user_date_temp TIMESTAMP,
                  user_ip varchar(40) NOT NULL,
                  user_browser varchar(255) NOT NULL,
                  user_session_temp tinyint(1) NOT NULL DEFAULT 1,
                  UNIQUE (id_session)
                  )ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;");
        break;
        case ('5.4'):
          return ("INSERT INTO user_info (id_user, id_job, id_role, user_name, user_last_name, user_img) VALUES (:USER_ID, :USER_JOB, :USER_ROL, :USER_NAME, :USER_LAST_NAME, :USER_IMG)");
        break;
        case ('5.5'):
          return ("INSERT INTO department_user_access_{$KEY_1} (ID_USER, USER_DEPARTMENT_STATUS) VALUES (:USER_ID, :USER_STATUS)");
        break;
        case ('5.6'):
          return ("INSERT INTO department_area_user_access_{$KEY_1}_{$KEY_2} (ID_USER, USER_DEPARTMENT_AREA_STATUS) VALUES (:USER_ID, :USER_STATUS)");
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
      switch($this->Action){ 
        /*case ('0'):
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
          break;*/
          case ('1'):
            $this->Response['PUESTOS']   =  array();
            $this->Response['ROLES']     =  array();
            try{ 
              $result = $this->Connection->prepare($this->set_Query());
              $result->execute(); 
              while($row = $result->fetch(PDO::FETCH_NUM)){
                array_push($this->Response['PUESTOS'], $row);
              }
              $result->closeCursor();
              $this->Action = '1.1';
              try{
                $result = $this->Connection->prepare($this->set_Query());
                $result->execute(); 
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $PUESTOS = $row['COUNT(id_job)'];
                $result->closeCursor();
                $this->Action = '1.2';
                try{
                  for($x=1;$x<=$PUESTOS;$x++){
                    $this->Response['ROLES'][$x] = array();
                    $result = $this->Connection->prepare($this->set_Query($x));
                    $result->execute(); 
                    while($row = $result->fetch(PDO::FETCH_NUM)){
                      array_push($this->Response['ROLES'][$x], $row);
                    }
                  }
                  $result->closeCursor();
                }
                catch(PDOException $e){
                  echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                }
                catch(Exception $e){
                  echo "General Error: The user could not be added.<br>".$e->getMessage();
                }
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            }
          catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
          }
          catch(Exception $e){
            echo "General Error: The user could not be added.<br>".$e->getMessage();
          }
          break;

          case ('2'):
            $this->Response['DEPARTAMENTOS']    =  array();
            $this->Response['AREAS']            =  array();
            try{
              $result = $this->Connection->prepare($this->set_Query());
              $result->execute(); 
              while($row = $result->fetch(PDO::FETCH_NUM)){
                array_push($this->Response['DEPARTAMENTOS'], $row);
              }
              $result->closeCursor();
              $this->Action = '2.1';
              try{
                $result = $this->Connection->prepare($this->set_Query());
                $result->execute(); 
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $DEPARTAMENTOS = $row['COUNT(ID_DEPARTMENT)'];
                $result->closeCursor();
                $this->Action = '2.2';
                try{
                  for($x=0;$x<$DEPARTAMENTOS;$x++){
                    $this->Response['AREAS'][$x] = array();
                    $result = $this->Connection->prepare($this->set_Query($x+1));
                    $result->execute(); 
                    while($row = $result->fetch(PDO::FETCH_NUM)){
                      array_push($this->Response['AREAS'][$x], $row);
                    }
                  }
                  $result->closeCursor();
                }
                catch(PDOException $e){
                 echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                }
                catch(Exception $e){
                  echo "General Error: The user could not be added.<br>".$e->getMessage();
                }
              }
              catch(PDOException $e){
               echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            }
            catch(PDOException $e){
            echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
            }
            catch(Exception $e){
              echo "General Error: The user could not be added.<br>".$e->getMessage();
            }
          break;
          case ('5'):
            try{
              $result = $this->Connection->prepare($this->set_Query());
              $result->bindParam(':USER_NAME',$this->Request['NameUser']);
              $result->bindParam(':USER_PASSWD',$this->Request['PasswordUser']);
              $result->execute(); 
              $result->closeCursor();
              $this->Action = '5.1';
              try{
                $result = $this->Connection->prepare($this->set_Query());
                $result->execute(); 
                $fila = $result->fetch(PDO::FETCH_ASSOC);
                $result->closeCursor();
                $this->Action = '5.2';
                try{
                  $values = array(0,"123");
                  $result = $this->Connection->prepare($this->set_Query());
                  $result->bindParam(':USER_ID',$fila['ID_USER']);
                  $result->bindParam(':USER_SESSION',$values[0]);
                  $result->bindParam(':USER_SESSION_PASSWD',$values[1]);
                  $result->execute(); 
                  $result->closeCursor();
                  $this->Action = '5.3';
                  try{
                    $result = $this->Connection->prepare($this->set_Query($fila['ID_USER']));
                    $result->execute(); 
                    $result->closeCursor();
                    $this->Action = '5.4';
                    try{
                      $result = $this->Connection->prepare($this->set_Query());
                      $result->bindParam(':USER_ID',$fila['ID_USER']);
                      $result->bindParam(':USER_JOB',$this->Request['Departamento']);
                      $result->bindParam(':USER_ROL',$this->Request['Area']);
                      $result->bindParam(':USER_NAME',$this->Request['Name_first']);
                      $result->bindParam(':USER_LAST_NAME',$this->Request['first_name']);
                      $result->bindParam(':USER_IMG',$this->Request['Gener']);
                      $result->execute(); 
                      $result->closeCursor();
                      $this->Action = '5.5';
                      try{
                        for($x=0; $x<count($this->Request['DepartmentUser']); $x++){
                            $result = $this->Connection->prepare($this->set_Query($this->Request['DepartmentUser'][$x][0]));
                            $result->bindParam(':USER_ID',$fila['ID_USER']);
                            $result->bindParam(':USER_STATUS',$this->Request['DepartmentUser'][$x][1]);
                            $result->execute(); 
                            $result->closeCursor();
                        }
                        $this->Action = '5.6';
                        try{
                          for($x=0; $x<count($this->Request['AreaUser']); $x++){
                            $result = $this->Connection->prepare($this->set_Query($this->Request['AreaUser'][$x][0],$this->Request['AreaUser'][$x][1]));
                            $result->bindParam(':USER_ID',$fila['ID_USER']);
                            $result->bindParam(':USER_STATUS',$this->Request['AreaUser'][$x][2]);
                            $result->execute(); 
                            $result->closeCursor();
                          }
                        }
                        catch(PDOException $e){
                        echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                        }
                        catch(Exception $e){
                          echo "General Error: The user could not be added.<br>".$e->getMessage();
                        }
                      }
                      catch(PDOException $e){
                      echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                      }
                      catch(Exception $e){
                        echo "General Error: The user could not be added.<br>".$e->getMessage();
                      }
                    }
                    catch(PDOException $e){
                    echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                    }
                    catch(Exception $e){
                      echo "General Error: The user could not be added.<br>".$e->getMessage();
                    }
                  }
                  catch(PDOException $e){
                  echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                  }
                  catch(Exception $e){
                    echo "General Error: The user could not be added.<br>".$e->getMessage();
                  }
                }
                catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
                }
                catch(Exception $e){
                  echo "General Error: The user could not be added.<br>".$e->getMessage();
                }
              }
              catch(PDOException $e){
              echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
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

