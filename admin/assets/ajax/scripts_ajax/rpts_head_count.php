<?php
include("../config/database.php");
include("../include/head_count.php");
   
set_time_limit(1200);
   
   $chk_empresas = $_POST["chk_empresas"];
   
   $mes            = $_POST["cbx_mes"];
   $anio           = $_POST["cbx_anio"];   
   $depto          = $_POST["depto"];
   
   $condicion_bd   = $_POST["condicion_bd"];
   
   
   
   
   /*******************************************************************************************/
   //Traer los headcounts de todas las empresas seleccionadas
   //$conexion  = conectar_compaq();
   
   $obj1 = new Database();
   $obj1->set_connection("Esprezzaserver3\Compac2008", "nomGenerales");
   $conn1 = $obj1->get_connection();
   
   
   $bds_seleccionadas = condicion_seleccionadas($chk_empresas);
   $arr_datos = trae_datos_hc($conn1, $bds_seleccionadas); //arreglo con los nombres de las bds del server
   
  // echo $arr_datos;
   //exit;
   
   //$tabla     = muestra_tabla_head_counts($conexion, $mes, $anio, $arr_datos, $depto);
   $tabla     = muestra_tabla_head_counts($conn1, $mes, $anio, $arr_datos, $depto);   
   echo "1@@@".$tabla;
   
   
   /*******************************************************************************************/
  
?>  