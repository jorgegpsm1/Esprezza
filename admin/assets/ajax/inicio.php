<?php @session_start();?>
<div class="container">
	<h1><?php if($_SESSION['ID'] == 1){ echo "Bienvenido Jorge";} else{ echo "Bienvenida Karla";} ?></h1>
</div>