<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var admonuser = '.$_SESSION['AdmonUser'].'</script>');
	$Url = "'ConsultaUsuarios.php'";
	$Par = "''";
	$Cont = "'resultados'";
?>
<script>
	if(admonuser=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Administracion de usuarios | Distribuidora Universal Kia C.A.</title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css" />
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Seguridad.css" />
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Seguridad.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script>
		function foco(){
			document.getElementById('nombre').focus();
		}
	</script>
</head>

<body onload="EnvioGet(<?php echo $Url; ?>,<?php echo $Par; ?>,<?php echo $Cont; ?>);">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Seguridad - Administracion de usuarios</span>
	</div>
	<div class="resultados" id="resultados"></div>
</body>
</html>