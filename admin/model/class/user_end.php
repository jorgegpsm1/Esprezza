<?php
	@session_start();
	$Response = array();
  $Response['Success'] = false;
	setcookie('__ugate', null, time()-1000, '/');
  setcookie('__uanchor', null, time()-1000, '/');
  setcookie('__ukey', null, time()-1000, '/');
  session_destroy();
  $Response['Success'] = true;
  header('Content-Type: application/json');
  echo json_encode($Response);
?>