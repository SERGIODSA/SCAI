<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var local = '.$_SESSION['ConsultaLocal'].'</script>');
	$Url = "'Busqueda.php'";
	$Par1 = "'estatus=1'";
	$Par2 = "'estatus=0'";
	$Cont = "'resultados'";
?>
<script>
	if(local=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<Title>Consulta - Localizaciones | Distribuidora Universal Kia</Title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Consulta.css">
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Consultas.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
</head>

<body>
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Consulta - Localizaciones</span>
	</div>
<div>
	<form><br>
		<table align="center">
			<tr>
				<td><span class="letra2">Localizaciones:</span></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>						
					<input type="button" class="boton" value="Vacante" onclick="EnvioGet(<?php echo $Url; ?>,<?php echo $Par2; ?>,<?php echo $Cont; ?>);"/>
				</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>
					<input type="button" class="boton" value="Ocupado" onclick="EnvioGet(<?php echo $Url; ?>,<?php echo $Par1; ?>,<?php echo $Cont; ?>);"/>
				</td>
			</tr>
		</table>
	</form>
</div>
<div class="resultados" id="resultados"></div>
</body>
</html>