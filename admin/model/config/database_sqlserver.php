<?php namespace Admin\Model\Config;
use \PDO;

  class Database_sqlserver{
    private static $dbName = 'esprezza';
    private static $dbHost = 'URALVA';
    private static $dbUserName = 'sa';
    private static $dbUserPassword = 'uralvasm';
    private static $dbCharset = "utf-8";

    private static $count = null;

    public function __construct(){
      die('No se instancian objetos');
    }
    public static function Connect(){
      if(null == self::$count){
        try{
          self::$count = new PDO("sqlsrv:server=".self::$dbHost.";"."database=".self::$dbName,self::$dbUserName,self::$dbUserPassword);
          self::$count->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
          self::$count->setAttribute(PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_UTF8);
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