<?php
	$v = $_GET['v'];
	if($v=='true'){
		print '<input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" readonly/>';
	}
	else{
		print '<input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" disabled="disabled" readonly/>';
	}
?>