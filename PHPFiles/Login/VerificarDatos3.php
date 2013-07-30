<?php
	list($idDptoDep,$Depa) = explode('-',$_POST['depe']);
	$Usuario = $_POST['usuario'];
	$Clave = $_POST['clave'];
	
	include('Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->VerificarDatos3($Usuario,$Clave,$idDptoDep,$Depa);
?>