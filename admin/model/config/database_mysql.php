<?php namespace Admin\Model\Config;
use \PDO;

  class Database_mysql{
    private static $dbName = 'esprezza_erp';
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
          self::$count->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
          self::$count->exec("SET NAMES UTF8");
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