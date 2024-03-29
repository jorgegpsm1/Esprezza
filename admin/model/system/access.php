<?php namespace Admin\Model\System;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\Config\Database_a as Database_System;
  use \PDO;

  class Access{
    private $Request;
    private $Response;
    private $Connection;
    private $Action;

    public function __construct($Input){
      $this->Connection   = Database_System::Connect();
      $this->set_Request($Input);
    }
    private function set_Query($KEY_1 = 0, $KEY_2 = 0, $KEY_3 = 0){
      switch($this->Action){
        case '0':
          return ("SELECT department_id, department_name, department_status FROM departments");
        break;
        case '0.1':
          return ("SELECT user_status FROM department_user_{$KEY_1} WHERE user_id = :USER_ID");
        break;
        case '0.2':
          return ("SELECT area_id, area_name, area_status FROM area_{$KEY_1}");
        break;
        case '0.3':
          return ("SELECT user_status FROM area_user_{$KEY_1}_{$KEY_2} WHERE user_id = :USER_ID");
        break;
        case '0.4':
          return ("SELECT module_id, module_name, module_status FROM module_{$KEY_1}_{$KEY_2}");
        break;
        case '0.5':
          return ("SELECT user_status FROM module_access_{$KEY_1}_{$KEY_2}_{$KEY_3} WHERE user_id = :USER_ID");
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
                if($row['department_status'] == 1){
                  $this->Response['DEPARTMENT']['TEMP'] = array();
                  array_push($this->Response['DEPARTMENT']['TEMP'],$row['department_id'],$row['department_name']);
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
                  if($row['user_status'] == 1){
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
                  $this->Response['DEPARTMENT']['TEMP'] = array();
                  $z=0;
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    if($row['area_status'] == 1){
                      $this->Response['DEPARTMENT']['TEMP'][$z] = array();
                      array_push($this->Response['DEPARTMENT']['TEMP'][$z],$row['area_id'],$row['area_name']);
                      $z++;
                    }
                  }
                  if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                    $this->Response['DEPARTMENT']['AREA_ACCESS'][$y]=$this->Response['DEPARTMENT']['TEMP'];
                    unset($this->Response['DEPARTMENT']['TEMP']);
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
                  for($x=0, $a=0; $x<$DEPARTMENT_USER_ACCESS; $x++){
                    $this->Response['DEPARTMENT']['TEMP'] = array();
                    $this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$a]=array();
                    for($y=0, $b=0; $y<count($this->Response['DEPARTMENT']['AREA_ACCESS'][$x]); $y++){
                      $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x][0],$this->Response['DEPARTMENT']['AREA_ACCESS'][$x][$y][0])); 
                      $result->bindParam(':USER_ID',$_SESSION['ID']);         
                      $result->execute();
                      while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        if($row['user_status'] == 1){
                          $this->Response['DEPARTMENT']['TEMP'][$b] = array();
                          $this->Response['DEPARTMENT']['TEMP'][$b] = $this->Response['DEPARTMENT']['AREA_ACCESS'][$x][$y];
                          $b++;
                        }
                      }
                    }
                    if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                      $this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$a]=$this->Response['DEPARTMENT']['TEMP'];
                      unset($this->Response['DEPARTMENT']['TEMP']);
                    }
                    if(empty($this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$a])){
                      unset($this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$a]);
                    }
                    else{
                      $a++;
                    }
                  }
                  $result->closeCursor();  
                  $this->Action = '0.4';
                  try{
                    if(empty($this->Response['DEPARTMENT']['AREA_USER_ACCESS'])){
                      unset($this->Response['DEPARTMENT']);
                      throw new Exception('Error Intero');
                    }
                    $this->Response['DEPARTMENT']['MODULE_ACCESS'] = array();
                    $AREA_USER_ACCESS = count($this->Response['DEPARTMENT']['AREA_USER_ACCESS']);
                    for($x=0, $a=0; $x<$AREA_USER_ACCESS; $x++){
                      $this->Response['DEPARTMENT']['TEMP'] = array();
                      $this->Response['DEPARTMENT']['MODULE_ACCESS'][$a]=array();

                      for($y=0, $b=0; $y<count($this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$x]); $y++){
                        $this->Response['DEPARTMENT']['TEMP'][$b] = array();
                        $this->Response['DEPARTMENT']['MODULE_ACCESS'][$a][$b] = array();
                        $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x][0],$this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$x][$y][0]));
                        $result->execute();          
                        for($z=0, $c=0; $z<count($row); $z++){                       
                          while($row = $result->fetch(PDO::FETCH_ASSOC)){
                            if($row['module_status'] == 1){
                              $this->Response['DEPARTMENT']['TEMP'][$c] = array();
                              array_push($this->Response['DEPARTMENT']['TEMP'][$c],$row['module_id'],$row['module_name']);
                              $c++;
                            }
                          }
                        }
                        if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                          $this->Response['DEPARTMENT']['MODULE_ACCESS'][$a][$b]=$this->Response['DEPARTMENT']['TEMP'];
                          unset($this->Response['DEPARTMENT']['TEMP']);
                        }
                        if(empty($this->Response['DEPARTMENT']['MODULE_ACCESS'][$a][$b])){
                          unset($this->Response['DEPARTMENT']['MODULE_ACCESS'][$a][$b]);
                        }
                        else{
                          $b++;
                        }
                      }
                      if(empty($this->Response['DEPARTMENT']['MODULE_ACCESS'][$a])){
                        unset($this->Response['DEPARTMENT']['MODULE_ACCESS'][$a]);
                      }
                      else{
                        $a++;
                      }
                    }
                    $result->closeCursor();  
                    $this->Action = '0.5';
                    try{
                      if(empty($this->Response['DEPARTMENT']['MODULE_ACCESS'])){
                        unset($this->Response['DEPARTMENT']);
                        throw new Exception('Error Intero');
                      }
                      $this->Response['DEPARTMENT']['MODULE_USER_ACCESS'] = array();
                      for($x=0, $a=0; $x<count($this->Response['DEPARTMENT']['MODULE_ACCESS']); $x++){
                        for($y=0, $b=0; $y<count($this->Response['DEPARTMENT']['MODULE_ACCESS'][$x]); $y++){
                          for($z=0, $c=0; $z<count($this->Response['DEPARTMENT']['MODULE_ACCESS'][$x][$y]); $z++){
                            $result = $this->Connection->prepare($this->set_Query($this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'][$x][0],$this->Response['DEPARTMENT']['AREA_USER_ACCESS'][$x][$y][0],$this->Response['DEPARTMENT']['MODULE_ACCESS'][$x][$y][$z][0])); 
                            $result->bindParam(':USER_ID',$_SESSION['ID']);         
                            $result->execute();
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                              if($row['user_status'] == 1){
                                $this->Response['DEPARTMENT']['TEMP'][$c] = array();
                                $this->Response['DEPARTMENT']['TEMP'][$c] = $this->Response['DEPARTMENT']['MODULE_ACCESS'][$x][$y][$z];
                                $c++;
                              }
                            }
                          }
                          if(!empty($this->Response['DEPARTMENT']['TEMP'])){
                            $this->Response['DEPARTMENT']['MODULE_USER_ACCESS'][$a][$b]=$this->Response['DEPARTMENT']['TEMP'];
                            unset($this->Response['DEPARTMENT']['TEMP']);
                          }
                          if(empty($this->Response['DEPARTMENT']['MODULE_USER_ACCESS'][$a][$b])){
                            unset($this->Response['DEPARTMENT']['MODULE_USER_ACCESS'][$a][$b]);
                          }
                          else{
                            $b++;
                          }
                        }
                        if(empty($this->Response['DEPARTMENT']['MODULE_USER_ACCESS'][$a])){
                          unset($this->Response['DEPARTMENT']['MODULE_USER_ACCESS'][$a]);
                        }
                        else{
                          $a++;
                        }
                      }
                      $temp=array(); 
                      array_push($temp,$this->Response['DEPARTMENT']['DEPARTMENT_USER_ACCESS'],$this->Response['DEPARTMENT']['AREA_USER_ACCESS'],$this->Response['DEPARTMENT']['MODULE_USER_ACCESS']);
                      unset($this->Response['DEPARTMENT']);
                      $this->Response=array();
                      $this->Response=$temp;
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
      Database_System::Disconnect();
    }
  }
?>
