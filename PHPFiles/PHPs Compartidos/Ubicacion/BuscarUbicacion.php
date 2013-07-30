<?php	
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
		
	include('../../Conexion.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	
	$idLocalizacion = $_GET['idloca'];
	$sql = "SELECT idUbicacion FROM ubicacion WHERE idLocalizacion='".$idLocalizacion."'AND Disponibilidad='Vacante' ORDER BY(idUbicacion)";
	$query = mysql_query($sql);     
	$Cnx->Desconectar();
	if(mysql_num_rows($query)>0){
		print '<td class="izqeditform">Ubicacion&nbsp;&nbsp;</td>
			<td>
			<select name="ubicaciones" class="dereditform2" id="ubicaciones">
				<option value="0"></option>';
		while($row = mysql_fetch_assoc($query)){
			print '<option value="'.$row['idUbicacion'].'">'.$row['idUbicacion'].'</option>'; 
		}
		print '</select>&nbsp;&nbsp;&nbsp;&nbsp;</td>';
	}
?>