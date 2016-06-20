<?php

$_SESSION["TOTAL_MOVTOS"] = 0;
$_SESSION["TOTAL_HC"]	  = 0;

function condicion_bds_activas($conn){
	//$sql = "SELECT IDempresa FROM [".$base_datos."].[dbo].[bases_datos_activas] WHERE activo = 'N'";
	$sql = "SELECT IDempresa FROM [dbo].[bases_datos_activas] WHERE activo = 'N'";
	
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	$i=0;
	//while($fila = mssql_fetch_array($res)){
	while($fila = $res->fetch(PDO::FETCH_ASSOC)) {
		  $ids_excluir[$i] = $fila["IDempresa"];
		  $i++;
	}	
	
	$total = count($ids_excluir);
	
	$condicion = "";
	for($i=0; $i < $total; $i++){
	
		$operador = "";
	
		if($i < ($total - 1))
			$operador = " AND ";
	
			$condicion .= " IDEmpresa <> ".$ids_excluir[$i].$operador;
	}
	
	if($total > 0)
	   $condicion_f = " WHERE ".$condicion;
	
	return $condicion_f;
}

function trae_nombre_bd($id_empresa){
	
	$sql = "SELECT RutaEmpresa 
			       FROM [nomGenerales].[dbo].[NOM10000] WHERE IDempresa = ".$id_empresa;	
	$res = mssql_query($sql);
	$fila = mssql_fetch_array($res);
	$nombre_bd = $fila["RutaEmpresa"];
	
	return "[".$nombre_bd."]";	
}

function existe_bd_server($conexion, $nombre_bd){
	
	$sql = "SELECT name, user_access_desc, is_read_only, state_desc, recovery_model_desc 
			       FROM sys.databases
			       WHERE name = '".$nombre_bd."'";
	$res = mssql_query($sql, $conexion);
	$num_filas = mssql_num_rows($res);
	
	return $num_filas;	
}

function condicion_seleccionadas($chk_empresas){
	
	/*
	 * $chk_empresas tiene los IDs de las empresas separados por comas
	 * */
	$condicion = " WHERE ";
	$tmp   = explode(",",$chk_empresas);
	$total = count($tmp);
	
	$contador = 0;
	for($i=0; $i < $total; $i++){
				
		$condicion .= " IDempresa = ".$tmp[$i];
		
		if($contador < $total - 1)
		   $condicion .= " OR ";	 
		
		$contador++;
	}
	
	return $condicion;	
}


function trae_datos_hc($conn, $condicion){
	
	/*
	$sql = "SELECT IDempresa, RutaContpaqW, NombreEmpresa, RutaEmpresa
			       FROM [nomGenerales].[dbo].[NOM10000]".$condicion." 
			       		ORDER BY RutaContpaqW, NombreEmpresa"; //Ordenado por pagadora, empresa
			       		*/	
	$sql = "SELECT IDempresa, RutaContpaqW, NombreEmpresa, RutaEmpresa
			       FROM [dbo].[NOM10000]".$condicion."
			       		ORDER BY RutaContpaqW, NombreEmpresa"; //Ordenado por pagadora, empresa
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	$i=0;
	//while($fila = mssql_fetch_array($res)){		
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){	
		  $arr_datos[$i]["id"]         = $fila["IDempresa"];
		  $arr_datos[$i]["pagadora"]   = $fila["RutaContpaqW"];
		  $arr_datos[$i]["empresa"]    = $fila["NombreEmpresa"];
		  $arr_datos[$i]["base_datos"] = $fila["RutaEmpresa"];		  
		  $i++;
	}	
	return $arr_datos;	
}

