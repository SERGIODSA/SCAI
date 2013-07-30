<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaCarpetas']==0)
		header('Location: ../Menu.php');
	
	$idDpto = null;	
	$Subserie = null;
	$idCaja = null;
	$idCarpeta = null;
	$SerieI = null;
	$SerieS = null;
	$Serie = null;
	$Valor = null;
	$FechaI = null;
	$FechaF = null;
	
	$Disp = $_GET['disp'];

	if(!empty($_GET['iddpto']))
		$idDpto = $_GET['iddpto'];
	if(!empty($_GET['subserie']))
		$Subserie = $_GET['subserie'];
	if(!empty($_GET['idcaja']))
		$idCaja = $_GET['idcaja'];
	if(!empty($_GET['idcarpeta']))
		$idCarpeta = $_GET['idcarpeta'];
	if(!empty($_GET['serieinf']))
		$SerieI = $_GET['serieinf'];
	if(!empty($_GET['seriesup']))
		$SerieS = $_GET['seriesup'];
	if(!empty($_GET['serie'])){
		if (get_magic_quotes_gpc()!=1)
			$Serie = addslashes($_GET['serie']);
		else
			$Serie = $_GET['serie'];
		$Serie = htmlentities($Serie);
	}
	if(!empty($_GET['valor']))
		$Valor = $_GET['valor'];
	if(!empty($_GET['fechai']))
		$FechaI = $_GET['fechai'];	
	if(!empty($_GET['fechaf']))
		$FechaF = $_GET['fechaf'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Carpetas/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ConsultaDisponibles($Disp,$idDpto,$Subserie,$idCaja,$idCarpeta,$SerieI,$SerieS,$Serie,$Valor,$FechaI,$FechaF);
?>