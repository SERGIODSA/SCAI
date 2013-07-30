<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'BuscarTipo.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="atras">'.$Mensaje.'</span>';
		}
		function BuscarTipo(){
			// RUTA NUEVO TIPO
			$NUrl = "'AgregarTipo.php'";
			$NFoco = "'descripcion'";
			// RUTA MODIFICAR TIPO
			$MUrl = "'EditarTipo.php'";
			$MFoco = "'descripcion'";
			// RUTA ELIMINAR TIPO
			$EUrl = "'EliminarTipo.php'";
			// -------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = 'SELECT idTipoCarpeta,Descripcion FROM tipocarpeta';           
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			print '<div class="nuevo5">
				<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Nuevo Tipo" onclick="EnvioGet('.$NUrl.','.$this->Par.','.$this->Cont.','.$NFoco.');">
				</div>';			
			if(mysql_num_rows($query)>0){				
				print '<br><div class="tablati"><table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td width="60%"class="tituloformulario">Descripcion</td>
						<td width="40%" class="tituloformulario" colspan="2">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					$MPar = $EPar = "'idtipo=".$row['idTipoCarpeta']."'";
					print '<tr>
								<td class="cuerpoformulario">'.$row['Descripcion'].'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.','.$MFoco.');">Editar</span></td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarTipo('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar</span></td>
							</tr>';
				}
				print '</table></div>';	
			}
		}
		function AgregarTipo(){
			// RUTA NUEVO TIPO
			$NUrl = "'GuardarTipo.php'";
			// ---------------
			print '<br><br><br><div class="tablati2">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nuevo Tipo de Carpeta</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
					<td><input type="text" name="descripcion" class="dereditform" id="descripcion" maxlength="20" size="18"/></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
					<td align="center"><input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Guardar" onclick="GuardarTipo('.$NUrl.','.$this->Cont.');"></td>
				</tr>
			</table></div>';
		}
		function GuardarTipo($Descripcion){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			$sql = "INSERT INTO tipocarpeta (Usuario,Descripcion,Fecha_Creacion) VALUES ('".$_SESSION['usuario']."','".$Descripcion."','".$Fecha."')";
			$insertar = mysql_query($sql);
			$Cnx->Desconectar();	
			if($insertar){
				$this->BuscarTipo();
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EditarTipo($idTipo){
			// RUTA MODIFICAR TIPO
			$MUrl = "'ModificarTipo.php'";
			// -------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT Descripcion FROM tipocarpeta WHERE idTipoCarpeta='".$idTipo."'";
			$query = mysql_query($sql);  
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'Error: No se encontro el registro';
				$this->Atras($Mensaje);				
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					$MPar = "'idtipo=".$idTipo."'";
					print '<br><br><br><div class="tablati2">
						<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de tipo de carpeta</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
							<td><input type="text" name="descripcion" class="dereditform" id="descripcion" size="18" maxlength="20" value="'.$row['Descripcion'].'" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
							<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarTipo('.$MUrl.','.$MPar.','.$this->Cont.');"></td>
						</tr>
					</table></div>';
				}
			}
		}
		function ModificarTipo($idTipo,$Descripcion){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE tipocarpeta SET Descripcion='".$Descripcion."' WHERE idTipoCarpeta='".$idTipo."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar){
				$this->BuscarTipo();
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EliminarTipo($idTipo){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "DELETE FROM tipocarpeta WHERE idTipoCarpeta='".$idTipo."'";
			$eliminar = mysql_query($sql);
			$Cnx->Desconectar();	
			if($eliminar){
				$this->BuscarTipo();
			}
			else{
				$Mensaje = 'No se pudo eliminar el registro, ya que existen carpetas registradas de este tipo';
				$this->Atras($Mensaje);
			}
		}
	}
?>