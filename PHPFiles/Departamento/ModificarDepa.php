<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Departamentos']==0)
		header('Location: ../Menu.php');
	
	$idDpto = $_GET['iddpto'];
	
	if (get_magic_quotes_gpc()!=1)
		$Des = addslashes($_GET['desc']);
	else
		$Des = $_GET['desc'];
	$Descripcion = htmlentities($Des);
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Departamento/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarDepartamento($idDpto,$Descripcion);
?>