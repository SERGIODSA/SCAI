<?php
	$v = $_GET['v'];
	if($v=='true')
		print '<input type="text" name="idcarpeta" size="8" maxlength="8" class="cajas2" id="idcarpeta"/>';
	else
		print '<input type="text" disabled="disabled" name="idcarpeta" size="8" maxlength="8" class="cajas2" id="idcarpeta"/>';
?>