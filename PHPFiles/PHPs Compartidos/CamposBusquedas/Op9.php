<?php
	include('../../Conexion.php');
	$Cnx = new Conexion;
	$Cnx->Conectar();
	
	$v = $_GET['v'];
	if($v=='true'){
		print '<select name="departamento" class="cajas2" id="departamento">';
		$sql = "SELECT idDpto,Descripcion FROM departamento";
		$query = mysql_query($sql);     
		if(mysql_num_rows($query)<=0){
			print '<option value="0">...</option>';	
		}
		else{
			print '<option value="0">...</option>';	
			while($row = mysql_fetch_assoc($query)){
				print '<option value="'.$row['idDpto'].'">'.$row['Descripcion'].'</option>';
			}
		}
		print '</select>';
	}
	else{
		print '<select name="departamento" class="cajas2" id="departamento" disabled="disabled">';
		$sql = "SELECT idDpto,Descripcion FROM departamento";
		$query = mysql_query($sql);     
		if(mysql_num_rows($query)<=0){
			print '<option value="0">...</option>';	
		}
		else{
			print '<option value="0">...</option>';	
			while($row = mysql_fetch_assoc($query)){
				print '<option value="'.$row['idDpto'].'">'.$row['Descripcion'].'</option>';
			}
		}
		print '</select>';
	}
	$Cnx->Desconectar();
?>