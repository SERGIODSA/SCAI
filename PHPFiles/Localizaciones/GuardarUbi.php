<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');

	$idUbi = $_POST['idubi'];
	$idLoca = $_POST['idloca'];
	$Disp = $_POST['disp'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarUbicacion($idLoca,$idUbi,$Disp);
?>