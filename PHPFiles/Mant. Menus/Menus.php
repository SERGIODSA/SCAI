<?php 
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var seguridad = '.$_SESSION['MantMenus'].'</script>');
	$Url = "'ConsultaMenus.php'";
	$Par = "''";
	$Cont = "'resultados'";
?>
<script>
	if(seguridad=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Menus | Distribuidora Universal Kia C.A.</title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css" />
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Seguridad.css" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Seguridad.js" language="javascript"></script>
</head>

<body onload="EnvioGet(<?php echo $Url; ?>,<?php echo $Par; ?>,<?php echo $Cont; ?>);">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Seguridad - Menus</span>
	</div>
	<div class="resultados" id="resultados"></div>
</body>
</html>