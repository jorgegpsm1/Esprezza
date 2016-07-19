<?php 
	@session_start();

      foreach ( glob( $_SESSION['BASE_DIR_BACKEND'].'/model/config/*.php' ) as $Filename){
          require_once (  $Filename );
      }

  use Admin\Model\Config\Database_mysql as Database_MYSQL;
	class user_img{
        private static $Response;
        private static $Connection;
        private static $Query;
        private static $Action;

        public function __construct(){
            die('No se instancian objetos');
        }
        private static function set_Query(){
            switch(self::$Action){
                case ('1'):
                    return ("UPDATE users_info set user_img = :USER_IMAGE WHERE user_id = :ID_USER");
                break;
                
            }
        }
        public static function get_Response(){
            self::$Response             = array();
            self::$Response['Success']  = false;

            if(self::is_Request($_GET['file'])){
                self::$Connection   = Database_MYSQL::Connect();
                self::$Action       = '1';
                self::set_Response(); 
                Database_MYSQL::Disconnect();
            }

            header('Content-Type: application/json');
            echo json_encode(self::$Response);
        }
        private static function set_Response(){
            switch(self::$Action){
                case ('1'):
                    try{
                        $uploaddir = $_SESSION['BASE_DIR_BACKEND']."/assets/img/profile_img/";
                        foreach($_FILES as $file){
                            $allowedTypes   = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
                            $detectedType   = exif_imagetype($file['tmp_name']);
                            $error          = !in_array($detectedType, $allowedTypes);
                            $type           = ($detectedType == 2) ? ".jpg" : ".png";
                            if(!$error){
                                $file['name'] = $_SESSION['ID']."_".time().$type;
                                move_uploaded_file($file['tmp_name'],$uploaddir.$file['name']);
                            }
                            else{
                                self::$Response['Success']  = false;
                                throw new Exception();
                            }
                        }
                        $result = self::$Connection->prepare(self::set_Query());
                        $result->bindParam(':ID_USER',$_SESSION['ID']);
                        $result->bindParam(':USER_IMAGE',$file['name']);
                        $result->execute();
                        self::$Response['Success']  = true;
                        self::$Response['Url']      = $file['name'];
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
        private function is_Request($Request){
            return isset($Request) ? true : false;
        }
        public function __destruct(){
            die('No se instancian objetos');
        }
	}
    user_img::get_Response();
?>