function contar_empleados($conn, $fecha_inicio, $fecha_fin, $idtipoperiodo){

	$num_empleados = 0;
	$sql1 = "SELECT * FROM nom10001
	                  WHERE (estadoempleado='A' or estadoempleado='R')
			          AND (CAST(fechaalta as DATE) <='".$fecha_fin."')
			          AND idtipoperiodo=".$idtipoperiodo;	
	$res1 = $conn->query($sql1);	
	$rows1 = $res1->fetchAll();
	$num_empleados += count($rows1);	
	
	$sql2 = "SELECT * FROM nom10001 as t1
                      JOIN nom10023 as t2
			          ON t1.idtipoperiodo = t2.idtipoperiodo
                      WHERE t1.estadoempleado='B'
			                AND (CAST(t1.fechabaja as DATE) >='".$fecha_inicio."')
			                AND (CAST(t1.fechaalta as DATE) <='".$fecha_fin."')
			                AND t1.idtipoperiodo=".$idtipoperiodo;
	$res2 = $conn->query($sql2);
	$rows2 = $res2->fetchAll();
	$num_empleados += count($rows2);
	return $num_empleados;
}

//function trae_info_empresa($campo, $base_datos){
function trae_info_empresa($conn, $campo, $bd){
	
	//Quitarle los corchetes [nombrebd] a la $base_datos, que vienen en el primer y último caracter
	
	//$longitud = strlen($base_datos) - 2;
	//$bd = substr($base_datos, 1, $longitud);
	
	//$sql = "SELECT ".$campo." FROM [nomGenerales].[dbo].[NOM10000] WHERE RutaEmpresa = '".$bd."'";
	$sql = "SELECT ".$campo." FROM [dbo].[NOM10000] WHERE RutaEmpresa = '".$bd."'";
	//$res  = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$fila = mssql_fetch_array($res);
	$fila = $res->fetch(PDO::FETCH_ASSOC);
	
	return $fila[$campo];	
}


function tabla_encabezados($conn, $base_datos){
	
    $tabla = "<table class='tbl_datos_empresa' style='background: #3498db'>
			    <tr>
			       <td width='20%'>PAGADORA</td>
			       <td width='80%'>".trae_info_empresa($conn, "RutaContpaqW", $base_datos)."</td>
		        </tr>
			    <tr>
			       <td>EMPRESA</td>
			       <td>".trae_info_empresa($conn, "NombreEmpresa", $base_datos)."</td>
		        </tr>
			    <tr>
			       <td>BASE DE DATOS</td>
			       <td>".$base_datos."</td>
		        </tr>
			      
			 </table>";	
	return $tabla;
}

function mayor_id_periodo($conn, $idtipoperiodo, $idperiodo, $mes, $anio){		
	
	$sql = "select  max(a.idperiodo) as mayoridperiodo
                    from nom10002 a
                    join nom10023 b on a.idtipoperiodo= b.idtipoperiodo
                    where a.mes='".$mes."' and a.ejercicio='".$anio."' 
			        and (b.nombretipoperiodo NOT like '%Extraordinario%' 
                         or b.nombretipoperiodo NOT like '%EXTRAORDINARIO%')
                    and a.idtipoperiodo = ".$idtipoperiodo."		
                    group by a.idtipoperiodo";
	$res = $conn->query($sql);
	$fila = $res->fetch(PDO::FETCH_ASSOC);
	
    $mayoridperiodo = $fila["mayoridperiodo"];
     
    if($idperiodo == $mayoridperiodo)
     	return true;
    else
     	return false;	
}

