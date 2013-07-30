<?php
	include('../../Conexion.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	$sql = "SELECT COUNT(Disponibilidad) AS num FROM ubicacion WHERE Disponibilidad='Vacante'";
	$result = mysql_query($sql);
	$Cnx->Desconectar();
	if ($result) {
		$row = mysql_fetch_object($result);
		$data['num'] = $row->num;
	}
	else
		$data['num'] = 0;
	echo json_encode($data);
?>