<?php
	$v = $_GET['v'];
	if($v=='true')
		print '<input type="text" name="serieinf" size="6" maxlength="8" class="cajas2" id="serieinf"/>
			&nbsp;-&nbsp;
			<input type="text" name="seriesup" size="6" maxlength="8" class="cajas2" id="seriesup"/>';
	else
		print '<input type="text" disabled="disabled" name="serieinf" size="6" maxlength="8" class="cajas2" id="serieinf"/>
			&nbsp;-&nbsp;
			<input type="text" disabled="disabled" name="seriesup" size="6" maxlength="8" class="cajas2" id="seriesup"/>';
?>