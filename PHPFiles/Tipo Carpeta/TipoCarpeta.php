<?php 
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var tipo = '.$_SESSION['TipoCarpeta'].'</script>');
	$url = "'BuscarTipo.php'";
	$par = "''";
	$cont = "'resultados'";
?>
<script>
	if(tipo=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Tipo de carpetas | Distribuidora Universal Kia, C.A.</title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Mantenimiento.css">
	<script src="../../JSFiles/General.js" language="javascript"></script>
	<script src="../../JSFiles/Mantenimiento.js" language="javascript"></script>
</head>

<body onload="EnvioGet(<?php echo($url); ?>,<?php echo($par); ?>,<?php echo($cont); ?>);">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Mantenimiento - Tipo de carpetas</span>
	</div>
	<div class="resultados" id="resultados"></div>
</body>
</html>