<?php 
	@session_start();
	require_once($_SESSION['BASE_DIR_BACKEND'].'/config/database.php'); 
	class user_img{
		private $Request;
    private $Response;
    private $Connection;
    private $Query;
    private $Action;

    public function __construct(){
    	$this->Connection = Database::Connect(); 
    }
    private function set_Query($KEY_1 = 0, $KEY_2 = 0, $KEY_3 = 0){

    }
    public function get_Response(){

    }
    private function set_Response(){

    }
    public function __destruct(){
    	Database::Disconnect();
    }
	}

?>