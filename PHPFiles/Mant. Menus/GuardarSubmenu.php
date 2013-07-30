<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['MantMenus']==0)
		header('Location: ../menu.php');

	$Menu = $_POST['Menu']; 

	if (get_magic_quotes_gpc()!=1)
		$Sub = addslashes($_POST['submenu']);
	else
		$Sub = $_POST['submenu'];
	$Submenu = htmlentities($Sub);
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Mant. Menus/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarSubmenu($Menu,$Submenu);
?>