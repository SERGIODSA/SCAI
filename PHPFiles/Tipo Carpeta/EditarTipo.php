<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['TipoCarpeta']==0)
		header('Location: ../Menu.php');

	$idTipo = $_GET['idtipo'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Tipo Carpeta/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EditarTipo($idTipo);
?>