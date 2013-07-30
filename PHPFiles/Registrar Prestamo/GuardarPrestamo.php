<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['RegistroPrestamo']==0)
		header('Location: ../menu.php');

	$Ubic = $_POST['ubic'];
	$Estante = $_POST['estante'];
	$Fila = $_POST['fila'];
	$Fprestamo = $_POST['fecha2'];
	$Festimada = $_POST['fecha3'];
	$idCaja = $_POST['idcaja'];
	
	if (get_magic_quotes_gpc()!=1)
		$Obs = addslashes($_POST['observacion']);
	else
		$Obs = $_POST['serie'];
	$Observacion = htmlentities($Obs);
	
	if (get_magic_quotes_gpc()!=1)
		$Rec = addslashes($_POST['responsable']);
	else
		$Rec = $_POST['responsable'];
	$Receptor = htmlentities($Rec);
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Registrar Prestamo/Operaciones.php');
	$Operacion = new Operaciones;	
	$Operacion->GuardarPrestamo($Ubic,$Estante,$Fila,$Fprestamo,$Festimada,$idCaja,$Observacion,$Receptor);	
?>