<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaCarpetas']==0)
		header('Location: ../Menu.php');
	
	$Dpto = null;	
	$Subserie = null;
	$idCarpeta = null;
	$SerieI = null;
	$SerieS = null;
	$Serie = null;
	$FechaI = null;
	$FechaF = null;
	$FechaD = null;

	if(!empty($_GET['iddpto']))
		$Dpto = $_GET['iddpto'];
	if(!empty($_GET['subserie'])){
		if (get_magic_quotes_gpc()!=1)
			$Sub = addslashes($_GET['subserie']);
		else
			$Sub = $_GET['subserie'];
		$Subserie = htmlentities($Sub);
	}
	if(!empty($_GET['idcarpeta']))
		$idCarpeta = $_GET['idcarpeta'];
	if(!empty($_GET['serieinf']))
		$SerieI = $_GET['serieinf'];
	if(!empty($_GET['seriesup']))
		$SerieS = $_GET['seriesup'];
	if(!empty($_GET['serie'])){
		if (get_magic_quotes_gpc()!=1)
			$Ser = addslashes($_GET['serie']);
		else
			$Ser = $_GET['serie'];
		$Serie = htmlentities($Ser);
	}
	if(!empty($_GET['fechaf']))
		$FechaF = $_GET['fechaf'];
	if(!empty($_GET['fechad']))
		$FechaD = $_GET['fechad'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Carpetas/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaDestruidas($Dpto,$Subserie,$idCarpeta,$SerieI,$SerieS,$Serie,$FechaI,$FechaF,$FechaD);
?>