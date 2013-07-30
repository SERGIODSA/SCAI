<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var desincorporar = '.$_SESSION['Desincorporar'].'</script>');
	$url1 = "'BuscarDes.php'";
	$url2 = "'BuscarDes2.php'";
	$cont1 = "'resultados'";
	$cont2 = "'buscar'";
?>
<script>
	if(desincorporar=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<Title>Desincorporar | Distribuidora Universal Kia</Title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Procesos.css">
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Busqueda.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Procesos.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
</head>

<body>
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Procesos - Desincorporar</span>
	</div>
	<div>
		<form><br>
			<table align="center">
				<tr>
					<td><span class="letra2">Seleccione:</span></td>
					<td>&nbsp;&nbsp;</td>
					<td>						
						<select name="atributo" id="atributo" class="cajas2" onchange="BuscarDes(<?php echo($url1); ?>,<?php echo($url2); ?>,<?php echo($cont1); ?>,<?php echo($cont2); ?>);">
							<option value="0">...</option>
							<option value="1">Carpetas expiradas</option>
							<option value="2">Carpetas proximas a expirar</option>
							<option value="3">Carpetas vigentes</option>
						</select>
					</td>
					<td>&nbsp;&nbsp;</td>
					<td id="buscar">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="busqueda" id="resultados">
	</div>
</body>
</html>