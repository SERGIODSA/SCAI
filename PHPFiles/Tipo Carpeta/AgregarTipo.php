<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['TipoCarpeta']==0)
		header('Location: ../Menu.php');

	include('Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->AgregarTipo();
?>