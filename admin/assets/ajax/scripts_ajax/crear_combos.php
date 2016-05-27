<?php
include("../config/database.php");
include("../include/interfaz.php");
//$con = conectar("esprezza");

$obj = new Database();
$obj->set_connection("WIN-60ZFJDH4KL2\ITPRUEBAS", "esprezza");
$conn = $obj->get_connection();



//Combo pagadoras
$sql = "SELECT codigo, codigo + ' - ' + descripcion as valor FROM [dbo].[pagadoras]";
$cbx_pagadoras = combo_sql($conn, $sql, "cbx_pagadoras");


//Combo clientes
$sql = "SELECT codigo, codigo + ' - ' + descripcion as valor FROM [dbo].[clientes]";
$cbx_clientes = combo_sql($conn, $sql, "cbx_clientes");

	
echo $cbx_pagadoras."@@@".$cbx_clientes;    
?>  
