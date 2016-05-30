<?php
include("../config/database.php");
include("../include/head_count.php");

$obj = new Database();
$obj->set_connection("WIN-60ZFJDH4KL2\ITPRUEBAS", "esprezza");
$conn = $obj->get_connection();

$condicion = condicion_bds_activas($conn);

$obj2 = new Database();
$obj2->set_connection("Esprezzaserver3\Compac2008", "nomGenerales");
$conn2 = $obj2->get_connection();


$sql = "SELECT IDempresa, RutaContpaqW + ' / ' + NombreEmpresa
		       FROM [dbo].[NOM10000]".$condicion." 
		       		ORDER BY RutaContpaqW, NombreEmpresa"; //Ordenado por pagadora, empresa
$chk_clientes = tabla_checkbox_sql($conn2, $sql, "chk_empresa",2);

$opc_meses = "ENE|FEB|MAR|ABR|MAY|JUN|JUL|AGO|SEP|OCT|NOV|DIC";
$val_meses = "1|2|3|4|5|6|7|8|9|10|11|12";
$cbx_meses = combo_box($opc_meses, $val_meses, "", "", "cbx_mes");

$opc_anios = "2016|2015|2014|2013|2012|2011|2010|2009|2008|2007|2006|2005|2004|2003|2002|2001|2000";
$val_anios = "2016|2015|2014|2013|2012|2011|2010|2009|2008|2007|2006|2005|2004|2003|2002|2001|2000";
$cbx_anios = combo_box($opc_anios, $val_anios, "", "", "cbx_anio");

echo $chk_clientes."@@@".$condicion."@@@".$cbx_meses."@@@".$cbx_anios;
?>  
