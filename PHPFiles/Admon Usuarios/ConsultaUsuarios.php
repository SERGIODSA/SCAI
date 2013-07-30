<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['AdmonUser']==0)
		header('Location: ../Menu.php');

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Admon Usuarios/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaUsuarios();
?>