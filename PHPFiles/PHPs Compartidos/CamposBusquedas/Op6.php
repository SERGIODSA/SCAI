<?php
	$v = $_GET['v'];
	if($v=='true'){
		print '<input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" readonly/>';
	}
	else{
		print '<input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" disabled="disabled" readonly/>';
	}
?>