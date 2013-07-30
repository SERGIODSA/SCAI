<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');

	$idLoca = $_POST['idloca'];
	$Fila = $_POST['fila'];
	$Estante = $_POST['estante'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ComprobarLocalizacion2($idLoca,$Fila,$Estante);
?>