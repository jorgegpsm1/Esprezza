<?php

function inicializa_referencias(){

	for($i = 1; $i <= $_SESSION["num_quincenas"]; $i++){

		if($i < 10)
			$valor_quincena = "Q0".$i;
			else
				$valor_quincena = "Q".$i;

		$_SESSION[$valor_quincena] = 0;
	}

	for($i = 1; $i <= $_SESSION["num_catorcenas"]; $i++){

		if($i < 10)
			$valor_catorcena = "C0".$i;
			else
				$valor_catorcena = "C".$i;

		$_SESSION[$valor_catorcena] = 0;
	}

	for($i = 1; $i <= $_SESSION["num_semanas"]; $i++){

		if($i < 10)
			$valor_semana = "S0".$i;
			else
				$valor_semana = "S".$i;

		$_SESSION[$valor_semana] = 0;
	}


	for($i = 1; $i <= $_SESSION["num_meses"]; $i++){

		if($i < 10)
			$valor_mes = "M0".$i;
			else
				$valor_mes = "M".$i;

		$_SESSION[$valor_mes] = 0;
	}
}


function obten_num_periodo_pago($conn, $sql, $prefijo, $fecha_ini, $fecha_fin){
	
	/*
	Esta funciòn hace una consulta en la tabla de MovimientosPoliza
	para consultar el mayor valor de "Referencia" (Q01, Q02....Q12) 
	y asì determinar cuantas quincenas/catorcenas/semanas/meses se van a generar  
	
	$prefijo = "Q" >>> QUINCENA
	$prefijo = "C" >>> CATORCENA
	$prefijo = "S" >>> SEMANA
	$prefijo = "M" >>> MES
	*/
	
	$sql .= " AND (CAST(Fecha AS DATE) BETWEEN '".$fecha_ini."' AND '".$fecha_fin."') 
			  AND t2.Referencia LIKE '".$prefijo."%'";	
	//$res = mssql_query($sql);	
	$res = $conn->query($sql);
	$mayor = 0;
	
	//while($fila = mssql_fetch_assoc($res)) {
	while($fila = $res->fetch(PDO::FETCH_ASSOC)) {
		
		  $referencia = $fila["Referencia"];		  
		  $valor_num  = substr($referencia,1,2);		  
		  $valor      = (integer)$valor_num;
		  
		  if($valor > $mayor)
		  	 $mayor = $valor;		  
	}
	
	
		if($prefijo == "Q") $_SESSION["num_quincenas"]  = $mayor;
		if($prefijo == "C") $_SESSION["num_catorcenas"] = $mayor;
		if($prefijo == "S") $_SESSION["num_semanas"]    = $mayor;	
		if($prefijo == "M") $_SESSION["num_meses"]      = $mayor;
	
}

function trae_subcuentas($conn, $base_datos, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $cod_cliente, $cta_sup,  & $indice_arr){
	
	if($indice_arr == 0){
		$_SESSION['id_sub_cta'][$indice_arr]   = 0;
		$_SESSION['sub_cuenta'][$indice_arr++] = $cta_sup;
	}
	
	$sql = " select Id, IdCtaSup, CtaSup, IdSubCtade, SubCtade  
			          from ".$base_datos.".dbo.Asociaciones 
			          where CtaSup = '".$cta_sup."' 
			          ORDER BY SubCtade";
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//while($fila = mssql_fetch_assoc($res)){
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){
		  $_SESSION['id_sub_cta'][$indice_arr]     = $fila["IdSubCtade"];
		  $_SESSION['sub_cuenta'][$indice_arr++]   = $fila["SubCtade"];
		  trae_subcuentas($conn, $base_datos, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $cod_cliente, $fila["SubCtade"], $indice_arr);	  
	}
	
	$condicion_cuentas = "(";
	$contador = 0;
	
$arr_cuentas = array();	 
	for($i = 0; $i < $indice_arr; $i++){ 
		
		//Recorrer el arreglo con las cuentas	
		$cuenta             = $_SESSION['sub_cuenta'][$i];		
		$condicion_cuentas .= " t1.codigo = '".$cuenta."'";		
		
		if($contador < $indice_arr - 1)
			$condicion_cuentas .= " OR ";
		
			
			$arr_cuentas[$i] = $_SESSION['id_sub_cta'][$i];

		$contador++;		
    }
    $condicion_cuentas .= ")";
    
//salida_archivo("CONDICIONCUENTAS88.txt", $condicion_cuentas);

    $salida = trae_cuentas($conn, $base_datos, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $condicion_cuentas, $arr_cuentas);  
	
	return $salida;	
}

function crea_arr_cuentas($conn, $base_datos, $cod_provisiones_nomina){
	
	$indice = 0;
	$sql = "SELECT t1.id, t1.codigo, t1.nombre
			       FROM ".$base_datos.".dbo.Cuentas as t1
			       WHERE substring(t1.codigo,1,7) = '".$cod_provisiones_nomina."' and t1.CtaMayor = 2";
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//while($fila = mssql_fetch_array($res)){
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){
 		
		
		  $id             = $fila["id"];		  
		  $arr[$indice++] = $id;		
	}
	
	return $arr;	
}


