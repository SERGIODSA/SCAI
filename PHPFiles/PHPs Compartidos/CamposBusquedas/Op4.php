<?php
	$v = $_GET['v'];
	if($v=='true')
		print '<input type="text" name="serie" size="24" maxlength="30" class="cajas2" id="serie"/>';
	else
		print '<input type="text" disabled="disabled" name="serie" size="24" maxlength="30" class="cajas2" id="serie"/>';
?>