function consultar_head_count($conn1, $conn2, $mes, $anio, $base_datos, $mostrar_totales, $depto){
	
	/*
	 * $depto = 1; Dirección General
	 * $depto = 2; Finanzas
	 * */
	
	$tabla = "<table border='1' class='tbl_hc' id='Exportar_a_Excel_HC'>";
	
	
	if($depto == 1)
	   $tabla .= "<tr>
		  		    <td colspan='11'>".tabla_encabezados($conn1, $base_datos)."</td>
		  	      </tr>
	              <tr class='tbl_encabezado_empresa' style='background: #3498db'>
		  		       <td width='100'>ID Tipo Periodo</td>
			           <td width='100'>Id Periodo</td>
			           <td width='100'>Numero Periodo</td>
		  		       <td width='500'>Nombre Periodo</td>
			           <td width='100'>Mes</td>
			           <td width='100'>Ejercicio</td>
		  		       <td width='100'>Fecha Inicio</td>
		  		       <td width='100'>Fecha Fin</td>
		  		       <td width='100'>Total Movimientos</td>
                       <td width='100'>Sub Total Movimientos</td>
		  		       <td width='100'>Head Count Mensual</td>
		  		    </tr>";	
	
	if($depto == 2)
	   $tabla .= "<tr class='tbl_encabezado_empresa' style='background: #3498db;'>			
	       				<td width='500'>Empresa</td>
		   			    <td width='500'>Pagadora</td>			
		   				<td width='100'>Numero Periodo</td>
		                <td width='500'>Nombre Periodo</td>
		                <td width='100'>Mes</td>
		                <td width='100'>Ejercicio</td>
		                <td width='100'>Fecha Inicio</td>
		                <td width='100'>Fecha Fin</td>
		                <td width='100'>Total Movimientos</td>
		                <td width='100'>Sub Total Movimientos</td>
		                <td width='100'>Head Count Mensual</td>			
		                <td width='500'>BASE DE DATOS</td>			
		  		        <td width='100'>ID Tipo Periodo</td>
			            <td width='100'>Id Periodo</td>	       
		  		    </tr>";
	
	
	$sql = "select  a.idtipoperiodo, a.idperiodo, a.numeroperiodo, a.mes, a.ejercicio, 
			        CAST(a.fechainicio as DATE)	AS fechainicio,
			        CAST(a.fechafin as DATE)	AS fechafin,	        
			        a.finmes, b.nombretipoperiodo
                    from nom10002 a
                    join nom10023 b on a.idtipoperiodo= b.idtipoperiodo
                    where a.mes='".$mes."' and a.ejercicio='".$anio."' 
			        and (b.nombretipoperiodo  NOT like '%Extraordinario%' 
			        or b.nombretipoperiodo  NOT like '%EXTRAORDINARIO%') ORDER BY a.idtipoperiodo";	
	//$res  = mssql_query($sql);
	$res = $conn2->query($sql);
	
	//$num_filas = mssql_num_rows($res);
	$num_filas = $res->rowCount(); 
	
	$x = 0;
	$subtotal_hc = 0;
	//while($fila = mssql_fetch_array($res)){
	
	
	//INICIALIZAR ESTE ARREGLO PARA QUE NO MARQUE FUERA DE INDICE
	$arr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	
	
	$arr_tipo_periodo = array();
	while($fila = $res->fetch(PDO::FETCH_ASSOC)){
		
		  $idtipoperiodo     = $fila["idtipoperiodo"];
		  $idperiodo         = $fila["idperiodo"];		  
		  $numeroperiodo     = $fila["numeroperiodo"];		  
		  $nombretipoperiodo = $fila["nombretipoperiodo"];		  
		  $mes               = $fila["mes"];
		  $ejercicio         = $fila["ejercicio"];		  
		  $fechainicio       = $fila["fechainicio"];
		  $fechafin          = $fila["fechafin"];
		  $total_movimientos = contar_empleados($conn2, $fechainicio, $fechafin, $idtipoperiodo);
		  	
		     $arr[$idtipoperiodo]    += $total_movimientos;
		     $arr_tipo_periodo[$x++] = $idtipoperiodo;


		  if(mayor_id_periodo($conn2, $idtipoperiodo, $idperiodo, $mes, $anio)){
		     $hc = $total_movimientos;
		     $subtotal_hc += $hc;	
		   //  if(isset($arr[$idtipoperiodo]))
			    $subtotal_movtos = $arr[$idtipoperiodo];	
		     
		  }
		  else{ 
		  	 $hc = "";		  	 
		  	 $subtotal_movtos = "";	  	 
		  }
		  	 
		  if($depto == 1)
             $tabla .= "<tr>
		  		       <td>".$idtipoperiodo."</td>
		  		       <td>".$idperiodo."</td>
                       <td>".$numeroperiodo."</td>
                       <td>".$nombretipoperiodo."</td>
                       <td>".$mes."</td>
                       <td>".$ejercicio."</td>
		  		       <td>".formato_fecha_dmY($fechainicio)."</td>
		  		       <td>".formato_fecha_dmY($fechafin)."</td>
		  		       <td align='right'>".$total_movimientos."</td>
			           <td width='100' align='right'>".$subtotal_movtos."</td>
		  		       <td align='right'>".$hc."</td>
		  		    </tr>";
          
          if($depto == 2)          	
          	 $tabla .= "<tr>
			           <td>".trae_info_empresa($conn1, "NombreEmpresa", $base_datos)."</td>
			           <td>".trae_info_empresa($conn1, "RutaContpaqW", $base_datos)."</td>
			           <td>".$numeroperiodo."</td>
			           <td>".$nombretipoperiodo."</td>
                       <td>".$mes."</td>
                       <td>".$ejercicio."</td>
		  		       <td>".formato_fecha_dmY($fechainicio)."</td>
		  		       <td>".formato_fecha_dmY($fechafin)."</td>
		  		       <td align='right'>".$total_movimientos."</td>
			           <td width='100' align='right'>".$subtotal_movtos."</td>
			           <td align='right'>".$hc."</td>
		  		       <td>".$base_datos."</td>
		  		       <td>".$idtipoperiodo."</td>
		  		       <td>".$idperiodo."</td>
		  		    </tr>";
          
		
	}	
	
	
	$subtotal = 0; //Sumar subtotal movimientos
	
	if($x > 0){ //Significa que hubo movtos
		
	      $arr_indices_periodos = array_values(array_unique($arr_tipo_periodo));
	
	
	      $total_indices = count($arr_indices_periodos);
	      for($i = 0; $i < $total_indices; $i++){
	      	if(isset($arr[$arr_indices_periodos[$i]]))
		      $subtotal += $arr[$arr_indices_periodos[$i]];
	      }
	   
	}  
	
	if($depto == 1)
		$celdas   = "";	
	
	if($depto == 2){
		$celdas   = "<td>&nbsp;</td>
    		        <td>&nbsp;</td>
    		        <td>&nbsp;</td>";
	}
		
    $tabla .= "<tr class='subtotal_movtos' style='background: #CCCCCC'>
    		       <td colspan='9'>&nbsp;</td>
    		       <td align='right'>".$subtotal."</td>
    		       <td align='right'>".$subtotal_hc."</td>".
    		       $celdas."
    	       </tr>";
	
    $_SESSION["TOTAL_MOVTOS"] += $subtotal;
    $_SESSION["TOTAL_HC"]     += $subtotal_hc;
    
   
    if($mostrar_totales == 1) //Muestra al final una fila con la sumatoria global del head count
       $tabla .= muestra_totales_head_count($_SESSION["TOTAL_MOVTOS"], $_SESSION["TOTAL_HC"], $depto);
    
	
    $tabla .= "</table>";	
	return $tabla;	
}

