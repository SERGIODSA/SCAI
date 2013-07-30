<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var carpetas = '.$_SESSION['ConsultaCarpetas'].'</script>');
	$f = time()-16200;
	$Hoy = "'".date("d-m-Y",$f)."'";
	$Url = "'Busqueda.php'";
	$Cont1 = "'buscar'";
	$Cont2 = "'resultados'";
?>
<script>
	if(carpetas=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<Title>Consulta - Carpetas | Distribuidora Universal Kia</Title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Consulta.css">
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Busqueda.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Consultas.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Procesos.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
</head>

<body>
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Consulta - Carpetas</span>
	</div>
	<div class="busqueda2"><form name="bus">
		<table border="0" align="center" width="100%">
		<tr>
			<td align="center"><span class="letra2">Seleccione:&nbsp;&nbsp;</span>
			<select name="disp" id="disp" class="cajas2" onchange="BusquedaCarpetas(<?php echo $Url; ?>,<?php echo $Cont1; ?>,<?php echo $Cont2; ?>,<?php echo $Hoy; ?>);">
				<option value="0">...</option>
				<option value="1">Carpetas disponibles</option>
				<option value="2">Carpetas en prestamo</option>
				<option value="3">Carpetas destruidas</option>
				<option value="4">Carpetas digitalizadas</option>
				<option value="5">Todas las carpetas</option>
			</select></td>
			<td id="buscar"></td>
		</tr>
		</table>
	</form></div>
<div class="resultados" id="resultados">
</div>
</body>
</html>