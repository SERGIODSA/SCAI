<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Departamentos']==0)
		header('Location: ../Menu.php');

	$idDep = $_GET['iddep'];
	$idDpto = $_GET['iddpto'];
	if(get_magic_quotes_gpc()!=1)
		$Desc = addslashes($_GET['desc']);
	else
		$Desc = $_GET['desc'];
	$Descripcion = htmlentities($Desc);
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Departamento/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarDependencia($idDpto,$idDep,$Descripcion);
?>