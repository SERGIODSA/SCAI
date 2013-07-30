<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');

	$idUbi = $_GET['idubi'];
	$idLocal = $_GET['idloca'];
	$Disp = array("1"=>"Vacante","2"=>"Ocupado");

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EditarUbicacion($idLocal,$idUbi,$Disp);
?>