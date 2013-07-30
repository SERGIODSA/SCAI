<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['TipoCarpeta']==0)
		header('Location: ../Menu.php');
	
	if (get_magic_quotes_gpc()!=1)
		$Desc = addslashes($_POST['desc']);
	else
		$Desc = $_POST['desc'];
	$Descripcion = htmlentities($Desc);
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Tipo Carpeta/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->GuardarTipo($Descripcion);
?>