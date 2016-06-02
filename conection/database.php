<?php
  class Database{
    private static $dbName = 'ct1_CONSULTORIA_DE_GUADALAJARA_SA';
    private static $dbHost = 'Esprezzaserver3\Compac2008';
    private static $dbUserName = 'sa';
    private static $dbUserPassword = 'Admin1';

    private static $count = null;

    public function __construct(){
      die('No se instancian objetos');
    }
    public static function Connect(){
      if(null == self::$count){
        try{
          self::$count = new PDO("sqlsrv:server=".self::$dbHost.";"."database=".self::$dbName,self::$dbUserName,self::$dbUserPassword);
          self::$count->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        }
        catch(PDOException $e){
          die($e->getMessage());
        }
      }
      return self::$count;
    }
    public static function Disconnect(){
      self::$count = null;
    }
  }
?>