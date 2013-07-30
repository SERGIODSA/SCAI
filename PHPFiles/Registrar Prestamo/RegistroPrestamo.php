<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	echo('<script>var prestamo = '.$_SESSION['RegistroPrestamo'].'</script>');
	include('../Conexion.php');
	include('../PHPs Compartidos/Valor/CargarValores.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	$Valor = new Valor;
	$f = time()-16200;
	$Hoy = "'".date("Y-m-d",$f)."'";
?>
<script>
	if(prestamo=='0'){
		alert('No tiene permisos para acceder a este menu');
		location.href = "../Menu.php";
	}
</script>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Registro de Prestamo | Distribuidora Universal Kia, C.A.</Title>
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
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Procesos - Registro de Prestamo</span>
	</div>
	<div class="busqueda">
		<form name="bus"><br>
		<table width="82%" align="center"><tr>
		<td align="center"><span class="letra2">Busqueda por:</span></td>
		<td><div class="bordebusqueda">
			<table cellpadding="4">
				<tr>
					<td align="right"><input type="checkbox" name="busqueda2" value="idcarpeta" onclick="PBCP();" /></td>
					<td>ID Carpeta</td>
					<td id="op2"><input type="text" disabled="disabled" name="idcarpeta" size="8" maxlength="8" class="cajas2" id="idcarpeta"/></td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="busqueda3" value="nserie" onclick="BNS();"/></td>
					<td>Nº Serie</td>
					<td id="op3">
						<input type="text" disabled="disabled" name="serieinf" size="6" maxlength="8" class="cajas2" id="serieinf"/>
						&nbsp;-&nbsp;
						<input type="text" disabled="disabled" name="seriesup" size="6" maxlength="8" class="cajas2" id="seriesup"/>
					</td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="busqueda4" value="serie" onclick="BSD();"/></td>
					<td>Serie Doc.</td>
					<td id="op4"><input type="text" disabled="disabled" name="serie" size="24" maxlength="30" class="cajas2" id="serie"/></td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="busqueda6" value="fecha" onclick="BFI(<?php echo $Hoy; ?>);" /></td>
					<td>Fecha Inicial&nbsp;&nbsp;&nbsp;</td>
					<td id="op6"><input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>
					<td align="right"><input type="checkbox" name="busqueda7" value="fecha" onclick="BFF(<?php echo $Hoy; ?>);" /></td>
					<td>Fecha Final&nbsp;&nbsp;&nbsp;</td>
					<td id="op7"><input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>	
					<td align="right"><input type="checkbox" name="busqueda1" value="idcaja" onclick="PBCJ();"/></td>
					<td>ID Caja</td>
					<td id="op1"><input type="text" disabled="disabled" name="idcaja" size="8" maxlength="8" class="cajas2" id="idcaja"/></td>
				</tr>
				<tr>	
					<td align="right"><input type="checkbox" name="busqueda5" value="valor" onclick="BVD();" /></td>
					<td>Valor Doc.</td>
					<td id="op5">
					<?php
						$Valor->DesabValores('cajas2');
						$Cnx->Desconectar();
					?>
					</td>
				</tr>
			</table></div>
		</td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="BusquedaTRD('Prestamo');"></td>
		</tr></table>
		</form>
	</div>
	<div class="resultados2" id="resultados">
	</div>
</body>
</html>