function muestra_totales_head_count($total_movtos, $total_hc, $depto){	
	
	if($depto == 1)	
	   $celdas   = "";
	
		
	if($depto == 2){
	   $celdas   = "<td>&nbsp;</td>
    		        <td>&nbsp;</td>
    		        <td>&nbsp;</td>";
	}
		
	$fila = "<tr class='totales_head_count' style='background: #0F9B53'>
			  		<td colspan='9' align='right'>TOTALES</td>
				    <td align='right'>".$total_movtos."</td>
				    <td align='right'>".$total_hc."</td>".
				    $celdas.
    	      "</tr>";
	
	return $fila;
}

//function muestra_tabla_head_counts($conexion, $mes, $anio, $arr_datos, $depto){

function muestra_tabla_head_counts($conn1, $mes, $anio, $arr_datos, $depto){

	$total = count($arr_datos);
	$salida = "<table border='1' id='Exportar_a_Excel_HC' width='3000'>";
	
	$ultimo = 0;
	$mostrar_totales = 0;
	
	

	
	
	for($i=0; $i < $total; $i++){

		//$existe = existe_bd_server($conexion, $nombre_bd);
		//$nombre_bd  = "[".$arr_datos[$i]["base_datos"]."]";
		$nombre_bd  = $arr_datos[$i]["base_datos"];
		
		if($ultimo == $total - 1) //Estamos consultando la última bd
		   $mostrar_totales = 1;	


		//if(cambiar_bd($conexion, $nombre_bd))
		   $obj2 = new Database();
		   $obj2->set_connection("Esprezzaserver3\Compac2008", $nombre_bd);
		   $conn2 = $obj2->get_connection();
			
			
			//$salida .= "<tr><td>".consultar_head_count($mes, $anio, $nombre_bd, $mostrar_totales, $depto)."</td></tr>";
		   $salida .= "<tr><td>".consultar_head_count($conn1, $conn2, $mes, $anio, $nombre_bd, $mostrar_totales, $depto)."</td></tr>";
		//else
			//$salida += "ERROR";
		
		$ultimo++;	

	}//for
	
	$salida .= "</table>";
	return $salida;
}