function trae_cuentas($conn, $base_datos, $mes_ini, $mes_fin, $fecha_ini, $fecha_fin, $ejercicio, $num_meses_periodo, $anio, $condicion_cuentas = "", $arr_cuentas = ""){	
	
	//Consulta para mostrar TODAS las cuentas de la BD seleccionada
	
	$cod_provisiones_nomina = "2190003"; //2190003 >> PARA QUE TRAIGA LAS CUENTAS DE PROVISIONES DE NÓMINA
	
	/*
	if($cuenta == ""){
		$sql = "SELECT t1.id, t1.codigo, t1.nombre
			       FROM ".$base_datos.".dbo.Cuentas as t1
			       WHERE substring(t1.codigo,1,7) = '".$cod_provisiones_nomina."' and t1.CtaMayor = 2";
	   
	   $sql_01 = "SELECT t1.id, t1.codigo, t1.nombre, t2.Referencia
			       FROM ".$base_datos.".dbo.Cuentas as t1
			       LEFT JOIN ".$base_datos.".dbo.MovimientosPoliza as t2
	               ON t1.id = t2.IdCuenta		
			       WHERE substring(t1.codigo,1,7) = '".$cod_provisiones_nomina."' and t1.CtaMayor = 2";
	   
	   //Traer cuentas de la cuenta mayor
	   $arr_cuentas = crea_arr_cuentas($conn, $base_datos, $cod_provisiones_nomina);
	}
	*/
	
	//Consulta para mostrar una(s) subcuenta(s) en específico 
	if($condicion_cuentas != ""){		
		$sql = "SELECT t1.id, t1.codigo, t1.nombre
			       FROM ".$base_datos.".dbo.Cuentas as t1
			       WHERE ".$condicion_cuentas."
			       		 and t1.CtaMayor = 2";
		
		$sql_01 = "SELECT t1.id, t1.codigo, t1.nombre, t2.Referencia
			       FROM ".$base_datos.".dbo.Cuentas as t1
			       LEFT JOIN ".$base_datos.".dbo.MovimientosPoliza as t2
			       ON t1.id = t2.IdCuenta
			       WHERE ".$condicion_cuentas."
			       		 and t1.CtaMayor = 2";		
	}
	
	
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$num_filas = mssql_num_rows($res);
	$num_filas = $res->rowCount();  
	
	//salida_archivo("SQLS.txt", $sql." , ".$sql_01." /// ".$num_filas);	
	
	if($num_filas == 0)
		return tabla_sin_registros();	
	
	obten_num_periodo_pago($conn, $sql_01, "Q", $fecha_ini, $fecha_fin);
	obten_num_periodo_pago($conn, $sql_01, "C", $fecha_ini, $fecha_fin);
	obten_num_periodo_pago($conn, $sql_01, "S", $fecha_ini, $fecha_fin);	
    obten_num_periodo_pago($conn, $sql_01, "M", $fecha_ini, $fecha_fin);
    
    
    inicializa_referencias();    
	
	$total_columnas =  8 + $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"];
	
	$bandera=0;
	$filas = "";
	$cuenta_filas = 1;

	//while($fila = mssql_fetch_assoc($res)){
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){
		
		 $id_cuenta = $fila['id'];
		 
		 
		 $saldo_inicial = trae_saldo_inicial_cta($conn, $base_datos, $id_cuenta, $ejercicio, $mes_ini, $mes_fin);		 
		 $clase = "";
		 	
		 if($saldo_inicial < 0)
		 	$clase = "rojo";
		 
		 //Checar que la cuenta tenga movimientos
		 //if(cuenta_tiene_movimientos_poliza($base_datos, $id_cuenta, $anio) > 0){
		 	
		 	$bandera=1;
		 	/*
		 	 MOSTRAR SOLO LAS CUENTAS QUE TENGAN MOVIMIENTOS POLIZA
		 	 * */	
		 	
		 	//$codigo = "'".$fila['codigo'];
		 	$codigo = "'".formatear_cuenta($fila['codigo']);
		 	
		    $filas .= "<tr>
				      		<td><strong>".$codigo."</strong></td>
				      		<td><strong>".$fila['nombre']."</strong></td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td>Saldo inicial:</td>		
				      		<td class='".$clase."'><strong>".number_format($saldo_inicial,2)."</strong></td>		
				      		".generar_columnas_encabezado(1,"QUINCENAL",$num_meses_periodo)."
				      		".generar_columnas_encabezado(2,"CATORCENAL",$num_meses_periodo)."
				      		".generar_columnas_encabezado(3,"SEMANAL",$num_meses_periodo)."	
				      		".generar_columnas_encabezado(4,"MENSUAL",$num_meses_periodo)."			
				   		</tr>";			
		
		     //Traer los detalles de la cuenta, MovimientosPoliza     
		     $filas .= trae_movimientos_poliza($conn, $base_datos, $id_cuenta, $fecha_ini, $fecha_fin, $num_meses_periodo, $saldo_inicial, $arr_cuentas);		  
		  
		     $filas .= mostrar_encabezados_cuentas($num_meses_periodo);
		     
		     //$iteracion++;
		 //}
		 
		 /*    
		 else if(trae_saldo_inicial_cta($base_datos, $id_cuenta, $ejercicio, $mes_ini, $mes_fin) > 0){
		 	
		 	$bandera=1;//MOSTRAR LA CUENTA CON SU SALDO INICIAL, AUNQUE NO TENGA MOVIMIENTOS POLIZA
		 	
		 	
		    $codigo = "'".$fila['codigo']; 	
		    $filas .= "<tr>
				      		<td><strong>".$codigo."</strong></td>
				      		<td><strong>".$fila['nombre']."</strong></td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td>&nbsp;</td>
				      		<td class='".$clase."'>Saldo inicial:</td>
				      		<td><strong>".number_format($saldo_inicial,2)."</strong></td>
				   		</tr>";		 	
		 }*/
		 
		 $cuenta_filas++;
		 
	  }//while	  
	  
	  if($bandera==1){ /*La(s) cuenta(s) tiene(n) movimientos y/o saldo inicial*/
	  	$tabla = "<table border='1' width='100%' id='Exportar_a_Excel'>";
	  	$tabla .= "<tr>
				  <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>";
	  	
	  	$tabla .= "<tr>
				  <td colspan='".$total_columnas."' align='left' class='encabezado_rpt'>
			          Corte del ".formato_fecha($fecha_ini)." al ".formato_fecha($fecha_fin)."
			      </td>
			   </tr>";
	  	
	  	$tabla .= "<tr>
				  <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>";
	  	
	  	$tabla .= "<tr class='encabezado_rpt'>
				      <td>Fecha</td>
				      <td>Tipo</td>
			          <td>Número</td>
			          <td>Concepto</td>
			          <td>Referencia</td>
			          <td>Cargos</td>
			          <td>Abonos</td>
			          <td>Saldo</td>
			   </tr>";
	  	 $tabla .= $filas;	  	 
	  }
	  if($bandera==0){ /*La(s) cuenta(s) NO tiene(n) movimientos NI saldo inicial*/
	  	 return tabla_sin_registros();
	  }
	   
	  
	  
	
	//Traer los totales finales
	$tabla .= trae_totales();	

	$tabla .= "</table>";	
	return $tabla;	
}

