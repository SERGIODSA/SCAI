<?php
	$v = $_GET['v'];
	if($v=='true')
		print '<input type="text" name="idcaja" size="8" maxlength="8" class="cajas2" id="idcaja"/>';
	else
		print '<input type="text" disabled="disabled" name="idcaja" size="8" maxlength="8" class="cajas2" id="idcaja"/>';
?>