<?php namespace Admin\Model\Clase;

  foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
      require_once (  $Filename );
  }

  use Admin\Model\Config\Database_sqlserver as Database_SQLSERVER;
  use Admin\Model\Config\Database_mysql as Database_MYSQL;
  use \PDO;

  class Catalogo{
    private static $Request;
    private static $Response;
    private static $Connection;
    private static $Url;
    private static $Action;

    public function __construct( ){
      die('No se instancian objetos');
    }
    private static function set_Query( $KEY_1 = 0 ){
      switch (self::$Url){
        case ('1.4.1'):
          switch (self::$Action){
            case ('1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id");
            break;
            case ('1.1'):
              return  ("SELECT TOP 1 equipo_id FROM equipos ORDER BY equipo_id DESC");
            break;
            case ('2'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM proyectos)  THEN '1'  ELSE '0'  END proyecto_id");
            break;
            case ('2.1'):
              return  ("SELECT proyecto_id, nombreProyecto FROM proyectos");
            break;
            case ('2.2'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos WHERE proyecto_id = :ID_PROYECTO)  THEN '1'  ELSE '0'  END proyecto_id");
            break;
            case ('3'):
              return  ("SELECT COUNT(user_id) AS user_id FROM users");
            break;
            case ('3.1'):
              return  ("SELECT user_id, user_name, user_status FROM users");
            break;
            case ('3.2'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos WHERE usuario_id = :ID_USUARIO)  THEN '1'  ELSE '0'  END usuario_id");
            break;
            case ('4'):
              return  ("INSERT INTO equipos (proyecto_id, usuario_id) VALUES (:PROYECTO_ID , :USUARIO_ID)");
            break;
            case ('5'):
              return ("SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id" );
            break;
            case ('5.1'):
              return ("SELECT equipo_id, proyecto_id, usuario_id FROM equipos ORDER BY equipo_id ASC");
            break;
            case ('5.2'):
              return ("SELECT nombreProyecto FROM proyectos WHERE proyecto_id = :ID_PROYECTO");
            break;
            case ('5.3'):
              return ("SELECT user_name FROM users WHERE user_id = :ID_USUARIO");
            break;
          }
        break;
        case ('1.4.2'):
          switch (self::$Action){
            case ('1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM proyectos)  THEN '1'  ELSE '0'  END proyecto_id");
            break;
            case ('1.1'):
              return  ("SELECT TOP 1 proyecto_id FROM proyectos ORDER BY proyecto_id DESC");
            break;
            case ('2'):
              return ( "SELECT CASE WHEN EXISTS (SELECT 1 FROM proyectos)  THEN '1'  ELSE '0'  END proyecto_id" );
            break;
            case ('2.1'):
              return ( "SELECT nombreProyecto FROM proyectos" );
            break;
            case ('3'):
              return ( "INSERT INTO proyectos (nombreProyecto) VALUES (:COLOR)" );
            break;
            case ('4'):
              return ("SELECT CASE WHEN EXISTS (SELECT 1 FROM proyectos)  THEN '1'  ELSE '0'  END proyecto_id" );
            break;
            case ('4.1'):
              return ("SELECT proyecto_id, nombreProyecto FROM proyectos ORDER BY proyecto_id ASC");
            break;
          }
        break;
        case ('1.4.3'):
          switch (self::$Action){
            case ('1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM noministas)  THEN '1'  ELSE '0'  END nominista_id");
            break;
            case ('1.1'):
              return  ("SELECT TOP 1 nominista_id FROM noministas ORDER BY nominista_id DESC");
            break;
            case ('2'):
              return ( "SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id" );
            break;
            case ('2.1'):
              return ( "SELECT equipo_id, proyecto_id FROM equipos" );
            break;
            case ('2.2'):
              return ( "SELECT nombreProyecto FROM proyectos WHERE proyecto_id = :ID_PROYECTO" );
            break;
            case ('3'):
              return ( "SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id" );
            break;
            case ('3.1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM noministas)  THEN '1'  ELSE '0'  END nominista_id");
            break;
            case ('3.2'):
              return ( "SELECT usuario_id FROM equipos" );
            break;
            case ('3.3'):
              return ( "SELECT usuario_id FROM noministas" );
            break;
            case ('3.4'):
              return ( "SELECT user_id, user_name FROM users ORDER BY user_id ASC" );
            break;
            case ('4'):
              return  ("INSERT INTO noministas (equipo_id, usuario_id) VALUES (:ID_EQUIPO , :ID_USUARIO)");
            break;
            case ('5'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM noministas)  THEN '1'  ELSE '0'  END nominista_id");
            break;
            case ('5.1'):
              return  ("SELECT nominista_id, equipo_id, usuario_id FROM noministas");
            break;
            case ('5.2'):
              return ("SELECT proyecto_id FROM equipos WHERE equipo_id = :ID_EQUIPO");
            break;
            case ('5.3'):
              return ("SELECT nombreProyecto FROM proyectos WHERE proyecto_id = :ID_PROYECTO");
            break;
            case ('5.4'):
              return ("SELECT user_firstname, user_first_name  FROM users_info WHERE user_id = :ID_USUARIO");
            break;
          }
        break;
        case ('1.4.4'):
          switch (self::$Action){
            case ('1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM atc)  THEN '1'  ELSE '0'  END atc_id");
            break;
            case ('1.1'):
              return  ("SELECT TOP 1 atc_id FROM atc ORDER BY atc_id DESC");
            break;
            case ('2'):
              return ( "SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id" );
            break;
            case ('2.1'):
              return ( "SELECT equipo_id, proyecto_id FROM equipos" );
            break;
            case ('2.2'):
              return ( "SELECT nombreProyecto FROM proyectos WHERE proyecto_id = :ID_PROYECTO" );
            break;
            case ('3'):
              return ( "SELECT CASE WHEN EXISTS (SELECT 1 FROM equipos)  THEN '1'  ELSE '0'  END equipo_id" );
            break;
            case ('3.1'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM atc)  THEN '1'  ELSE '0'  END atc_id");
            break;
            case ('3.2'):
              return ( "SELECT usuario_id FROM equipos" );
            break;
            case ('3.3'):
              return ( "SELECT usuario_id FROM atc" );
            break;
            case ('3.4'):
              return ( "SELECT user_id, user_name FROM users ORDER BY user_id ASC" );
            break;
            case ('4'):
              return  ("INSERT INTO atc (equipo_id, usuario_id) VALUES (:ID_EQUIPO , :ID_USUARIO)");
            break;
            case ('5'):
              return  ("SELECT CASE WHEN EXISTS (SELECT 1 FROM atc)  THEN '1'  ELSE '0'  END atc_id");
            break;
            case ('5.1'):
              return  ("SELECT atc_id, equipo_id, usuario_id FROM atc");
            break;
            case ('5.2'):
              return ("SELECT proyecto_id FROM equipos WHERE equipo_id = :ID_EQUIPO");
            break;
            case ('5.3'):
              return ("SELECT nombreProyecto FROM proyectos WHERE proyecto_id = :ID_PROYECTO");
            break;
            case ('5.4'):
              return ("SELECT user_firstname, user_first_name  FROM users_info WHERE user_id = :ID_USUARIO");
            break;
          }
        break;
      }
    }
    private static function get_Response(){
      switch (self::$Url){
        case ('1.4.1'):
          switch (self::$Action){
            case ('1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                self::$Action = '1.1';
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
            case ('1.1'):
              try{
                if(self::$Response['Data']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    self::$Response['Data']=$row['equipo_id'];
                  }
                  self::$Response['Data']++;
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
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['proyecto_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                $result->closeCursor();
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
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'],array($row['proyecto_id'],$row['nombreProyecto']));
                  }
                }

                self::$Action = '2.2';
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
            case ('2.2'):
              try{
                if(self::$Response['Data']){
                  $Temp = array();
                  for($x=0; $x<count(self::$Response['Data']); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][$x][0]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      if($row['proyecto_id'] == 1){
                        array_push($Temp,array($x));
                      }
                    }
                  }
                  if(!empty($Temp)){
                    if(count($Temp) == count(self::$Response['Data'])){
                      self::$Response['Data']=array();
                    }
                    else{
                      $Counter = count($Temp) - 1;
                      for($x=0, $y=0; $x<=$Counter; $x++, $y++){
                        if($x==0){
                          array_splice(self::$Response['Data'],$Temp[$x][0],1);
                        }
                        else{
                          array_splice(self::$Response['Data'],$Temp[$x][0]-($y),1);
                        }
                      }
                    }
                  }
                  self::$Response['Data'] = (empty(self::$Response['Data'])) ? 0 : self::$Response['Data'];
                }
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
                self::$Connection   =   Database_MYSQL::Connect();
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['user_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                $result->closeCursor();
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
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    if($row['user_status'] == 1){
                      array_push(self::$Response['Data'],array($row['user_id'],$row['user_name']));
                    }
                  }
                }
                self::$Action = '3.2';
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
            case ('3.2'):
              try{
                if(self::$Response['Data']){
                  self::$Connection   =   Database_SQLSERVER::Connect();
                  $Temp = array();
                  for($x=0; $x<count(self::$Response['Data']); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_USUARIO',self::$Response['Data'][$x][0]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      if($row['usuario_id'] == 1){
                        array_push($Temp,array($x));
                      }
                    }
                  }
                  if(!empty($Temp)){
                    if(count($Temp) == count(self::$Response['Data'])){
                      self::$Response['Data']=array();
                    }
                    else{
                      $Counter = count($Temp) - 1;
                      for($x=0, $y=0; $x<=$Counter; $x++, $y++){
                        if($x==0){
                          array_splice(self::$Response['Data'],$Temp[$x][0],1);
                        }
                        else{
                          array_splice(self::$Response['Data'],$Temp[$x][0]-($y),1);
                        }
                      }
                    }
                  }
                  self::$Response['Data'] = (empty(self::$Response['Data'])) ? 0 : self::$Response['Data'];
                }
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
                $result->bindParam(':PROYECTO_ID',self::$Request['ProyectID']);
                $result->bindParam(':USUARIO_ID',self::$Request['UserID']);
                $result->execute();
                self::$Response['Status'] = true;
                self::closeConnection();
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
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                self::$Action = '5.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.1'):
              try{
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['equipo_id'],$row['proyecto_id'],$row['usuario_id']));
                  }
                }
                self::$Action = '5.2';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.2'):
              try{
                if(self::$Response['Data']){
                  self::$Response['Data'][1]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $Size = count(self::$Response['Data'][0]);
                  for($x=0; $x<$Size; $x++){
                    self::$Response['Data'][1][$x]=array();
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][0][$x][1]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1][$x],$row['nombreProyecto']);
                    }
                  }
                }
                self::$Action = '5.3';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.3'):
              try{
                if(self::$Response['Data']){
                  self::$Connection   =   Database_MYSQL::Connect();
                  self::$Response['Data'][2]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $Size = count(self::$Response['Data'][0]);
                  for($x=0; $x<$Size; $x++){
                    self::$Response['Data'][2][$x]=array();
                    $result->bindParam(':ID_USUARIO',self::$Response['Data'][0][$x][2]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][2][$x],$row['user_name']);
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
          }
        break;
        case ('1.4.2'):
          switch (self::$Action){
            case ('1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['proyecto_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }

                $result->closeCursor();
                self::$Action = '1.1';
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
            case ('1.1'):
              try{
                if(self::$Response['Data']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    self::$Response['Data']=$row['proyecto_id'];
                  }
                  self::$Response['Data']++;
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
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['proyecto_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }

                $result->closeCursor();
                self::$Action = '2.1';
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
            case ('2.1'):
              try{
                if(self::$Response['Data']){
                  self::$Response['NameProyect'] = array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['NameProyect'], $row['nombreProyecto']);
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
            case ('3'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->bindParam(':COLOR',self::$Request['ColorSelection']);
                $result->execute();
                self::$Response['Status'] = true;
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
                  if($row['proyecto_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }

                $result->closeCursor();
                self::$Action = '4.1';
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
            case ('4.1'):
              try{
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'],array($row['proyecto_id'],$row['nombreProyecto']));
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
        break;
        case ('1.4.3'):
          switch (self::$Action){
            case ('1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['nominista_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                self::$Action = '1.1';
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
            case ('1.1'):
              try{
                if(self::$Response['Data']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    self::$Response['Data']=$row['nominista_id'];
                  }
                  self::$Response['Data']++;
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
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
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
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['equipo_id'],$row['proyecto_id']));
                  }
                }
                self::$Action = '2.2';
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
            case ('2.2'):
              try{
                if(self::$Response['Data']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    self::$Response['Data'][1][$x]=array();
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][0][$x][1]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1][$x],$row['nombreProyecto']);
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
            case ('3'):
              try{
                self::$Response['Data']=array();
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['equipo'] = 0;
                  }
                  else{
                    self::$Response['equipo'] = 1;
                    self::$Response['Data'][0]=array();
                  }
                }
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
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['nominista_id']==0){
                    self::$Response['nominista'] = 0;
                  }
                  else{
                    self::$Response['nominista'] = 1;
                    self::$Response['Data'][1]=array();
                  }
                }
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
                if(self::$Response['equipo']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['usuario_id']));
                  }
                }
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
                if(self::$Response['nominista']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][1],array($row['usuario_id']));
                  }
                }
                self::$Action = '3.4';
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
            case ('3.4'):
              try{
                if(isset(self::$Response['nominista']) || isset(self::$Response['equipo'])){
                  self::$Connection   =   Database_MYSQL::Connect();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  self::$Response['Data'][2]=array();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][2],array($row['user_id'],$row['user_name']));
                  }

                  $Equipo    = (self::$Response['equipo']) == 1 ? count(self::$Response['Data'][0]) : 0;
                  $Nominista = (self::$Response['nominista']) == 1 ? count(self::$Response['Data'][1]) : 0;


                  if(count(self::$Response['Data'][2]) == ($Equipo) + ($Nominista) ){
                    self::$Response['Data']=array();
                  }
                  else{
                    if(self::$Response['equipo']==1){
                      for($x=0; $x<count(self::$Response['Data'][2]); $x++){
                        for($y=0; $y<count(self::$Response['Data'][0]); $y++){
                          if(self::$Response['Data'][2][$x][0]==self::$Response['Data'][0][$y][0]){
                            array_splice(self::$Response['Data'][2],($x),1);
                          }
                        }
                      }
                    }
                    if(self::$Response['nominista']==1){
                      for($x=0, $a=0; $x<count(self::$Response['Data'][2]); $x++){
                        for($y=0; $y<count(self::$Response['Data'][1]); $y++){
                          if(self::$Response['Data'][2][$x][0]==self::$Response['Data'][1][$y][0]){
                            array_splice(self::$Response['Data'][2],($x),1);
                          }
                        }
                      }
                    }
                  }
                  self::$Response['Data'] = (empty(self::$Response['Data'])) ? 0 : self::$Response['Data'][2];
                }
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
                $result->bindParam(':ID_EQUIPO',self::$Request['TeamID']);
                $result->bindParam(':ID_USUARIO',self::$Request['UserID']);
                $result->execute();
                self::$Response['Status'] = true;
                self::closeConnection();
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
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['nominista_id']==0){
                    self::$Response['Nominista'] = 0;
                  }
                  else{
                    self::$Response['Nominista'] = 1;
                    self::$Response['Data']=array();
                  }
                }
                self::$Action = '5.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.1'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['nominista_id'],$row['equipo_id'],$row['usuario_id']));
                  }
                }
                self::$Action = '5.2';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.2'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_EQUIPO',self::$Response['Data'][0][$x][1]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1],array($row['proyecto_id']));
                    }
                  }
                }
                self::$Action = '5.3';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.3'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][2]=array();
                  for($x=0; $x<count(self::$Response['Data'][1]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][1][$x][0]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][2],array($row['nombreProyecto']));
                    }
                  }
                }
                self::$Action = '5.4';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.4'):
              try{
                if(self::$Response['Nominista']){
                  self::$Connection   =   Database_MYSQL::Connect();
                  self::$Response['Data'][3]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_USUARIO',self::$Response['Data'][0][$x][2]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][3],array($row['user_name']." ".$row['user_first_name']));
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
          }
        break;
        case ('1.4.4'):
          switch (self::$Action){
            case ('1'):
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['atc_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
                  }
                }
                self::$Action = '1.1';
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
            case ('1.1'):
              try{
                if(self::$Response['Data']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    self::$Response['Data']=$row['atc_id'];
                  }
                  self::$Response['Data']++;
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
              try{
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['Data'] = 0;
                  }
                  else{
                    self::$Response['Data'] = 1;
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
                if(self::$Response['Data']){
                  self::$Response['Data']=array();
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['equipo_id'],$row['proyecto_id']));
                  }
                }
                self::$Action = '2.2';
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
            case ('2.2'):
              try{
                if(self::$Response['Data']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    self::$Response['Data'][1][$x]=array();
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][0][$x][1]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1][$x],$row['nombreProyecto']);
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
            case ('3'):
              try{
                self::$Response['Data']=array();
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['equipo_id']==0){
                    self::$Response['equipo'] = 0;
                  }
                  else{
                    self::$Response['equipo'] = 1;
                    self::$Response['Data'][0]=array();
                  }
                }
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
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['atc_id']==0){
                    self::$Response['nominista'] = 0;
                  }
                  else{
                    self::$Response['nominista'] = 1;
                    self::$Response['Data'][1]=array();
                  }
                }
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
                if(self::$Response['equipo']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['usuario_id']));
                  }
                }
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
                if(self::$Response['nominista']){
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][1],array($row['usuario_id']));
                  }
                }
                self::$Action = '3.4';
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
            case ('3.4'):
              try{
                if(isset(self::$Response['nominista']) || isset(self::$Response['equipo'])){
                  self::$Connection   =   Database_MYSQL::Connect();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  self::$Response['Data'][2]=array();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][2],array($row['user_id'],$row['user_name']));
                  }

                  $Equipo    = (self::$Response['equipo']) == 1 ? count(self::$Response['Data'][0]) : 0;
                  $Nominista = (self::$Response['nominista']) == 1 ? count(self::$Response['Data'][1]) : 0;


                  if(count(self::$Response['Data'][2]) == ($Equipo) + ($Nominista) ){
                    self::$Response['Data']=array();
                  }
                  else{
                    if(self::$Response['equipo']==1){
                      for($x=0; $x<count(self::$Response['Data'][2]); $x++){
                        for($y=0; $y<count(self::$Response['Data'][0]); $y++){
                          if(self::$Response['Data'][2][$x][0]==self::$Response['Data'][0][$y][0]){
                            array_splice(self::$Response['Data'][2],($x),1);
                          }
                        }
                      }
                    }
                    if(self::$Response['nominista']==1){
                      for($x=0, $a=0; $x<count(self::$Response['Data'][2]); $x++){
                        for($y=0; $y<count(self::$Response['Data'][1]); $y++){
                          if(self::$Response['Data'][2][$x][0]==self::$Response['Data'][1][$y][0]){
                            array_splice(self::$Response['Data'][2],($x),1);
                          }
                        }
                      }
                    }
                  }
                  self::$Response['Data'] = (empty(self::$Response['Data'])) ? 0 : self::$Response['Data'][2];
                }
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
                $result->bindParam(':ID_EQUIPO',self::$Request['TeamID']);
                $result->bindParam(':ID_USUARIO',self::$Request['UserID']);
                $result->execute();
                self::$Response['Status'] = true;
                self::closeConnection();
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
                $result = self::$Connection->prepare(self::set_Query());
                $result->execute();
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
                  if($row['atc_id']==0){
                    self::$Response['Nominista'] = 0;
                  }
                  else{
                    self::$Response['Nominista'] = 1;
                    self::$Response['Data']=array();
                  }
                }
                self::$Action = '5.1';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.1'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][0]=array();
                  $result = self::$Connection->prepare(self::set_Query());
                  $result->execute();
                  while($row = $result->fetch(PDO::FETCH_ASSOC)){
                    array_push(self::$Response['Data'][0],array($row['atc_id'],$row['equipo_id'],$row['usuario_id']));
                  }
                }
                self::$Action = '5.2';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.2'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][1]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_EQUIPO',self::$Response['Data'][0][$x][1]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][1],array($row['proyecto_id']));
                    }
                  }
                }
                self::$Action = '5.3';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.3'):
              try{
                if(self::$Response['Nominista']){
                  self::$Response['Data'][2]=array();
                  for($x=0; $x<count(self::$Response['Data'][1]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_PROYECTO',self::$Response['Data'][1][$x][0]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][2],array($row['nombreProyecto']));
                    }
                  }
                }
                self::$Action = '5.4';
                self::get_Response();
              }
              catch(PDOException $e){
                echo "DataBase Error: The user could not be added.<br>".$e->getMessage();
              }
              catch(Exception $e){
                echo "General Error: The user could not be added.<br>".$e->getMessage();
              }
            break;
            case ('5.4'):
              try{
                if(self::$Response['Nominista']){
                  self::$Connection   =   Database_MYSQL::Connect();
                  self::$Response['Data'][3]=array();
                  for($x=0; $x<count(self::$Response['Data'][0]); $x++){
                    $result = self::$Connection->prepare(self::set_Query());
                    $result->bindParam(':ID_USUARIO',self::$Response['Data'][0][$x][2]);
                    $result->execute();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                      array_push(self::$Response['Data'][3],array($row['user_firstname']." ".$row['user_first_name']));
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
          }
        break;
      }
    } 
    public static function Initialize( $Input ){
      self::$Connection   =   Database_SQLSERVER::Connect();
      self::$Request      =   $Input;   
      self::$Url          =   self::$Request['url'];
      self::$Action       =   self::$Request['action'];
      self::get_Response();
      return self::$Response;
    }
    private static function closeConnection(){
      //Database_SQLSERVER::Disconnect();
      self::$Connection = null;
    }
    public function __destruct(){
      die('No se instancian objetos');
    }
  }
?>