function tabla_sin_registros(){
	
    return "<table align='center' width='100%'>
				    <tr> 
				      <td align='center'><h3>NO SE ENCONTRARON REGISTROS.</h3></td>
				    </tr>
		   </table>";
}

function trae_subtotales(){
	
	$fila = "";
	
	//Iterar por arreglo de sesiòn donde se guardan los acumulados
	//Arreglo de quincenas
	for($i=1; $i <= $_SESSION["num_quincenas"]; $i++){
		
		if($i<10)
		  $ref = "Q0".$i;
		else
		   $ref = "Q".$i;		

		$fila .= "<td bgcolor='".trae_color($ref)."'><b>".number_format($_SESSION[$ref],2)."</b></td>";
	}
	
	//Arreglo de catorcenas
	for($i=1; $i <= $_SESSION["num_catorcenas"]; $i++){
	
		if($i<10)
			$ref = "C0".$i;
		else
			$ref = "C".$i;	
		
		$fila .= "<td bgcolor='".trae_color($ref)."'><b>".number_format($_SESSION[$ref],2)."</b></td>";
	}
	
	//Arreglo de semanas
	for($i=1; $i <= $_SESSION["num_semanas"]; $i++){
	
		if($i<10)
			$ref = "S0".$i;
		else
			$ref = "S".$i;	

		$fila .= "<td bgcolor='".trae_color($ref)."'><b>".number_format($_SESSION[$ref],2)."</b></td>";
	}
	
	
	//Arreglo de meses
	for($i=1; $i <= $_SESSION["num_meses"]; $i++){
	
		if($i<10)
			$ref = "M0".$i;
			else
				$ref = "M".$i;
	
		$fila .= "<td bgcolor='".trae_color($ref)."'><b>".number_format($_SESSION[$ref],2)."</b></td>";
	}
	
	
	return $fila;
}


function formato_fecha($fecha){
	
	/*
	$fecha recibe un parámetro del tipo "20160101"    "YYYYmmdd" 
	*/
	
	$anio = substr($fecha,0,4);
	$mes  = substr($fecha,4,2);
	$dia  = substr($fecha,6,2);
	
	return $dia."/".mes_letra($mes)."/".$anio;
}

function cuenta_tiene_movimientos_poliza($base_datos, $id_cuenta, $anio){	
	
	$sql = "SELECT * FROM ".$base_datos.".dbo.MovimientosPoliza 
			         where IdCuenta = ".$id_cuenta." AND Ejercicio = ".$anio;	
	$res = mssql_query($sql);
	$num_filas = mssql_num_rows($res);
	
	return $num_filas;
}

function cuenta_tiene_saldos_periodo($base_datos, $id_cuenta, $ejercicio, $mes_ini, $mes_fin){
	
	$sql = "SELECT Id, Ejercicio, Tipo, SaldoIni,
			       Importes1, Importes2, Importes3, Importes4, Importes5, Importes6,
			       Importes7, Importes8, Importes9, Importes10, Importes11, Importes12
			       FROM ".$base_datos.".dbo.SaldosCuentas
			       WHERE IdCuenta = ".$id_cuenta."
			       AND Ejercicio = ".$ejercicio;
	$res = mssql_query($sql);
	
	$cargo = 0;
	$abono = 0;
	while($fila = mssql_fetch_assoc($res)) {
	
		/*Sumar los importes del período de meses seleccionado*/
		for($i= $mes_ini; $i <= $mes_fin; $i++){
			$campo = "Importes".$i;
				
			if($fila["Tipo"] == 2)
				$cargo += $fila[$campo];
				
			if($fila["Tipo"] == 3)
				$abono += $fila[$campo];
		}
	}	
	return $cargo + $abono;	
}

