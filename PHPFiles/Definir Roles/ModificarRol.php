<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Roles']==0)
		header('Location: ../menu.php');

	$idRol = $_POST['idrol'];
	
	if (get_magic_quotes_gpc()!=1)
		$R = addslashes($_POST['rol']);
	else
		$R = $_POST['rol'];
	$Rol = htmlentities($R);
	
	$IDMS = $_POST['idmenus'];
	$IDM = $_POST['idmenu'];	
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Definir Roles/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ModificarRol($idRol,$Rol,$IDMS,$IDM);
?>