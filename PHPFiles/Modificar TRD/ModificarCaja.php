<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');

	$idCaja = $_POST['idCaja'];
	list($Valor,$Anos) = explode('-',$_POST['valor']);
	if($_POST['capacidad']=='true')
		$Capacidad = '1';
	else
		$Capacidad = '0';
	$idDptoDep = $_POST['iddptodep'];
	$idDpto = $_POST['iddpto'];
	$ARet = $_POST['aret'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarCaja($idCaja,$Valor,$Anos,$Capacidad,$idDptoDep,$idDpto,$ARet);
?>