function mostrar_encabezados_cuentas($num_meses_periodo){
	
	/*
	$filas  =      "<td colspan='8'>&nbsp;</td>
			       ".genera_columna_titulo(1,"QUINCENAL",$num_meses_periodo)."
			       ".genera_columna_titulo(2,"CATORCENAL",$num_meses_periodo)."
			       ".genera_columna_titulo(3,"SEMANAL",$num_meses_periodo);
	*/		       
	
	$total_columnas =  $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"];
	
	$filas  =      "<td colspan='8'>&nbsp;</td>
	                <td colspan='".$total_columnas."'>&nbsp;</td>";
	
	return $filas;	
}

function trae_totales(){

	$filas = "";
	$columnas_base        = 8;
	$columnas_referencias = $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"];   
	$total_columnas       = $columnas_base + $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"]; 
	
	$filas .= "<tr>
				   <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>		
			   <tr>
				   <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>";
	
	$clase1 = "";
	$clase2 = "";
	$clase3 = "";
		
	if($_SESSION['TOTAL_CARGOS'] < 0)
	   $clase1 = "rojo";
	if($_SESSION['TOTAL_ABONOS'] < 0)
	   $clase2 = "rojo";
	if($_SESSION['TOTAL_SALDO'] < 0)
	   $clase3 = "rojo";
	
	
	$filas .= "<tr>
				      <td>&nbsp;</td>
				      <td>&nbsp;</td>
			          <td>&nbsp;</td>
			          <td colspan='2' align='right'>Total PROVISION NOMINA:</td>
			          <td class='".$clase1."'><strong>".number_format($_SESSION['TOTAL_CARGOS'],2)."</strong></td>
			          <td class='".$clase2."'><strong>".number_format($_SESSION['TOTAL_ABONOS'],2)."</strong></td>
			          <td class='".$clase3."'><strong>".number_format($_SESSION['TOTAL_SALDO'],2)."</strong></td>
			          ".trae_subtotales()."
				   </tr>";
	
	
	$filas .= "<tr>
				   <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>			
			   <tr>
				   <td colspan='".$total_columnas."'>&nbsp;</td>
			   </tr>";
	
	$filas .= "<tr>
				      <td>&nbsp;</td>
				      <td>&nbsp;</td>
			          <td>&nbsp;</td>
			          <td colspan='2' align='right'>Total:</td>
			          <td class='".$clase1."'><strong>".number_format($_SESSION['TOTAL_CARGOS'],2)."</strong></td>
			          <td class='".$clase2."'><strong>".number_format($_SESSION['TOTAL_ABONOS'],2)."</strong></td>
			          <td class='".$clase3."'><strong>".number_format($_SESSION['TOTAL_SALDO'],2)."</strong></td>
			          <td colspan='".$columnas_referencias."'>&nbsp;</td>		
				   </tr>";	
	
	return $filas;
}

/*
function trae_saldo_inicial_cta($base_datos, $id_cuenta, $ejercicio){
	
	$sql = "SELECT SaldoIni 
			       FROM ".$base_datos.".dbo.SaldosCuentas
			       WHERE Tipo = 1
			       AND IdCuenta = ".$id_cuenta."
			       AND Ejercicio = ".$ejercicio;
	$res = mssql_query($sql);
	$fila = mssql_fetch_assoc($res);
	
	return (float)$fila["SaldoIni"];
}
*/

function trae_saldo_inicial_cta($conn, $base_datos, $id_cuenta, $ejercicio, $mes_ini, $mes_fin){

	$saldo_inicial = 0;
	$mes_ini       = (int)$mes_ini - 1;
	$mes_fin       = (int)$mes_fin - 1;
	
	$sql = "SELECT Id, Ejercicio, Tipo, SaldoIni,
			       Importes1, Importes2, Importes3, Importes4, Importes5, Importes6,
			       Importes7, Importes8, Importes9, Importes10, Importes11, Importes12
			       FROM ".$base_datos.".dbo.SaldosCuentas
			       WHERE IdCuenta = ".$id_cuenta."
			       AND Tipo = 1
			       AND Ejercicio = ".$ejercicio;	
	//$res  = mssql_query($sql);
	$res = $conn->query($sql);
	
    //$fila = mssql_fetch_assoc($res);
	$fila = $res->fetch(PDO::FETCH_ASSOC);
    
    
    //El saldo inicial es el saldo final del mes anterior
    $campo          = "Importes".$mes_ini; //Traer importe de un mes anterior
    $saldo_inicial = $fila[$campo];

	return (float)$saldo_inicial;
}

function cuenta_tiene_movimientos($conn, $base_datos, $id_cuenta){
	
	$sql = "SELECT * FROM ".$base_datos.".dbo.MovimientosPoliza WHERE IdCuenta = ".$id_cuenta;
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//return mssql_num_rows($res);
	return $res->rowCount();  
}




