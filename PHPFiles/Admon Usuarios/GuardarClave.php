<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['AdmonUser']==0)
		header('Location: ../Menu.php');

	$idUsuario = $_POST['idusuario'];
	if (get_magic_quotes_gpc()!=1)
		$Con = addslashes($_POST['contrasena']);
	else
		$Con = $_POST['contrasena'];
	$Contrasena = htmlentities($Con);
		
	include($_SERVER['DOCUMENT_ROOT'].'/SCAI/PHPFiles/Admon Usuarios/Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->GuardarClave($idUsuario,$Contrasena);
?>