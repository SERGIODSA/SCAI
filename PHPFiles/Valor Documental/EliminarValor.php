<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['ValorDoc']==0)
		header('Location: ../Menu.php');

	$idValor = $_POST['idvalor'];
	
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Valor Documental/Operaciones.php');
	$Operacion = new Operaciones();
	$Operacion->EliminarValor($idValor);
?>