function trae_saldos_cuentas($cargo, $abono, $saldo, $id_cuenta, $arr_cuentas){
	
	
	//$salida = $arr_cuentas[1];
	//$longitud = count($arr_cuentas);
	//salida_archivo("TRAE_SALDOS_CUENTAS.txt", $longitud);
	

	   $_SESSION["CARGOS"][$id_cuenta] = $cargo;
	   $_SESSION["ABONOS"][$id_cuenta] = $abono;
	   $_SESSION["SALDO"][$id_cuenta]  = $saldo;
	
	

	    $_SESSION["TOTAL_CARGOS"] = 0;
	    $_SESSION["TOTAL_ABONOS"] = 0;
	    $_SESSION["TOTAL_SALDO"] = 0;
	    
   for($j = 0; $j < count($arr_cuentas); $j++){	
		
		$cuenta = $arr_cuentas[$j];
		
		if(isset($_SESSION["CARGOS"][$cuenta]))
		  $_SESSION["TOTAL_CARGOS"] += $_SESSION["CARGOS"][$cuenta];
		
		if(isset($_SESSION["ABONOS"][$cuenta]))
		   $_SESSION["TOTAL_ABONOS"] += $_SESSION["ABONOS"][$cuenta];
		
		if(isset($_SESSION["SALDO"][$cuenta]))		
		  $_SESSION["TOTAL_SALDO"]  += $_SESSION["SALDO"][$cuenta];
		
	}
	
	
		$filas = "<tr>
				      <td>&nbsp;</td>
				      <td>&nbsp;</td>
			          <td>&nbsp;</td>
			          <td>&nbsp;</td>
			          <td>Total:</td>
			          <td><strong>".number_format($cargo,2)."</strong></td>
			          <td><strong>".number_format($abono,2)."</strong></td>
			          <td><strong>".number_format($saldo,2)."</strong></td>
				   </tr>";
		return $filas;
}

function trae_color($referencia){
	
	if($referencia[0] == "Q")
	   return "#FAAC58";
	if($referencia[0] == "C")
		return "#81F7F3";
	if($referencia[0] == "S")
		return "#BEF781";
	if($referencia[0] == "M")
		return "#EC7063";
}

