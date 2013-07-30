<?php
	session_start();
	if(!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ValorDoc']==0)
		header('Location: ../Menu.php');
		
	if (get_magic_quotes_gpc()!=1)
		$Desc = addslashes($_POST['desc']);
	else
		$Desc = $_POST['desc'];
	$Descripcion = htmlentities($Desc);
		
	$Retencion = $_POST['ret'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Valor Documental/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->GuardarValor($Descripcion,$Retencion);
?>