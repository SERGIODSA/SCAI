<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var asignarrol = '.$_SESSION['AsignarRol'].'</script>');
	$Url = "'ConsultaUsuariosxRol.php'";
	$Par = "''";
	$Cont = "'resultados'";
?>
<script>
	if(asignarrol=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Asignacion de roles | Distribuidora Universal Kia C.A.</title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css" />
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Seguridad.css" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Seguridad.js" language="javascript"></script>
</head>

<body onload="EnvioGet(<?php echo $Url; ?>,<?php echo $Par; ?>,<?php echo $Cont; ?>);">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Seguridad - Asignacion de roles</span>
	</div>
	<div class="resultados" id="resultados"></div>
</body>