function trae_movimientos_poliza($conn, $base_datos, $id_cuenta, $fecha_ini, $fecha_fin, $num_meses_periodo, $saldo_inicial, $arr_cuentas){

	$filas = "";	
	$sql = "SELECT CAST(Fecha AS DATE) AS Fecha, TipoPol, Folio, TipoMovto, Concepto, Referencia, Importe
			       FROM ".$base_datos.".dbo.MovimientosPoliza
			       WHERE IdCuenta = ".$id_cuenta."
			       AND (CAST(Fecha AS DATE) BETWEEN '".$fecha_ini."' AND '".$fecha_fin."')";
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$num_filas = mssql_num_rows($res);
	$num_filas = $res->rowCount();  
	
	//salida_archivo("TRAE_movimientos_poliza.txt", $sql);	

	/*CREAR TODAS LAS COLUMNAS DEL EXCEL, DONDE SE ACUMULARAN LOS SUBTOTALES*/	 
	$total_columnas = $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"];
	
	
	
	$acumulado[0]["color"]       = ""; 
	$acumulado[0]["indice"]      = 0;
	$acumulado[0]["encabezado"]  = "";
	$acumulado[0]["valor"]       = 0;
	
	 
	for($i = 1; $i <= $total_columnas; $i++){	
		$acumulado[$i]["color"]       = "#CCCCCC"; //Gris claro
		$acumulado[$i]["indice"]      = $i; 
		$acumulado[$i]["encabezado"]  = "";
		$acumulado[$i]["valor"]       = 0; 	
	}
	
	$indice = 1;
	//while($fila = mssql_fetch_assoc($res)){
	
	$fecha = "";
	$SUB_TOTAL_CARGOS = 0;	
	$SUB_TOTAL_ABONOS = 0;
	$SUB_TOTAL_SALDO  = 0;
	$saldo = 0;
	
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){
		
		 $cargo = "0";
		 $abono = "0";		 
		 
		 $fecha      = formato_fecha_dmY($fila["Fecha"]);
		 $tipo_pol   = $fila["TipoPol"];
		 $folio      = $fila["Folio"];
		 $tipo_movto = $fila["TipoMovto"];
		 $concepto   = $fila["Concepto"];
         $referencia = strtoupper(trim($fila["Referencia"])); //Convertir a mayúscula el valor de referencia, para que en las comparaciones de este valor en otras funciones la condición no falle
		 $importe    = $fila["Importe"];
		 
		 if($tipo_movto == 0){
		 	$tipo  = "Egresos";
		 	$cargo = (float)$fila["Importe"];
		 }
		 	
		 if($tipo_movto == 1){
		 	$tipo  = "Diario";
		 	$abono = (float)$fila["Importe"];
		 }
		 
		 if($indice > 1) //Para que solo se pase el importe la primera vez a la función "calcular_saldo"
		 	$saldo_inicial = 0;
		 
		 $saldo += calcular_saldo($saldo_inicial, $abono, $cargo);
		 
		 $clase = "";		 
		 
		 if($saldo < 0)
		 	$clase = "rojo";
		 	
		 	
		 $SUB_TOTAL_CARGOS += $cargo; 
		 $SUB_TOTAL_ABONOS += $abono;
		 $SUB_TOTAL_SALDO  = $saldo;
         
         $filas .= "<tr>
				      <td class='fila_poliza'>".$fecha."</td>
				      <td class='fila_poliza'>".$tipo."</td>
			          <td class='fila_poliza'>".$folio."</td>
			          <td class='fila_poliza'>".$concepto."</td>
			          <td align='center' bgcolor='".trae_color($referencia)."'><strong>".$referencia."</strong></td>
			          <td class='fila_poliza'>".number_format($cargo,2)."</td>
			          <td class='fila_poliza'>".number_format($abono,2)."</td>
			          <td class='fila_poliza ".$clase."'>".number_format($saldo,2)."</td>
			          ".ubicar_en_tabla($tipo_movto, $referencia, $importe, $num_meses_periodo)."		
				   </tr>";         
        
         $importe = (float)$importe;
         
		 $valor = 0;          
         
         if($tipo_movto == 0) //cargo
         	$valor = $importe;         
         
         if($tipo_movto == 1) //abono        	
         	$valor = $importe * -1; //Poner valor negativo a $valor        	
         
         
            //COLUMNAS DE LAS QUINCENAS
            $j = 1;
            for($i = 1; $i <= $_SESSION["num_quincenas"]; $i++){                        	
            	
            	if($j < 10)
            	   $prefijo = "Q0".$j;
            	else  
                   $prefijo = "Q".$j;
            	
         		$acumulado[$i]["color"]       = trae_color("Q");
         		$acumulado[$i]["indice"]      = $i; 
         		$acumulado[$i]["encabezado"]  = $referencia;
         		
         		if($referencia == $prefijo)
         		   $acumulado[$i]["valor"]       += $valor;
         		
         		$j++;
            }
            
            //COLUMNAS DE LAS CATORCENAS
            $j = 1;
           	for($i = $_SESSION["num_quincenas"] + 1; $i <= $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"]; $i++){            	
            	
            	if($j < 10)
            		$prefijo = "C0".$j;
            	else
            		$prefijo = "C".$j;
            	
            	$acumulado[$i]["color"]       = trae_color("C");
            	$acumulado[$i]["indice"]      = $i;
            	$acumulado[$i]["encabezado"]  = $referencia;
            	
            	if($referencia == $prefijo)            		
            	   $acumulado[$i]["valor"]       += $valor;            	
            	
            	$j++;            	
            }
            
            //COLUMNAS DE LAS SEMANAS
            $j = 1;            
            for($i = $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + 1; $i <= $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"]; $i++){
            	
            	if($j < 10)
            		$prefijo = "S0".$j;
            	else
            		$prefijo = "S".$j;
            	
            	$acumulado[$i]["color"]       = trae_color("S");
            	$acumulado[$i]["indice"]      = $i; 
            	$acumulado[$i]["encabezado"]  = $referencia;
            	            	
            	if($referencia == $prefijo)
            	   $acumulado[$i]["valor"]       += $valor;
            	
            	$j++;
            }
            
            
            //COLUMNAS DE LOS MESES
            $j = 1;
            for($i = $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + 1; $i <= $_SESSION["num_quincenas"] + $_SESSION["num_catorcenas"] + $_SESSION["num_semanas"] + $_SESSION["num_meses"]; $i++){
            	 
            	if($j < 10)
            		$prefijo = "M0".$j;
            		else
            			$prefijo = "M".$j;
            			 
            			$acumulado[$i]["color"]       = trae_color("M");
            			$acumulado[$i]["indice"]      = $i;
            			$acumulado[$i]["encabezado"]  = $referencia;
            
            			if($referencia == $prefijo)
            				$acumulado[$i]["valor"]       += $valor;
            				 
            				$j++;
            }
       
            $indice++;
            
            
           
	}//while
	
	//Aquí se muestra la sumatoria por columnas, QUINCENAL, CATORCENAL Y SEMANAL	
	$filas .= "<tr>
	              <td colspan='8'>".$fecha."</td>
			      ".ubicar_en_tabla_acumulado($acumulado)."
			   </tr>";
	
	
	$filas .= trae_saldos_cuentas($SUB_TOTAL_CARGOS, $SUB_TOTAL_ABONOS, $SUB_TOTAL_SALDO, $id_cuenta, $arr_cuentas);	
	return $filas;	
}

function ubicar_en_tabla_acumulado($acumulado){
	
	$longitud = count($acumulado) - 1;	
	$columnas = "";	
	
	for($i = 1; $i <= $longitud; $i++){
		
		$valor     = number_format($acumulado[$i]["valor"],2);
		//$valor     = number_format($acumulado[0]["valor"],2);
        if($valor == "-0.00") $valor = number_format(0,2);
        $columnas .= "<td bgcolor='".$acumulado[$i]["color"]."' align='right'><strong>".$valor."</strong></td>";
        //$columnas .= "<td bgcolor='".$acumulado[0]["color"]."' align='right'><strong>".$valor."</strong></td>";
	}	
	
  return $columnas;	
}

function genera_columna_titulo($tipo, $titulo, $num_meses_periodo){
	
	   /*
	   * $tipo = 1; >>> QUINCENAL
	   * $tipo = 2; >>> CATORCENAL
	   * $tipo = 3; >>> SEMANAL
	   * $tipo = 4; >>> MENSUAL
	   * */
	
	if($tipo == 1){ //QUINCENAL
		$color   = "#FAAC58";
		$numero  = $_SESSION["num_quincenas"];
		$prefijo = "Q";
	}
	
	if($tipo == 2){ //CATORCENAL
		$color   = "#81F7F3";
		$numero  = $_SESSION["num_catorcenas"];
		$prefijo = "C";
	}
	
	if($tipo == 3){ //SEMANAL
		$color   = "#BEF781";
		$numero  = $_SESSION["num_semanas"];
		$prefijo = "S";
	}		

	if($tipo == 4){ //MENSUAL
		$color   = "#EC7063";
		$numero  = $_SESSION["num_meses"];
		$prefijo = "M";
	}
	
	
   return "<td colspan='".$numero."' bgcolor='".$color."' align='center'>
   		        <strong>".$titulo."</strong>
   		   </td>";
}

