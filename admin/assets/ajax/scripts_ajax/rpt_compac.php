<?php
include("../config/database.php");
include("../include/interfaz.php");


$obj = new Database();
$obj->set_connection("WIN-60ZFJDH4KL2\ITPRUEBAS", "esprezza");
$conn = $obj->get_connection();



$cbx_pagadoras = $_POST["cbx_pagadoras"];
$cbx_clientes  = $_POST["cbx_clientes"];





   

   
//   $conexion       = conectar("esprezza");
   $bd_seleccionar = trae_nombre_bd($conn, $cbx_pagadoras);
   
  // echo $bd_seleccionar;
   //exit;

   


  
  /* 
   $conexion       = conectar($bd_seleccionar);
   
   $tmp    = explode("@@@",$conexion);
   $exito  = $tmp[0];
   $salida = $tmp[1];  
   
   if($exito == 0){
   	  echo "0@@@".$salida;
   	  exit;
   }
   if($exito == 1)
   	  $base_datos = $salida;
   	  */
   
   $obj2 = new Database();
   $obj2->set_connection("Esprezzaserver3\Compac2008", $bd_seleccionar);
   $conn2 = $obj2->get_connection();
   
   
   $cod_cliente    = $_POST["cbx_clientes"];   
   $fecha1         = $_POST["txt_fecha1"];
   $fecha2         = $_POST["txt_fecha2"];
   
   $anio      = extrae_fecha(2,$fecha1);
   $ejercicio = trae_ejercicio($conn2, $bd_seleccionar, $anio);
   
  
   
   
   $mes_ini = extrae_fecha(0,$fecha1);
   $mes_fin = extrae_fecha(0,$fecha2);
   
   

   
      
   $num_meses_periodo = obten_num_meses_periodo($mes_ini, $mes_fin); 
   
   
  
   $fecha_ini  = transformar_fecha($fecha1);
   $fecha_fin  = transformar_fecha($fecha2);
   
   
   
   
   
   $cod_provisiones_nomina = "2190003000";
   
   if($cod_cliente == ""){    
   	  $cta_sup = $cod_provisiones_nomina."000000".$cbx_pagadoras;   	
   	  $indice = 0;
   	  $resultados = trae_subcuentas($conn2, $bd_seleccionar, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $cod_cliente, $cta_sup, $indice);
   }   
   else if($cod_cliente != ""){
   	       $cta_sup = $cod_provisiones_nomina.$cbx_clientes.$cbx_pagadoras;   	    
   	       $indice = 0;
           $resultados = trae_subcuentas($conn2, $bd_seleccionar, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $cod_cliente, $cta_sup, $indice);
   }
   
	    
   echo "1@@@".$resultados;   
?>  
