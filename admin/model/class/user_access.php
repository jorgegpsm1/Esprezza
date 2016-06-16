<?php
  require_once($_SESSION['BASE_DIR_BACKEND'].'/model/config/database.php'); 
  class user_access{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct($Input){
      $this->Connection   = Database::Connect();
      $this->set_Request($Input);
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
        /*
        case '3':
          return ("SELECT ID_MODULE, MODULE_STATUS FROM DEPARTMENT_AREA_MODULES_{$KEY_1}_{$KEY_2}");
        break;
        case '3.1':
          return ("SELECT USER_DEPARTMENT_AREA_MODULE_ACCESS_STATUS FROM DEPARTMENT_AREA_USER_ACCESS_{$KEY_1}_{$KEY_2}_{$KEY_3} WHERE ID_USER = :USER_ID");
        break;
        */
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
        case ('0'):
          try{
            $DEPARTMENT;
            $this->Response['DEPARTMENT'] = array();
            $this->Response['DEPARTMENT']['TEMP'] = array();
            $this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'] = array();
            $result = $this->Connection->prepare($this->set_Query());
            $result->execute();
            $DEPARTMENT = 0;
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                if($row['DEPARTMENT_STATUS'] == 1){
                  $this->Response['DEPARTMENT']['TEMP'] = array();
                  array_push($this->Response['DEPARTMENT']['TEMP'],$row['ID_DEPARTMENT'],$row['DEPARTMENT_NAME']);
                }
                if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                  $this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$DEPARTMENT] = array();
                  $this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$DEPARTMENT] = $this->Response['DEPARTMENT']['TEMP'];
                  unset($this->Response['DEPARTMENT']['TEMP']);
                  $DEPARTMENT++;
                } 
            }                
            $result->closeCursor();
            $this->Action = '0.1';
            try{
              if(empty($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'])){
                unset($this->Response['DEPARTMENT']);
                throw new Exception('Departamentos no disponibles');
              } 
              $this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'] = array();
              $DEPARTMENT = 0;
              $DEPARTMENTS=count($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS']);
              for($x=0; $x<$DEPARTMENTS; $x++){
                $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x][0]));
                $result->bindParam(':USER_ID',$_SESSION['ID']);
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['USER_DEPARTMENT_STATUS'] == 1){
                    $this->Response['DEPARTMENT']['TEMP'] = array();
                    array_push($this->Response['DEPARTMENT']['TEMP'],$this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x][0],$this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x][1]);
                  }

                  if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                    $this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$DEPARTMENT] = array(); 
                    $this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$DEPARTMENT] = $this->Response['DEPARTMENT']['TEMP'];
                    unset($this->Response['DEPARTMENT']['TEMP']);
                    $DEPARTMENT++;
                  } 
                }
              }
              $result->closeCursor();  
              $this->Action = '0.2';
              try{
                if(empty($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'])){
                  unset($this->Response['DEPARTMENT']);
                  throw new Exception('Error Intero');
                }
                $this->Response['DEPARTMENT']['AREA_ACCESS'] = array();
                $DEPARTMENT_USER_ACCESS = count($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS']);
                for($x=0,$y=0,$z=0; $x<$DEPARTMENT_USER_ACCESS; $x++){
                  $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x][0]));
                  $result->execute();
                  $z=0;
                  $this->Response['DEPARTMENT']['AREA_ACCESS'][$y] = array(); 
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    if($row['AREA_STATUS'] == 1){
                      $this->Response['DEPARTMENT']['TEMP'] = array();
                      array_push($this->Response['DEPARTMENT']['TEMP'],$row['ID_AREA'],$row['AREA_NAME']);
                    }
                    if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                      $this->Response['DEPARTMENT']['AREA_ACCESS'][$y][$z] = array(); 
                      array_push($this->Response['DEPARTMENT']['AREA_ACCESS'][$y][$z],$this->Response['DEPARTMENT']['TEMP']);
                      unset($this->Response['DEPARTMENT']['TEMP']);
                      $z++;
                    }
                  }
                  if(!empty($this->Response['DEPARTMENT']['AREA_ACCESS'][$y])){
                    $y++;
                  }
                }
                $result->closeCursor();
                $this->Action = '0.3';
                try{
                  if(empty($this->Response['DEPARTMENT']['AREA_ACCESS'])){
                    unset($this->Response['DEPARTMENT']);
                    throw new Exception('Error Intero');
                  }
                  $this->Response['DEPARTMENT']['AREA_USER_ACCESS'] = array();
                  for($x=0; $x<$DEPARTMENT_USER_ACCESS; $x++){
                    for($y=0; $y<count($this->Response['DEPARTMENT']['AREA_ACCESS'][$x]); $y++){
                      for($z=0; $z<count($this->Response['DEPARTMENT']['AREA_ACCESS'][$x][$y]); $z++){

                      }
                    }                    
                    /*$result->bindParam(':USER_ID',$_SESSION['ID']);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      if($row['USER_DEPARTMENT_STATUS'] == 1){
                        $this->Response['DEPARTMENT']['TEMP'] = array();
                        array_push($this->Response['DEPARTMENT']['TEMP'],$this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x][0],$this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x][1]);
                      }

                      if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                        $this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$DEPARTMENT] = array(); 
                        $this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$DEPARTMENT] = $this->Response['DEPARTMENT']['TEMP'];
                        unset($this->Response['DEPARTMENT']['TEMP']);
                        $DEPARTMENT++;
                      } 
                    }*/
                  }
                  //return ("SELECT USER_DEPARTMENT_AREA_STATUS FROM DEPARTMENT_AREA_USER_ACCESS_{$KEY_1}_{$KEY_2} WHERE ID_USER = :USER_ID");
                  echo "<pre>";
                  print_r($this->Response);
                  echo "</pre>";
                  die("Die");
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
    /*private function set_Responses(){
      switch($this->Action){
        case '0':

          $this->Action = '1.1';
          $Count = count($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS']);
          for($x=0; $x<$Count; $x++){
            $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x]));
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              if($row['USER_DEPARTMENT_STATUS'] == 1){
                array_push($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'],$this->Response['DEPARTMENT']['DEPARTMENT_ACCESS'][$x]);
              }
            }
          }
          $result->closeCursor();
          
          $this->Action = '2';
          $this->Response['DEPARTMENT']['DEPARTMENT_AREA'] = array();
          $this->Response['DEPARTMENT']['DEPARTMENT_AREA_ACCESS'] = array();
          $this->Response['DEPARTMENT']['DEPARTMENT_AREA_USER'] = array();
          $this->Response['DEPARTMENT']['DEPARTMENT_AREA_USER_ACCESS'] = array();
          
          $Count = count($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS']);

          for($x=0; $x<$Count; $x++){
            $this->Response['DEPARTMENT']['AREA_TEMP'] = array();
            $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x]));
            $result->execute();
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
              if($row['AREA_STATUS'] == 1){
                array_push($this->Response['DEPARTMENT']['AREA_TEMP'],$row['ID_AREA']);
              }
            }
            if(!empty($this->Response['DEPARTMENT']['AREA_TEMP'])){
              array_push($this->Response['DEPARTMENT']['DEPARTMENT_AREA'],$this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x]);
              array_push($this->Response['DEPARTMENT']['DEPARTMENT_AREA_ACCESS'],$this->Response['DEPARTMENT']['AREA_TEMP']);
            }
          }
          $result->closeCursor();

          $this->Action = '2.1';
          $Count_x = count($this->Response['DEPARTMENT']['DEPARTMENT_AREA']);
          
          for($x=0; $x<$Count_x; $x++){
            $this->Response['DEPARTMENT']['AREA_TEMP'][$x] = array();
              foreach($this->Response['DEPARTMENT']['DEPARTMENT_AREA_ACCESS'][$x] as $key){
                $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_AREA'][$x],$key));
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['USER_DEPARTMENT_AREA_STATUS'] == 1){
                    array_push($this->Response['DEPARTMENT']['AREA_TEMP'][$x], $key);
                  }
                }
              }
              if(!empty($this->Response['DEPARTMENT']['AREA_TEMP'][$x])){
                  array_push($this->Response['DEPARTMENT']['DEPARTMENT_AREA_USER'],$this->Response['DEPARTMENT']['DEPARTMENT_AREA'][$x]);
                  array_push($this->Response['DEPARTMENT']['DEPARTMENT_AREA_USER_ACCESS'],$this->Response['DEPARTMENT']['AREA_TEMP'][$x]);
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
        break;
      }
    }*/
    public function __destruct(){
      Database::Disconnect();
    }
  }
?>
