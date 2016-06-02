<?php
require_once('database.php');
error_reporting(E_ALL);
$obj = Database::Connect();
$query  = "SELECT * FROM Cuentas";
$result_1 = $obj->prepare($query);
$result_1->execute();
while($row = $result_1->fetch(PDO::FETCH_ASSOC)){
	echo "<pre>";
	var_dump($row);
	echo "</pre>";
}

?>