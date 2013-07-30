<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');

	$idLoca = $_POST['idloca'];
	$Fila = $_POST['fila'];
	$Estante = $_POST['estante'];
	$Dpto = $_POST['dpto'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarLocalizacion($idLoca,$Dpto,$Fila,$Estante);
?>