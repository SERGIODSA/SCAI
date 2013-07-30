<?php 
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var registroTRD = '.$_SESSION['IngresarTRD'].'</script>');
	$f = time()-16200;
	$fecha = "'".date("d-m-Y",$f)."'";
	$url = "'CrearTRD.php'";
	$par = "''";
	$cont = "'resultados'";
?>
<script>
	if(registroTRD=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Ingreso de Tabla de Retencion Documental | Distribuidora Universal Kia, C.A.</Title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Procesos.css">
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Procesos.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
</head>

<body onload="CrearTRD(<?php echo($url); ?>,<?php echo($par); ?>,<?php echo($cont); ?>,<?php echo($fecha); ?>);">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Procesos - Ingresar TRD</span>
	</div>
	<div class="resultados" id="resultados">
	</div>
</body>
</html>
