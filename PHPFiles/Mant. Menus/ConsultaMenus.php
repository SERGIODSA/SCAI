<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../index.html');
	if($_SESSION['MantMenus']==0)
		header('Location: ../../menu.php');

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Mant. Menus/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaMenus();
?>