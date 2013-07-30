<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Localizaciones']==0)
		header('Location: ../menu.php');

	$Fila = $_POST['fila'];
	
	if (get_magic_quotes_gpc()!=1)
		$Est = addslashes($_POST['estante']);
	else
		$Est = $_POST['estante'];
	$Estante = htmlentities($Est);
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Localizaciones/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->GuardarLocalizacion($Fila,$Estante);
?>