<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Roles']==0)
		header('Location: ../menu.php');

		
	if (get_magic_quotes_gpc()!=1)
		$R = addslashes($_POST['rol']);
	else
		$R = $_POST['rol'];
	$Rol = htmlentities($R);
	
	$IDM = $_POST['idmenus'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Definir Roles/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarRol($Rol,$IDM);
?>