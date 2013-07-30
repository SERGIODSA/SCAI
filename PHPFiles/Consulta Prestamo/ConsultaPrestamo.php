<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var prest = '.$_SESSION['ConsultaPrestamo'].'</script>');
	$f = time()-16200;
	$Hoy = "'".date("d-m-Y",$f)."'";
	$Url = "'Busqueda.php'";
	$Cont1 = "'opcion'";
	$Cont2 = "'resultados'";
?>
<script>
	if(prest=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = " ../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<Title>Consulta - Prestamo | Distribuidora Universal Kia</Title>
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
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Consulta - Prestamo</span>
	</div>
<div>
	<form><br>
		<table align="center">
			<tr>
				<td><span class="letra2">Busqueda Por:</span></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>						
					<select name="atributo" class="cajas2" id="atributo" onchange="BusquedaPrestamo(<?php echo $Url; ?>,<?php echo $Cont1; ?>,<?php echo $Cont2; ?>,<?php echo $Hoy; ?>);">
						<option value="0">...</option>
						<option value="1">Usuario</option>
						<option value="2">Fecha de entrega real</option>
						<option value="3">Departamento</option>
						<option value="4">Caja</option>
						<option value="5">Estante</option>
						<option value="6">Fecha de prestamo</option>
					</select>
				</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td id="opcion"></td>
			</tr>
		</table>
	</form>
</div>
<div class="resultados" id="resultados">
</div>
</body>
</html>