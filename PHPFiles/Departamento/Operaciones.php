<?php	
	class Operaciones{
		function __construct(){
			$this->Url = "'BuscarDepa.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="atras">'.$Mensaje.'</span>';
		}
		function BuscarDepartamentos(){ 
			// RUTA NUEVO DEPARTAMENTO
			$CUrl = "'CrearDepa.php'";
			$CFoco = "'descripcion'";
			// RUTA VER DEPENDENCIAS
			$VUrl = "'BuscarDepe.php'";
			// RUTA AGREGAR DEPENDENCIA
			$AUrl = "'CrearDepe.php'";
			$AFoco = "'descripcion'";
			// RUTA EDITAR DEPARTAMENTO
			$MUrl = "'EditarDepa.php'";
			$MFoco = "'descripcion'";
			// RUTA ELIMINAR DEPARTAMENTO
			$EUrl = "'EliminarDepa.php'";
			// ----------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = 'SELECT idDpto,Descripcion FROM departamento';           
			$query = mysql_query($sql);    
			$Cnx->Desconectar();			
			print '<div class="nuevo">
				<input type="button" class="boton" value="Nuevo Departamento" onclick="EnvioGet('.$CUrl.','.$this->Par.','.$this->Cont.','.$CFoco.');">
				</div>';		
			if(mysql_num_rows($query)>0){
				print '<br><div class="tabladp1">
					<table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td class="tituloformulario">Descripcion</td>
						<td colspan="4" width="60%" class="tituloformulario">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					$APar = "'iddpto=".$row['idDpto']."&desc=".$row['Descripcion']."'";
					$MPar = $EPar = "'iddpto=".$row['idDpto']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['Descripcion'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="VerDependencias('.$VUrl.','.$row['idDpto'].','.$this->Cont.');">Ver Dep.</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Insertar.png"><span style="cursor:pointer;" onclick="CrearDependencia('.$AUrl.','.$APar.','.$this->Cont.','.$AFoco.');">Agregar Dep.</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.','.$MFoco.');">Editar Dpto.</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarDepartamento('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar Dpto.</span></td>
						</tr>';
				}
				print '</table></div>';			
			}
		}
		function BuscarDependencias($idDpto){ 
			// RUTA MODIFICAR DEPENDENCIAS
			$MUrl = "'EditarDepe.php'";
			$MFoco = "'descripcion'";
			// RUTA ELIMINAR DEPENDENCIAS
			$EUrl = "'EliminarDepe.php'";
			// ---------------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT de.idDep,de.Descripcion FROM dependencia de,dpto_dep dd WHERE dd.idDpto='".$idDpto."' AND dd.idDep=de.idDep";
			$query = mysql_query($sql); 
			$Cnx->Desconectar();
			if(mysql_num_rows($query)>0){
				print '<div class="atras">
						<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');">
					</div><br>
					<div class="tabladp2">
					<table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td class="tituloformulario">Descripcion</td>
						<td colspan="2" width="50%" class="tituloformulario">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					$MPar = $EPar = "'iddep=".$row['idDep']."&iddpto=".$idDpto."'";
					print '<tr>
								<td class="cuerpoformulario">'.$row['Descripcion'].'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.','.$MFoco.');">Editar Dep.</span></td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarDependencia('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar Dep.</span></td>
							</tr>';
				}
				print '<tr></table></div>';
			}
			else{
				$Mensaje = 'No se encontraron registros';
				$this->Atras($Mensaje);	
			}
		}
		function CrearDepartamento(){
			// RUTA GUARDAR DEPARTAMENTO
			$AUrl = "'CrearDepe.php'";
			$AFoco = "'descripcion'";
			print '<br><br><br><div class="tabladp3">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nuevo departamento</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Descripcion</td>
					<td><input type="text" name="descripcion" class="dereditform" id="descripcion" size="17" maxlength="20"></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
					<td align="center"><input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Siguiente" onclick="CrearDependencia('.$AUrl.','.$this->Par.','.$this->Cont.','.$AFoco.');"></td>
				</tr>
			</table></div>';
		}
		function CrearDependencia($idDpto,$Desc){
			$GUrl = "'GuardarDepaDepe.php'";
			$GPar = "'iddpto=".$idDpto."&desc1=".$Desc."'";
			print '<br><br><br><div class="tabladp3">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nueva dependencia</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Descripcion</td>
					<td><input type="text" name="descripcion" class="dereditform" id="descripcion" size="17" maxlength="20"></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
					<td align="center"><input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Guardar" onclick="GuardarDepaDepe('.$GUrl.','.$GPar.','.$this->Cont.');"></td>
				</tr>
			</table>';
		}
		function EditarDepartamento($idDpto){
			// RUTA MODIFICAR DEPARTAMENTO
			$MUrl = "'ModificarDepa.php'";
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = 'SELECT Descripcion FROM departamento WHERE idDpto='.$idDpto;
			$query = mysql_query($sql);  
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'No se encontraron registros';
				$this->Atras($Mensaje);					
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					print '<br><br><br><div class="tabladp3">
					<table width="90%" class="espacio" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de departamento</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
							<td><input type="text" name="descripcion" class="dereditform" id="descripcion" cols="16" maxlength="40" size="30" rows="1" value="'.$row['Descripcion'].'" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2">
								<table border="0" width="100%" cellspacing="2" align="center">
									<tr>
										<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
										<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarDepartamento('.$MUrl.','.$idDpto.','.$this->Cont.');"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table></div>';
				}
			}
		}
		function EliminarDepartamento($idDpto){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$n = 0;
			$sql = "SELECT idDep FROM dpto_dep WHERE idDpto='".$idDpto."'";
			$query = mysql_query($sql);
			while($row = mysql_fetch_assoc($query)){
				$idDep[$n] = $row['idDep'];
				$n++;
			}
			if($n>0){
				$sql = "DELETE FROM dpto_dep WHERE idDpto='".$idDpto."'";
				$eliminar = mysql_query($sql);
				if ($eliminar){
					for ($i=0;$i<$n;$i++){
						$sql = "DELETE FROM dependencia WHERE idDep='".$idDep[$i]."'";
						$eliminar2 = mysql_query($sql);
					}
					if ($eliminar2){
						$sql = "DELETE FROM departamento WHERE idDpto='".$idDpto."'";
						$eliminar3 = mysql_query($sql);
						$Cnx->Desconectar();
						if($eliminar3){
							$this->BuscarDepartamentos();
						}
						else{
							$Mensaje = 'Error: No se pudo eliminar el departamento';
							$this->Atras($Mensaje);	
						}
					}
					else{
						$Mensaje = 'Error: No se pudo eliminar la dependencia';
						$Cnx->Desconectar();
						$this->Atras($Mensaje);	
					}
				}
				else{
					$Mensaje = 'No se puede eliminar el departamento debido a que existen cajas, usuarios o accesos asociados al mismo';
					$Cnx->Desconectar();
					$this->Atras($Mensaje);	
				}
			}
			else{
				$sql = "DELETE FROM departamento WHERE idDpto='".$idDpto."'";
				$eliminar = mysql_query($sql);
				$Cnx->Desconectar();
				if($eliminar){
					$this->BuscarDepartamentos();
				}
				else{
					$Mensaje = 'No se puede eliminar el departamento debido a que existen cajas, usuarios o accesos asociados al mismo';
					$this->Atras($Mensaje);	
				}
			}
		}
		function GuardarDepaDepe(){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$idDpto = $_GET['iddpto'];

			if (get_magic_quotes_gpc()!=1)
				$Descripcion1 = addslashes($_GET['desc1']);
			else
				$Descripcion1 = $_GET['desc1'];
			$Desc1 = htmlentities($Descripcion1);
			
			if (get_magic_quotes_gpc()!=1)
				$Descripcion2 = addslashes($_GET['desc2']);
			else
				$Descripcion2 = $_GET['desc2'];
			$Desc2 = htmlentities($Descripcion2);
			
			if($idDpto=='null'){
				$sql = "INSERT INTO departamento (Descripcion,Usuario,Fecha_Creacion) VALUES ('".$Desc1."','".$_SESSION['usuario']."','".$Fecha."')";
				$insertar = mysql_query($sql);
				if($insertar)
					$idDpto = mysql_insert_id();
				else{
					$Mensaje = 'Error: Fallo el registro';
					$this->Atras($Mensaje);	
				}
			}
			$sql = "INSERT INTO dependencia (Descripcion,Usuario,Fecha_Creacion) VALUES ('".$Desc2."','".$_SESSION['usuario']."','".$Fecha."')";
			$insertar = mysql_query($sql);
			if($insertar){
				$idDep = mysql_insert_id();
				$sql = "INSERT INTO dpto_dep (idDpto,idDep,Usuario,Fecha_Creacion) VALUES ('".$idDpto."','".$idDep."','".$_SESSION['usuario']."','".$Fecha."')";
				$insertar2 = mysql_query($sql);
				$Cnx->Desconectar();
				if($insertar2){
					$this->BuscarDepartamentos();
				}
				else{
					$Mensaje = 'Error: Fallo el registro';
					$this->Atras($Mensaje);	
				}
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$Cnx->Desconectar();
				$this->Atras($Mensaje);	
			}
		}
		function ModificarDepartamento($idDpto,$Descripcion){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE departamento SET Descripcion='".$Descripcion."' WHERE idDpto='".$idDpto."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar){
				$this->BuscarDepartamentos();
			}
			else{
				$Mensaje = 'Error: No se actualizo el registro';
				$this->Atras($Mensaje);	
			}
		}
		function EditarDependencia($idDpto,$idDep){
			// RUTA BUSCAR DEPENDENCIA
			$VUrl = "'BuscarDepe.php'";
			// RUTA MODIFICAR DEPENDENCIA
			$MUrl = "'ModificarDepe.php'";
			$MPar = "'iddpto=".$idDpto."&iddep=".$idDep."'";
			// --------------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = 'SELECT Descripcion FROM dependencia WHERE idDep='.$idDep;
			$query = mysql_query($sql);   
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'No se encontraron registros';
				$this->Atras($Mensaje);		
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					print '<br><br><br><div class="tabladp3"><table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de dependencia</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
							<td><input type="text" name="descripcion" class="dereditform" id="descripcion" size="17" maxlength="20" value="'.$row['Descripcion'].'" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td colspan="2">
								<table border="0" width="100%" cellspacing="2" align="center">
									<tr>
										<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="VerDependencias('.$VUrl.','.$idDpto.','.$this->Cont.');"></td>
										<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarDependencia('.$MUrl.','.$MPar.','.$this->Cont.');"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table></div>';
				}
			}
		}
		function ModificarDependencia($idDpto,$idDep,$Descripcion){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			// RUTA BUSCAR DEPENDENCIA
			$VUrl = "'BuscarDepe.php'";
			
			$sql = "UPDATE dependencia SET Descripcion='".$Descripcion."' WHERE idDep='".$idDep."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar)
				$this->BuscarDependencias($idDpto);
			else{
				$Mensaje = 'Error: No se actualizo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EliminarDependencia($idDpto,$idDep){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT COUNT(idDep) AS numero FROM dpto_dep WHERE idDpto='".$idDpto."'";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query))
					$num = $row['numero'];
				$sql = "DELETE FROM dpto_dep WHERE idDep='".$idDep."'";
				$eliminar = mysql_query($sql);
				if($eliminar){
					$sql = "DELETE FROM dependencia WHERE idDep='".$idDep."'";
					$eliminar2 = mysql_query($sql);
					$Cnx->Desconectar();
					if ($eliminar2){
						if($num==1){
							$this->BuscarDepartamentos();
						}
						else{
							$this->BuscarDependencias($idDpto);
						}
					}
					else{
						$Mensaje = 'Error: No se pudo eliminar la dependencia';
						$this->Atras($Mensaje);
					}
				}
				else{
					$Mensaje = 'No se puede eliminar la dependencia debido a que existen cajas, usuarios o accesos asociados al mismo';
					$Cnx->Desconectar();
					$this->Atras($Mensaje);
				}
			}
			else{
				$Mensaje = 'No se puede eliminar la dependencia debido a que existen cajas, usuarios o accesos asociados al mismo';
				$Cnx->Desconectar();
				$this->Atras($Mensaje);
			}
		}
		function ComprobarDependencia($idDpto){
			$data = 0;
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT de.idDep,de.Descripcion FROM dependencia de,dpto_dep dd WHERE dd.idDpto='".$idDpto."' AND dd.idDep=de.idDep";
			$result = mysql_query($sql);
			$Cnx->Desconectar();
			if($result){
				while($row = mysql_fetch_assoc($result))
					$data = $row['idDep'];
			}
			echo json_encode($data);
		}
	}
?>