function salida_archivo($nom_archivo, $salida){
	
	$fp = fopen($nom_archivo, 'w+');
    fwrite($fp, $salida);
    fclose($fp);
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

function combo_sql($sql, $nom_combo, $seleccionado = "", $evento = "", $nom_clase = ""){

	$evt = "";
	$clase = "";

	if($evento != "")
		$evt = "onchange = '".$evento."'";

	if($nom_clase != "")
		$clase = " class='".$nom_clase."'";

	$tmp = "<select style='width: 200px;' id='".$nom_combo."' name='".$nom_combo."' ".$evt." ".$clase.">";
	$res = mssql_query($sql);

	//$tmp .= "<option value='0'>&nbsp;</option>";
	$tmp .= "<option value=''>&nbsp;</option>";
	while($fila = mssql_fetch_array($res)){

		$selected = "";
		if($fila[0] == $seleccionado)
			$selected = "selected";

		$tmp .= "<option value=".$fila[0]." ".$selected.">".utf8_encode($fila[1])."</option>";
	}

	$tmp .= "</select>";

	return $tmp;
}


function tabla_checkbox_sql($conn, $sql, $nom_elem, $columnas){	
	
	$ancho_celda = 100 / $columnas;
	
	$tabla = "<table border='1' width='100%'><tr>";
	//$res = mssql_query($sql);
	$res = $conn->query($sql);
	
	//$num_filas = mssql_num_rows($res);
	$num_filas = count($res);
	
	if($num_filas == 0)
	   return;
	
	$contador = 1;   
	//while($fila = mssql_fetch_array($res)){	
	while($fila = $res->fetch(PDO::FETCH_NUM)){
		
		$elem = $nom_elem.$fila[0];
		
		$tabla .= "<td width='".$ancho_celda."%'><input type='checkbox' id='".$elem."' name='".$nom_elem."' value='".$fila[0]."'/>".$fila[1]."</td>";
		
		if($contador % $columnas == 0)
		   $tabla .= "</tr><tr>";
		
		$contador++;		
	}
	
	$tabla .= "</table>";

	return $tabla;
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

function fecha_dmY($fecha){
	
	/*
	 El parámetro $fecha tiene un valor del tipo "mm/dd/YYY"
	 y esta función transforma la fecha en una del tipo 'ddmmYY' 
	 */
	
	$tmp  = explode("/",$fecha);
	$dia  = $tmp[1];
	$mes  = $tmp[0]; 
	$anio = $tmp[2]; 
	
	return $dia."/".$mes."/".$anio;	
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


?>