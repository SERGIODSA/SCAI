<?php
	include_once('../../Conexion.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	include_once('../../PHPs Compartidos/Valor/CargarValores.php');
	$Valor = new Valor;
	$val = $_GET['v'];
	if($val=='true')
		$Valor->CargaValores('cajas2');
	else
		$Valor->DesabValores('cajas2');
	$Cnx->Desconectar();
?>