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
	
	if (get_magic_quotes_gpc()!=1)
		$Usu = addslashes($_POST['idusuario']);
	else
		$Usu = $_POST['idusuario'];
	$idUsuario = htmlentities($Usu);
	
	if (get_magic_quotes_gpc()!=1)
		$Con = addslashes($_POST['contrasena']);
	else
		$Con = $_POST['contrasena'];
	$Contrasena = htmlentities($Con);
	
	$IDDxD = $_POST['iddptodep'];
	$Cedula = $_POST['ced'];	

	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Admon Usuarios/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarUsuario($Nombre,$Apellido,$idUsuario,$Contrasena,$IDDxD,$Cedula);
?>