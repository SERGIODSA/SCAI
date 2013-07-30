<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['AdmonUser']==0)
		header('Location: ../Menu.php');

	if (get_magic_quotes_gpc()!=1)
		$Nom = addslashes($_POST['nombre']);
	else
		$Nom = $_POST['nombre'];
	$Nombre = htmlentities($Nom);
	
	if (get_magic_quotes_gpc()!=1)
		$Ape = addslashes($_POST['apellido']);
	else
		$Ape = $_POST['apellido'];
	$Apellido = htmlentities($Ape);
	
	$idUsuario = $_POST['idusuario'];
	$Cedula = $_POST['ced'];
	$IDDxD = $_POST['iddptodep'];

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Admon Usuarios/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->ModificarUsuario($Nombre,$Apellido,$idUsuario,$Cedula,$IDDxD);
?>