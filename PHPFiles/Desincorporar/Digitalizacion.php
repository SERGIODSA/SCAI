<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');
		
	$idCarpeta = $_GET['idcarpeta'];
	$f = time()-16200;
	$Fcre = "'".date("Y-m-d",$f)."'";
	if(!empty($_GET['p']))
		$p = $_GET['p'];
	else
		$p = 0;
	echo('<script type="text/javascript">var p='.$p.'; var f2='.$Fcre.';</script>');

	ini_set('post_max_size','50M');
	ini_set('upload_max_filesize','30M');
	ini_set('memory_limit','128M');
	ini_set('max_execution_time',120);
	ini_set('max_input_time',120);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<Title>Digitalizacion | Distribuidora Universal Kia</Title>
	<link rel="stylesheet" href="../../CSSFiles/General.css" type="text/css">
	<link rel="stylesheet" href="../../CSSFiles/Procesos.css" type="text/css">
	<script src="../../JSFiles/General.js" language="javascript"></script>
	<script src="../../JSFiles/Procesos.js" language="javascript"></script>
	<style>
		input[type='file'] {
			width: 322px;
		}
	</style>
</head>

<body>
	<div class="titulo">
		&nbsp;&nbsp;<input type="image" src="../../Imagenes/Inicio.png" style="vertical-align: middle;" onclick="cambio_pagina('../Menu.php');"><span style="vertical-align: middle;"> - Procesos - Desincorporar</span>
	</div>
	<br><br><br>
	<div class="formcaja3" class="formcaja"><form name="digital" enctype="multipart/form-data" method="post" action="GuardarDigital.php">
		<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
			<tr>
				<td colspan="2" class="titulobold">Digitalizacion</td>
			</tr>
			<tr>
				<td colspan="2"><br></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="hidden" name="idcarpeta" value="<?php echo($idCarpeta);?>"/>
				</td>
			</tr>
			<tr>
				<td class="izqeditform" align="right" width="10%">Nombre&nbsp;&nbsp;</td>
				<td>
					<input type="text" name="nombre" id="nombre" class="cajas" size="43"/>
				</td>
			</tr>
			<tr>
				<td colspan="2"><br></td>
			</tr>
			<tr>
				<td class="izqeditform" align="right" width="25%">Archivo&nbsp;&nbsp;</td>
				<td>
					<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
					<input type="file" name="archivo" id="archivo" size="30"/>
				</td>
			</tr>
			<tr><td colspan="2" class="nota">&nbsp;&nbsp;&nbsp;(Nota: Cargar solo archivos JPG, PDF, RAR o ZIP. Tama&ntilde;o maximo de 2MB)</td></tr>
			<tr>
				<td colspan="2"><br></td>
			</tr>
			<tr>
				<td align="center" colspan="2">
				<input type="button" class="boton" name="finalizar" id="finalizar" value="Finalizar" onclick="cambio_pagina('Desincorporar.php');"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" class="boton" name="guardar" id="guardar" value="Guardar"/>
				</td>
			</tr>
		</table>
	</form></div>
	<br><br>
</body>
<script>
	if(p=='1')
		alert('Solo se pueden cargar archivos de tipo jpg o pdf');
	if(p=='2')
		alert('Registro exitoso');
	if(p=='3')
		alert('Error de registro');
	if(p=='4')
		alert('El nombre del archivo ya existe');
	if(p=='5')
		alert('El archivo que trata de cargar es demasiado grande');
</script>
</html>