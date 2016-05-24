<?php
	 $Json = file_get_contents('php://input');
   $Input = json_decode($Json,true);
   $Query  							= array();
   $Query['SQL_A']   		= "SELECT COUNT(ID_USER) as VAL FROM user_access";
   $Query['SQL_B']			=	"INSERT INTO USER_SESSIONS_ACCESS (ID_USER, USER_SESSION_PASS VALUES (:USER_ID, :USER_PASS)";
   $Input['NameUser'];
   $Input['PasswordUser'];
   $Input['DepartmentUser'];
   header('Content-Type: application/json');
   echo json_encode($Input);
?>