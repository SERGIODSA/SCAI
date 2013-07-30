<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Departamentos']==0)
		header('Location: ../Menu.php');
	
	$idDpto = $_GET['iddpto'];
	$Desc = $_GET['desc'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Departamento/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->CrearDependencia($idDpto,$Desc);
?>