<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');
		
	$idLoca = $_GET['idloca'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EditarLocalizaciones($idLoca);
?>