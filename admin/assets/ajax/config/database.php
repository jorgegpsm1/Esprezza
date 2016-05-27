<?php
class Database{
	//private $dbName = '';
	//private $dbHost = '';

	private $dbUserName = 'sa';
	private $dbUserPassword = 'Admin1';

	private $count = null;

	public function __construct(){

	}

	public function set_connection($dbHost, $dbName){

		if(null == $this->count){
			try{
				$this->count = new PDO("sqlsrv:server=".$dbHost.";"."database=".$dbName,$this->dbUserName,$this->dbUserPassword);
				$this->count->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			}
			catch(PDOException $e){
				die($e->getMessage());
			}
		}

	}

	public function get_connection(){
		return $this->count;
	}

	public function __destruct(){
		$this->count = null;
	}

}

?>