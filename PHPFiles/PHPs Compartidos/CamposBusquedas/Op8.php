<?php
	$v = $_GET['v'];
	if($v=='true'){
		print '<input type="text" name="subserie" size="24" maxlength="100" class="cajas2" id="subserie"/>';
	}
	else{
		print '<input type="text" disabled="disabled" name="subserie" size="24" maxlength="100" class="cajas2" id="subserie"/>';
	}
?>