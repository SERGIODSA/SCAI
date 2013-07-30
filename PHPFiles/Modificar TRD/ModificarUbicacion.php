<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ModificarTRD']==0)
		header('Location: ../Menu.php');

	$idCaja = $_POST['idCaja'];
	$idUbi = $_POST['idubicacion'];
	$Ubiactual = $_POST['ubiactual'];
	$Fechatran = $_POST['fechatran'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Modificar TRD/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->ModificarUbicacion($idCaja,$idUbi,$Ubiactual,$Fechatran);
?>