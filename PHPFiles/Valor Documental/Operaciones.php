<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'BuscarValor.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="atras">'.$Mensaje.'</span>';
		}
		function BuscarValores(){
			// RUTA NUEVO VALOR
			$AUrl = "'AgregarValor.php'";
			$AFoco = "'descripcion'";
			// RUTA MODIFICAR VALOR
			$MUrl = "'EditarValor.php'";
			$MFoco = "'descripcion'";
			// RUTA ELIMINAR VALOR
			$EUrl = "'EliminarValor.php'";
			// --------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = 'SELECT idValorDoc,Descripcion,Anos_Ret FROM valordoc';           
			$query = mysql_query($sql); 
			$Cnx->Desconectar();				
			print '<div class="nuevo4">
				<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Nuevo Valor" onclick="EnvioGet('.$AUrl.','.$this->Par.','.$this->Cont.','.$AFoco.');">
				</div>';			
			if(mysql_num_rows($query)>0){			
				print '<br><div class="tablaval2">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td width="37%"class="tituloformulario">Descripcion</td>
						<td width="30%" class="tituloformulario">Retencion (a&ntilde;os)</td>
						<td width="33%" class="tituloformulario" colspan="2">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					$EPar = $MPar = "'idvalor=".$row['idValorDoc']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['Descripcion'].'</td>
							<td class="cuerpoformulario">'.$row['Anos_Ret'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.','.$MFoco.');">Editar</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarValor('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar</span></td>
						</tr>';
				}
				print '</table></div>';	
			}
		}
		function AgregarValor(){
			// RUTA GUARDAR VALOR
			$NUrl = "'GuardarValor.php'";
			// ------------------
			print '<br><br><br><div class="tablaval">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nuevo Valor</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
					<td><input type="text" name="descripcion" class="dereditform" id="descripcion" maxlength="15" size="15"/></td>
				</tr>
				<tr>
					<td class="izqeditform">Tiempo de retencion (a&ntilde;os)&nbsp;&nbsp;</td>
					<td><input type="text" name="retencion" class="dereditform" id="retencion" size="15" maxlength="2"/></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Guardar" onclick="GuardarValor('.$NUrl.','.$this->Cont.');"></td>
				</tr>
			</table></div>';
		}
		function GuardarValor($Descripcion,$Retencion){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			$sql = "INSERT INTO valordoc (Usuario,Descripcion,Anos_Ret,Fecha_Creacion) VALUES ('".$_SESSION['usuario']."','".$Descripcion."','".$Retencion."','".$Fecha."')";
			$insertar = mysql_query($sql);
			$Cnx->Desconectar();
			if($insertar){
				$this->BuscarValores();
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EditarValor($idValor){
			// RUTA MODIFICAR VALOR
			$MUrl = "'ModificarValor.php'";
			// --------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT Descripcion,Anos_Ret FROM valordoc WHERE idValorDoc='".$idValor."'";
			$query = mysql_query($sql);   
			$Cnx->Desconectar();					
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'Error: No se encontro el registro';
				$this->Atras($Mensaje);	
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					print '<br><br><br><div class="tablaval">
						<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de valor documental</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
							<td><input type="text" name="descripcion" class="dereditform" id="descripcion" size="15" maxlength="15" value="'.$row['Descripcion'].'" /></td>
						</tr>
						<tr>
							<td class="izqeditform">Tiempo de retencion (a&ntilde;os)&nbsp;&nbsp;</td>
							<td><input type="text" name="retencion" class="dereditform" id="retencion" size="15" maxlength="2" value="'.$row['Anos_Ret'].'" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" colspan="2"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarValor('.$MUrl.','.$idValor.','.$this->Cont.');"></td>
						</tr>
					</table></div>';
				}
			}
		}
		function ModificarValor($idValor,$Descripcion,$Retencion){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE valordoc SET Descripcion='".$Descripcion."',Anos_Ret='".$Retencion."' WHERE idValorDoc='".$idValor."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();	
			if($actualizar){
				$this->BuscarValores();
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EliminarValor($idValor){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "DELETE FROM valordoc WHERE idValorDoc='".$idValor."'";
			$eliminar = mysql_query($sql);
			$Cnx->Desconectar();	
			if($eliminar)
				$this->BuscarValores();
			else{
				$Mensaje = 'No se pudo eliminar el registro, ya que existen cajas asociadas a este valor';
				$this->Atras($Mensaje);
			}
		}
	}
?>