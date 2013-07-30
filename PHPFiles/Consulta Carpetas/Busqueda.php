<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ConsultaCarpetas']==0)
		header('Location: ../Menu.php');
	
	$Opcion = $_GET['disp'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Consulta Carpetas/Operaciones.php');
	$Operacion = new Operaciones;
	
	switch($Opcion){
		case 1:
			$Parametro = "'CajaDisp'";
			$Operacion->CarpetasDisponibles($Parametro);
			break;
		case 2:
			$Parametro = "'CajaDisp'";
			$Operacion->CarpetasDisponibles($Parametro);
			break;
		case 3:
			$Parametro = "'CajaDest'";
			$Operacion->CarpetasDestruidas($Parametro);
			break;
		case 4:
			$Parametro = "'CajaDig'";
			$Operacion->CarpetasDestruidas($Parametro);
			break;
		case 5:
			$Operacion->TodasLasCarpetas();
			break;
	}	
?>