function generar_columnas_encabezado($tipo, $titulo, $num_meses_periodo){
	
	/*
	 * $tipo = 1; >>> QUINCENAL 
	 * $tipo = 2; >>> CATORCENAL
	 * $tipo = 3; >>> SEMANAL
	 * $tipo = 4; >>> MENSUAL
	 * */
	
	if($tipo == 1){ //QUINCENAL		
		$color   = "#FAAC58";
		$numero  = $_SESSION["num_quincenas"];   
		$prefijo = "Q";
	}
	
	if($tipo == 2){ //CATORCENAL
		$color   = "#81F7F3";	
		$numero  = $_SESSION["num_catorcenas"];
		$prefijo = "C";
	}
	
	if($tipo == 3){ //SEMANAL
		$color   = "#BEF781";	
		$numero  = $_SESSION["num_semanas"];
		$prefijo = "S";
	}
	
	if($tipo == 4){ //MENSUAL
		$color   = "#EC7063";
		$numero  = $_SESSION["num_meses"];
		$prefijo = "M";
	}

	
	$columnas = "";

	for($i = 1; $i <= $numero; $i++){
	
		if($i < 10)
			$valor = $prefijo."0".$i;
		else
			$valor = $prefijo.$i;
	
		$columnas .= "<td bgcolor='".$color."' align='center'><strong>".$valor."</strong></td>";		
	}
	
	return $columnas;	
}

function obten_num_meses_periodo($mes_ini, $mes_fin){
	
	$num_meses = ((int)$mes_fin - (int)$mes_ini) + 1;
	
	return $num_meses;
}

function ubicar_en_tabla($tipo_movto, $referencia, $importe, $num_meses_periodo){

	/*
	 $tipo_movto 0 >>> Cargo o Egreso
	 $tipo_movto 1 >>> Abono o Diario  //Poner negativo a $importe
	*/
	
	/*
	 El campo $num_meses_periodo tiene el número de meses del período que deseamos consultar,
	 este dato nos servirá para saber cuántas quincenas mostrar en la salida.	 
	 */
	
	$color_quincenas  = "#FAAC58";
	$color_catorcenas = "#81F7F3";
	$color_semanas    = "#BEF781";
	$color_meses      = "#EC7063";
	
	if($tipo_movto == 0){ //cargo
	   $valor = $importe;	   
	}
	
	if($tipo_movto == 1){ //abono
		$valor = "-".$importe;
	}
	
	$columnas = "";
	$indice = 1;
	
	//Generar dinámicamente el arreglo de las quincenas
	for($i = 1; $i <= $_SESSION["num_quincenas"]; $i++){
		
		if($i < 10)
		   $valor_quincena = "Q0".$i;
		else 
		   $valor_quincena = "Q".$i;
		
		$arr_posiciones[$indice]["encabezado"] = $valor_quincena;
		$arr_posiciones[$indice]["posicion"] = $i;		
		$arr_posiciones[$indice++]["color"]    = $color_quincenas;		
	}
	
	
	//Generar dinámicamente el arreglo de las catorcenas
	for($i = 1; $i <= $_SESSION["num_catorcenas"]; $i++){
	
		if($i < 10)
			$valor_catorcena = "C0".$i;
		else
			$valor_catorcena = "C".$i;
	
		$arr_posiciones[$indice]["encabezado"] = $valor_catorcena;
		$arr_posiciones[$indice]["posicion"] = $i;		
		$arr_posiciones[$indice++]["color"]    = $color_catorcenas;		
	}
	
	
	//Generar dinámicamente el arreglo de las semanas
	for($i = 1; $i <= $_SESSION["num_semanas"]; $i++){
	
		if($i < 10)
			$valor_semana = "S0".$i;
		else
			$valor_semana = "S".$i;
	
		$arr_posiciones[$indice]["encabezado"] = $valor_semana;
		$arr_posiciones[$indice]["posicion"] = $i;		
		$arr_posiciones[$indice++]["color"]    = $color_semanas;		
	}
	
	
	//Generar dinámicamente el arreglo de los meses
	for($i = 1; $i <= $_SESSION["num_meses"]; $i++){
	
		if($i < 10)
			$valor_mes = "M0".$i;
			else
				$valor_mes = "M".$i;
	
				$arr_posiciones[$indice]["encabezado"] = $valor_mes;
				$arr_posiciones[$indice]["posicion"] = $i;
				$arr_posiciones[$indice++]["color"]    = $color_meses;
	}
	
	
	for($i=1; $i < $indice; $i++){		
		
		if($referencia == $arr_posiciones[$i]["encabezado"]){		   
		   $columnas .= "<td bgcolor='".$arr_posiciones[$i]["color"]."'>".number_format($valor,2)."</td>";		   
		   $_SESSION[$referencia] +=  $valor; //Aquì se acumulan los totales por referencias
		}
		else 
		   $columnas .= "<td>
		   		               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   		               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   		         </td>";		
	}

	return $columnas;	
}

function calcular_saldo($saldo_inicial, $abono, $cargo){
 
	return $saldo_inicial + ($abono - $cargo);	
}

