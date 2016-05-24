<?php
  class Database{
    private static $dbName = 'ume';
    private static $dbHost = 'localhost';
    private static $dbUserName = 'root';
    private static $dbUserPassword = 'uralvasm';

    private static $count = null;

    public function __construct(){
      die('No se instancian objetos');
    }
    public static function Connect(){
      if(null == self::$count){
        try{
          self::$count = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,self::$dbUserName,self::$dbUserPassword);
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