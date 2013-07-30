<?php	
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');

	include('../../Conexion.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	
	$BUrl = "'../PHPs Compartidos/Ubicacion/BuscarUbicacion.php'";
	$BCont = "'ubicacion'";
	
	$Estante = $_GET['estante'];
	$sql = "SELECT Distinct(l.Fila),l.idLocalizacion FROM localizacion l, ubicacion u WHERE l.Estante='".$Estante."' AND l.idLocalizacion=u.idLocalizacion AND u.Disponibilidad='Vacante' ORDER BY(Fila)";
	$query = mysql_query($sql);     
	$Cnx->Desconectar();
	if(mysql_num_rows($query)>0){
		print '<td class="izqeditform">Fila&nbsp;&nbsp;</td>
			<td>
			<select name="fila" class="dereditform2" id="fila" onchange="Ubicacion('.$BUrl.','.$BCont.');">
				<option value="0"></option>';
		while($row = mysql_fetch_assoc($query)){
			print '<option value="'.$row['idLocalizacion'].'">'.$row['Fila'].'</option>'; 
		}
		print '</select>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	}
?>