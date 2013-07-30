<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'BuscarLoca.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="atras">'.$Mensaje.'</span>';
		}
		function BuscarLocalizaciones(){
			// RUTA NUEVA LOCALIZACION
			$NUrl = "'AgregarLoca.php'";
			$NFoco = "'estante'";
			// RUTA VER UBICACIONES
			$VUrl = "'BuscarUbi.php'";
			// RUTA COMPROBAR ESPACIO
			$CUrl = "'ComprobarEspacio.php'";
			// RUTA GUARDAR UBICACION
			$GUrl = "'GuardarNuevaUbi.php'";
			// RUTA EDITAR LOCALIZACION
			$MUrl = "'EditarLoca.php'";
			// RUTA ELIMINAR LOCALIZACION
			$EUrl = "'EliminarLoca.php'";
			// --------------------------
			$estante = null;
			
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT DP.Descripcion, L.idLocalizacion, L.Fila, L.Estante FROM localizacion L, departamento DP, 
					dpto_dep DD WHERE L.idDpto=DP.idDpto AND DP.idDpto=DD.idDpto AND DD.idDpto_Dep='".$_SESSION['iddptodep']."' 
					ORDER BY DP.Descripcion,L.idLocalizacion,L.Fila";           
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			
			print '<div class="nuevo3">
				<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Nueva Localizacion" onclick="EnvioGet('.$NUrl.','.$this->Par.','.$this->Cont.','.$NFoco.');">
				</div>';
			
			if(mysql_num_rows($query)>0){
				print '<br><div class="locascroll">';
				while($row = mysql_fetch_assoc($query)){
					if (($estante==null)||($estante!=$row['Estante'])){
						if($estante==null)
							$estante = $row['Estante'];
						if($estante!=$row['Estante']){
							$estante = $row['Estante'];
							print '</table></div><br>';
						}
						print '<div class="tamanotitulo"><table border="0" width="100%">
						<tr>
							<td width="15%" align="right"><span class="letra">Estante:</span></td> 
							<td align="left"><span class="tamano">&nbsp;&nbsp;'.$estante.'</span></td>
							<td colspan="2" width="60%"></td>
						</tr></table></div>';
						print '<div class="tablalo">
						<table width="100%" border="1" cellspacing="1" cellpadding="0">
						<tr>
							<td width="7%" class="tituloformulario">Fila</td>
							<td colspan="4" width="54%" class="tituloformulario">Acciones</td>
						</tr>';
					}
					$VPar = $MPar = $EPar = $GPar = "'idloca=".$row['idLocalizacion']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['Fila'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="EnvioGet('.$VUrl.','.$VPar.','.$this->Cont.');">Ver Ubicacion</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Insertar.png"><span style="cursor:pointer;" onclick="GuardarUbicacion('.$CUrl.','.$GUrl.','.$GPar.','.$this->Cont.');">Agregar Ubicacion</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.');">Editar</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarLocalizacion('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar</span></td>
						</tr>';
				}
				print '</table></div><br><br></div>';	
			}
		}
		function BuscarUbicaciones($idLocal){
			// RUTA EDITAR UBICACION
			$EUrl = "'EditarUbi.php'";
			// ---------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
		
			$sql = "SELECT idUbicacion,Disponibilidad FROM ubicacion WHERE idLocalizacion='".$idLocal."'";
			$query = mysql_query($sql);  
			$Cnx->Desconectar();			
			
			print '<div class="atrasub">
				<input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');">
				</div>';	
				
			if(mysql_num_rows($query)>0){
				print '<br><div class="tablaub">
				<table width="100%" border="1" cellspacing="1" cellpadding="0" align="center">
					<tr>
						<td class="tituloformulario" width="28%">ID Ubicacion</td>
						<td class="tituloformulario" width="32%">Disponibilidad</td>
						<td colspan="2" width="40%" class="tituloformulario">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					$EPar = "'idubi=".$row['idUbicacion']."&idloca=".$idLocal."'";
					print '<tr>
								<td class="cuerpoformulario">'.$row['idUbicacion'].'</td>
								<td class="cuerpoformulario">'.$row['Disponibilidad'].'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$EUrl.','.$EPar.','.$this->Cont.');">Editar Ubicacion</span></td>
							</tr>';
				}
				print '<tr>
					</table></div>';	
			}
		}
		function AgregarLocalizacion(){
			// RUTA GUARDAR LOCALIZACION
			$GUrl = "'GuardarLoca.php'";
			// RUTA COMPROBAR LOCALIZACION
			$CUrl = "'ComprobarLoca.php'";
			// ---------------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT valor FROM parametro WHERE idParametro='2'";
			$query = mysql_query($sql); 
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'Error: No se encuentra el parametro';
				$this->Atras($Mensaje);
			}
			else{
				while($row = mysql_fetch_assoc($query))
					$valor = $row['valor'];
			}
			print '<br><br><br><form name="ubic"><div class="tablalo2">
					<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Nueva Localizacion</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Estante&nbsp;&nbsp;</td>
							<td><input type="text" name="estante" class="dereditform" id="estante" size="4"/></td>
						</tr>
						<tr>
							<td class="izqeditform">Fila&nbsp;&nbsp;</td>
							<td><select class="dereditform" name="fila" id="fila">';
								for($i=1;$i<=$valor;$i++){
									print '<option value="'.$i.'">'.$i.'</option>';
								}
							print '</select></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
							<td align="center"><input type="button" class="boton" name="guardar" id="guardar" value="Guardar" onclick="GuardarNuevaLoca('.$CUrl.','.$GUrl.','.$this->Cont.');"></td>
						</tr>
					</table></div></form>';
		}
		function GuardarUbicacion($idLoca){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date('Y-m-d',$f);
			
			$sql = "INSERT INTO ubicacion (idLocalizacion,Usuario,Fecha_Creacion,Disponibilidad) VALUES ('".$idLoca."','".$_SESSION['usuario']."','".$Fecha."','Vacante')";
			$insertar = mysql_query($sql);
			$Cnx->Desconectar();
			
			if($insertar){
				$this->BuscarLocalizaciones();
			}
			else{
				$Mensaje = 'Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EditarLocalizaciones($idLoca){
			// RUTA MODIFICAR LOCALIZACION
			$MUrl = "'ModificarLoca.php'";
			// RUTA COMPROBAR LOCALIZACION
			$CUrl = "'ComprobarLoca2.php'";
			// ---------------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT valor FROM parametro WHERE idParametro='2'";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'Error: No se encuentra el parametro';
				$this->Atras($Mensaje);
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					$valor = $row['valor'];
				}
			}
			$sql = "SELECT * FROM localizacion WHERE idLocalizacion='".$idLoca."'";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'Error: No se encontraron registros';
				$this->Atras($Mensaje);			
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					$idDpto = $row['idDpto'];
					$idLoca = $row['idLocalizacion'];
					$Estante = $row['Estante'];
					$Fila = $row['Fila'];
					print '<br><br><br><div class="tablalo2"><table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Modificacion de localizacion</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Departamento&nbsp;&nbsp;</td>
							<td><select id="dpto" name="dpto" class="cajas">';
								$sql = "SELECT idDpto,Descripcion FROM departamento";
								$query = mysql_query($sql);
								if(mysql_num_rows($query)>0){
									while($row = mysql_fetch_assoc($query)){
										if($idDpto==$row['idDpto'])
											print '<option value="'.$row['idDpto'].'" selected>'.$row['Descripcion'].'</option>';
										else
											print '<option value="'.$row['idDpto'].'">'.$row['Descripcion'].'</option>';
									}
								}
								$Cnx->Desconectar();
							print '</select></td>
						</tr>
						<tr>
							<td class="izqeditform">ID Localizacion&nbsp;&nbsp;</td>
							<td><input type="text" value="'.$idLoca.'" class="dereditform" style="{background-color: #E6E6E6;}" id="idloca" size="8" readonly/></td>
						</tr>
						<tr>
							<td class="izqeditform">Estante&nbsp;&nbsp;</td>
							<td><input type="text" value="'.$Estante.'"name="estante" class="dereditform" style="{background-color: #E6E6E6;}" id="estante" size="6" readonly/></td>
						</tr>
						<tr>
							<td class="izqeditform">Fila&nbsp;&nbsp;</td>
							<td><select class="dereditform" name="fila" id="fila" style="{width: 50px;}">';
								for($i=1;$i<=$valor;$i++){
									if($Fila==$i)
										print '<option value="'.$i.'" selected>'.$i.'</option>';
									else
										print '<option value="'.$i.'">'.$i.'</option>';
								}
							print '</select></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
							<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarLocalizacion('.$CUrl.','.$MUrl.','.$this->Cont.');"></td>
						</tr>
					</table></div>';
				}
			}
		}
		function EliminarLocalizacion($idLoca){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "DELETE FROM ubicacion WHERE idLocalizacion='".$idLoca."'";
			$eliminar = mysql_query($sql);
			if ($eliminar){
				$sql = "DELETE FROM localizacion WHERE idLocalizacion='".$idLoca."'";
				$eliminar2 = mysql_query($sql);
				$Cnx->Desconectar();
				if($eliminar2){
					$this->BuscarLocalizaciones();
				}
				else{
					$Mensaje = 'Error: No se elimino la localizacion';
					$this->Atras($Mensaje);
				}
			}
			else{
				$Mensaje = 'Error: No se elimino la ubicacion';
				$this->Atras($Mensaje);
			}
		}
		function GuardarLocalizacion($Fila,$Estante){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$sql = "SELECT idDpto FROM dpto_dep WHERE idDpto_Dep='".$_SESSION['iddptodep']."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$idDpto = $row['idDpto'];
				}
				$sql = "INSERT INTO localizacion (Usuario,Fila,Estante,idDpto,Fecha_Creacion) 
						VALUES ('".$_SESSION['usuario']."','".$Fila."','".$Estante."','".$idDpto."','".$Fecha."')";
				$insertar = mysql_query($sql);
				$idLocal = mysql_insert_id();
				if($insertar){
					$sql = "INSERT INTO ubicacion (idLocalizacion,Disponibilidad,Usuario,Fecha_Creacion) 
							VALUES ('".$idLocal."','Vacante','".$_SESSION['usuario']."','".$Fecha."')";
					$insertar2 = mysql_query($sql);
					$Cnx->Desconectar();
					if($insertar2){
						$this->BuscarLocalizaciones();
					}
					else{
						$Mensaje = 'Error: Fallo el registro';
						$this->Atras($Mensaje);
					}
				}
				else{
					$Mensaje = 'Error: Fallo el registro';
					$this->Atras($Mensaje);
				}
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function ModificarLocalizacion($idLoca,$Dpto,$Fila,$Estante){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE localizacion SET Fila='".$Fila."',Estante='".$Estante."',idDpto='".$Dpto."' 
					WHERE idLocalizacion='".$idLoca."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar)
				$this->BuscarLocalizaciones();
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function EditarUbicacion($idLoca,$idUbi,$Disp){
			// RUTA MODIFICAR UBICACION
			$MUrl = "'GuardarUbi.php'";
			// RUTA BUSCAR UBICACION
			$BUrl = "'BuscarUbi.php'";
			// ------------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Disponibilidad FROM ubicacion WHERE idUbicacion='".$idUbi."'";
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$MPar = "'idubi=".$idUbi."&idloca=".$idLoca."'";
					$BPar = "'idloca=".$idLoca."'";
					print '<br><br><br><form name="ubic"><div class="tablaub2">
					<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Modificacion de ubicacion</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">ID Ubicacion&nbsp;&nbsp;</td>
							<td><input type="text" value="'.$idUbi.'" name="idubi" class="dereditform" id="idubi" size="14" style="{background-color: #E6E6E6;}" readonly/></td>
						</tr>
						<tr>
							<td class="izqeditform">Disponibilidad&nbsp;&nbsp;</td>
							<td>
								<select id="disponibilidad" name="disponibilidad" class="select">';
								foreach ($Disp as $indice=>$valor){
									if ($row['Disponibilidad'] == $valor){
										print '<option value="'.$indice.'" selected>'.$valor.'</option>n';    
									} 
									else {
										print '<option value="'.$indice.'">'.$valor.'</option>n';
									}
								}
								print '</select> 
							</td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$BUrl.','.$BPar.','.$this->Cont.')"/></td>
							<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarUbicaciones('.$MUrl.','.$MPar.','.$this->Cont.');"/></td>
						</tr>
					</table></div></form>';
				}
			}
		}
		function ModificarUbicacion($idLoca,$idUbi,$Disp){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE ubicacion SET Disponibilidad='".$Disp."' WHERE idUbicacion='".$idUbi."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar){
				$this->BuscarUbicaciones($idLoca);
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function ComprobarEspacio($idLoca){
			$data['Maximo'] = '0';
			$data['Valor'] = '0';
				
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT COUNT(idLocalizacion) AS Maximo FROM ubicacion WHERE idLocalizacion='".$idLoca."'";    
			$result = mysql_query($sql);
			if ($result) {
				$row = mysql_fetch_object($result);
				$data['Maximo'] = $row->Maximo;
				$sql = "SELECT Valor FROM parametro WHERE idParametro='1'";
				$result = mysql_query($sql);
				if($result){
					$row = mysql_fetch_object($result);
					$data['Valor'] = $row->Valor;
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ComprobarLocalizacion1($Fila,$Estante){
			$data['num'] = '1';
			$data['filas'] = '0';
			$data['valor'] = '0';
				
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT COUNT(idLocalizacion) AS num FROM localizacion WHERE Fila='".$Fila."' AND Estante='".$Estante."'";
			$result = mysql_query($sql);
			if($result){
				$row = mysql_fetch_object($result);
				$data['num'] = $row->num;
				$sql = "SELECT COUNT(Fila) AS filas FROM localizacion WHERE Estante='".$Estante."'";
				$result = mysql_query($sql);
				if ($result) {
					$row = mysql_fetch_object($result);
					$data['filas'] = $row->filas;
					$sql = "SELECT valor FROM parametro WHERE idParametro='2'";
					$result = mysql_query($sql);
					if ($result) {
						$row = mysql_fetch_object($result);
						$data['valor'] = $row->valor;
					}
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ComprobarLocalizacion2($idLoca,$Fila,$Estante){
			$data['num'] = '0';
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			if($idLoca>0){
				$sql = "SELECT Fila,Estante FROM localizacion WHERE idLocalizacion='".$idLoca."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query)>0){
					while($row = mysql_fetch_assoc($query)){
						$F = $row['Fila'];
						$E = $row['Estante'];
					}
				}
			}
			if(($Fila!=$F)||($Estante!=$E)||($idLoca==0)){
				$sql = "SELECT COUNT(idLocalizacion) AS num FROM localizacion WHERE Fila='".$Fila."' AND Estante='".$Estante."'";
				$result = mysql_query($sql);
				if($result){
					$row = mysql_fetch_object($result);
					$data['num'] = $row->num;
				}				
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
	}
?>