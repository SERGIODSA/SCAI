<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var devolver = '.$_SESSION['DevolverPrestamo'].'</script>');
	$f = time()-16200;
	$Hoy = "'".date("d-m-Y",$f)."'";
	$Url = "'DevolverPrestamo.php'";
	$Cont = "'resultados'";
?>
<script>
	if(devolver=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Devolucion de prestamo | Distribuidora Universal Kia, C.A.</Title>
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/General.css">
	<link rel="stylesheet" type="text/css" href="../../CSSFiles/Procesos.css">
	<link type="text/css" href="../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.css" rel="Stylesheet" />
	<script type="text/javascript" src="../../JSFiles/General.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/Procesos.js" language="javascript"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="../../JSFiles/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<script>
		function foco(){
			document.getElementById('idcaja').focus();
		}
	</script>
</head>

<body onload="foco();">
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Procesos - Devolucion de Prestamo</span>
	</div>
	<div>
	<div>
		<form><br>
			<table align="center">
				<tr>
					<td><span class="letra2">ID Caja</span></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
						<input type="text" name="idcaja" size="10" maxlength="10" class="cajas2" id="idcaja" style="{text-align: center; font-size: 16px;}"/>
					</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>
						<input type="button" class="boton" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" onclick="DevolverPrestamo(<?php echo $Url; ?>,<?php echo $Cont; ?>,<?php echo $Hoy; ?>);"/>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="busqueda" id="resultados">
	</div>
</body>
</html>