function salida_archivo($nom_archivo, $salida){
	
	$fp = fopen($nom_archivo, 'w+');
    fwrite($fp, $salida);
    fclose($fp);
}

function extrae_fecha($parte_fecha, $fecha1){	
	
	/*
	 El parámetro $fecha1 tiene un valor del tipo "mm/dd/YYY"
	 
	 $parte_fecha = 0 >> mes
	 $parte_fecha = 1 >> día
	 $parte_fecha = 2 >> año
	 */
	
	$tmp  = explode("/",$fecha1);	
	return $tmp[$parte_fecha];
}


function trae_ejercicio($conn, $base_datos, $anio){
	
	$sql = "SELECT id FROM ".$base_datos.".dbo.Ejercicios
                   WHERE Ejercicio = ".$anio;
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$fila = mssql_fetch_assoc($res);
	$fila = $res->fetch(PDO::FETCH_ASSOC);
	
	$id = $fila["id"];
	return $id;	
}


function combo_box($opciones, $values, $valor_default, $seleccionado, $nombre_elemento){

  $tempOpc = explode("|",$opciones);
  $tempVal = explode("|",$values);
  
  $list_menu = '<select id="'.$nombre_elemento.'" name="'.$nombre_elemento.'" class="class_select">';
  $list_menu .= "<option value=''>".$valor_default."</option>\n";
  
  $total = count($tempVal);
  
  for($i = 0; $i < $total; $i++){
  
      $select = '';		
		
		if($tempVal[$i] == $seleccionado) 
			$select = "selected";
		
    
      $list_menu .= "<option value='".$tempVal[$i]."' $select>".$tempOpc[$i]."</option>";
  
  }  
  
  $list_menu .= '</select>';
  
  return $list_menu;
}

function combo_sql($conn, $sql, $nom_combo, $seleccionado = "", $evento = "", $nom_clase = ""){
	
	//return "1";

	$evt = "";
	$clase = "";

	if($evento != "")
		$evt = "onchange = '".$evento."'";

	if($nom_clase != "")
		$clase = " class='".$nom_clase."'";

	$tmp = "<select style='width: 200px;' id='".$nom_combo."' name='".$nom_combo."' ".$evt." ".$clase.">";
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	

	//$tmp .= "<option value='0'>&nbsp;</option>";
	$tmp .= "<option value=''>&nbsp;</option>";
	//while($fila = mssql_fetch_array($res)){
		
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);
	while($fila = $res->fetch(PDO::FETCH_NUM)){	
		

		$selected = "";
		if($fila[0] == $seleccionado)
			$selected = "selected";

		//$tmp .= "<option value=".$fila[0]." ".$selected.">".utf8_encode($fila[1])."</option>";
			$tmp .= "<option value=".$fila[0]." ".$selected.">".$fila[1]."</option>";
	}

	$tmp .= "</select>";

	return $tmp;
}

function formatear_nombre($nom){
	
	/*
	 Quitar los espacios intermedios de $nom y convetirlo en minúsculas
	 * */
	$tmp = explode(" ",$nom);
	$longitud = count($tmp);
	$cadena = "";
	
	foreach($tmp as $elem)		
		$cadena .= trim($elem); 
	
	return strtolower($cadena);	
}

function transformar_fecha($fecha){
	
	/*
	El parámetro $fecha tiene un valor del tipo "mm/dd/YYY"
	y esta función transforma la fecha en una del tipo '20160101' 'YYYYmmdd'
	 */	
	//'20160101'
	
	$mes  = extrae_fecha(0, $fecha);
	$dia  = extrae_fecha(1, $fecha);
	$anio = extrae_fecha(2, $fecha);
	
	return $anio.$mes.$dia;	
}

function formato_fecha_dmY($fecha){

	/*
	 $fecha recibe un parámetro del tipo "2016-03-28"    "YYYY-mm-dd"
	 */

	$tmp  = explode("-",$fecha);
	$dia  = $tmp[2];
	$mes  = $tmp[1];
	$anio = $tmp[0];

	return $dia."/".mes_letra($mes)."/".$anio;
}

function mes_letra($num_mes){

	$num_mes = (int)$num_mes;

	$arr_meses = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

	return $arr_meses[$num_mes];
}


function trae_nombre_bd($conn, $codigo){

	$sql = "SELECT nombre_bd FROM [dbo].[pagadoras]
                  WHERE codigo = ".$codigo;
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$num_filas = mssql_num_rows($res);
	$num_filas = count($res);
	
	if($num_filas == 0)
		return;

		//$fila = mssql_fetch_array($res);		
		$fila = $res->fetch(PDO::FETCH_ASSOC);
		
		
		$nombre_bd = $fila["nombre_bd"];

		//return "[".$nombre_bd."]";
		return $nombre_bd;
}

function formatear_cuenta($cuenta){

	/*
	 $cuenta es un string del tipo "219000300000000086",
	 la función regresa uno del tipo

	 2190-00-3000-000000-86
	 */

	$parte_01 = substr($cuenta,0,4);
	$parte_02 = substr($cuenta,4,2);
	$parte_03 = substr($cuenta,6,4);
	$parte_04 = substr($cuenta,10,6);
	$parte_05 = substr($cuenta,16,2);

	$cadena_nva = $parte_01."-".$parte_02."-".$parte_03."-".$parte_04."-".$parte_05;

	return $cadena_nva;
}
?>