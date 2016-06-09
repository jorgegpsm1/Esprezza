<?php @session_start(); ?>
<div id="content" class="content">
	<h1 class="page-header">Administracion de empleados</h1>
	<div class="row">
			<div id="crear_usuario" class="col-md-6 ui-sortable"></div>
			<div id="tabla_usuario" class="col-md-6 ui-sortable"></div>
	</div>
</div>
<script>
	function cargarContenido(div,URL){
        Pace.restart(); 
        $(div).load(URL);
    }
  (function(){
  	cargarContenido(('#crear_usuario'),'<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/ajax/department/1/crear_usuarios.php'); ?>');
  	cargarContenido(('#tabla_usuario'),'<?php echo ($_SESSION['BASE_DIR_FRONTEND'].'/assets/ajax/department/1/tabla_usaurios.php'); ?>');
  })();
</script>