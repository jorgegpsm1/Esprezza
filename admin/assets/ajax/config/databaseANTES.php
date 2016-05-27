<?php

function conectar($base_datos){	
	
	if($base_datos == "esprezza"){
	  
		//SQL Server 2005 de pruebas 
		$server_name = "WIN-60ZFJDH4KL2\ITPRUEBAS";
		$user_name   = "sa";
		$password    = "Admin1";		
	}
	else{
		
		//Servidor local de SQL Server (màquina Karla)
		/*
		 $server_name = "ESP-MJ03PYJK\ITSQLEXPRESS";
		 $user_name   = "sa";
		 $password    = "Admin1";
		 */
		
		//Servidor oficial
		$server_name = "Esprezzaserver3\Compac2008";
		$user_name   = "sa";
		$password    = "Admin1";		
	}
	
	

	$con = mssql_connect($server_name, $user_name, $password);
	
	if(!$con){		
	   $mensaje = "0@@@Error en la conexión al servidor";
	   return $mensaje;
	}
	  
	$con_bd = @mssql_select_db($base_datos, $con);	
	if(!$con_bd){
	    $mensaje = "0@@@No se pudo seleccionar la base de datos ".$base_datos;
	    return $mensaje;
	}	
	
	return "1@@@".$base_datos;	
}

?>