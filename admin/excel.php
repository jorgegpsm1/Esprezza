<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=pasivos_nomina.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $_POST["datos_a_enviar"];
?>
 
