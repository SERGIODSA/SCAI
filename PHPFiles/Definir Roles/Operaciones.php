<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'ConsultaRoles.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function ConsultaRoles(){
			// RUTA CREAR ROL
			$CUrl = "'CrearRol.php'";
			$CFoco = "'rol'";
			// RUTA EDITAR ROL
			$MUrl = "'EditarRol.php'";
			// RUTA ELIMINAR ROL
			$EUrl = "'EliminarRol.php'";
			// --------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = 'SELECT idRol,Nombre_Rol FROM rol';           
			$query = mysql_query($sql);  

			$Cnx->Desconectar();	
			
			print '<div class="nuevo">
					<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Crear nuevo rol" onclick="EnvioGet('.$CUrl.','.$this->Par.','.$this->Cont.','.$CFoco.');">
					</div>';	
			if(mysql_num_rows($query)>0){
				print '<br><div class="tablaacceso">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
				<tr>
					<td class="tituloformulario">Nombre Rol</td>
					<td colspan="2" width="35%" class="tituloformulario">Acciones</td>
				</tr>';
				while($row = mysql_fetch_assoc($query)){
					$EPar = $MPar = "'idrol=".$row['idRol']."'";
					print '<tr>
						<td class="cuerpoformulario">'.$row['Nombre_Rol'].'</td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$MUrl.','.$MPar.','.$this->Cont.');">Editar</span></td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="EliminarRol('.$EUrl.','.$EPar.','.$this->Cont.');">Eliminar</span></td>
					</tr>';
				}
				print '</table></div><br><br>';			
			}
		}
		function CrearRol(){
			// RUTA GUARDAR ROL
			$GUrl = "'GuardarRol.php'";
			// ----------------
			$i = 0;
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT idMenus,Menu,Submenu FROM menu";
			$query = mysql_query($sql);  
			
			$Cnx->Desconectar();		
			
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$Menu['idMenus'][$i] = $row['idMenus'];
					$Menu['menu'][$i] = $row['Menu'];
					$Menu['submenu'][$i] = $row['Submenu'];
					$i++;
				}
			}
			print '<br><div class="roles">
				<form name="datos">
					<table align="center" cellpadding="0" cellspacing="2" border="0" width="90%"> 
						<tr>
							<td colspan="3" class="titulobold">Datos del rol</td>
						</tr>
						<tr>
							<td colspan="3"><br></td>
						</tr>
						<tr>
							<td class="letra">Nombre del rol&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="rol" id="rol" class="cajas"/></td>
						</tr>
						<tr>
							<td colspan="3"><br></td>
						</tr>
						<tr>
							<td colspan="3" class="titulobold">Asignacion de menus al rol</td>
						</tr>
						</table><table align="center" cellpadding="3" border="0" width="90%">
							<tr>
								<td class="subtitulo" align="center" width="50%">Menu</td>
								<td class="subtitulo" align="center" width="50%">Submenu</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
						</table><div class="cajadepes"><table align="center" cellpadding="3" border="0" width="90%">';
						$Menus = null;
						for($j=0;$j<$i;$j++){
							print '<tr>';
							if($Menus==$Menu['menu'][$j]){
								print'<td width="45%"><br></td>
								<td width="5%"><input type="checkbox" name="idmenus" id="idmenus" value="'.$Menu['idMenus'][$j].'"/></td>
								<td width="45%">'.$Menu['submenu'][$j].'</td>';
							}
							else{
								$Menus=$Menu['menu'][$j];
								print'<td align="right" style="{text-decoration: underline;}" width="45%">'.$Menu['menu'][$j].':</td>
								<td width="5%"><input type="checkbox" name="idmenus" id="idmenus" value="'.$Menu['idMenus'][$j].'"/></td>
								<td width="45%">'.$Menu['submenu'][$j].'</td>';
							}
							print '</tr>';
						}
						print '</table></div><table align="center" cellpadding="3" border="0" width="90%">
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" valign="bottom" width="40%"><input type="button" value="Atras" class="boton" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></td>
							<td align="center" valign="bottom" width="60%"><input type="button" value="Registrar Rol" class="boton" onclick="GuardarRol('.$GUrl.','.$this->Par.','.$this->Cont.');"/></td>
						</tr>
						</table>
				</form>
			</div><br><br>';
		}
		function EditarRol($idRol){
			// RUTA MODIFICAR ROL
			$MUrl = "'ModificarRol.php'";
			// ------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Nombre_Rol FROM Rol WHERE idRol='".$idRol."'";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query))
					$Nombre_Rol = $row['Nombre_Rol'];
				$sql = "SELECT idMenus FROM menu_rol WHERE idRol='".$idRol."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query)>0){
					$h = 0;
					$idMenu = null;
					while($row = mysql_fetch_assoc($query)){
						$idMenus[$h] = $row['idMenus'];
						if($idMenu==null)
							$idMenu = $row['idMenus'];
						else
							$idMenu = $idMenu.'-'.$row['idMenus'];
						$h++;
					}
					print '<br><div class="roles">
					<form name="datos">
						<table align="center" cellpadding="0" cellspacing="2" border="0" width="90%"> 
							<tr>
								<td colspan="2" class="titulobold">Datos del rol</td>
							</tr>
							<tr>
								<td colspan="2"><br></td>
							</tr>
							<tr>
								<td class="letra">Nombre del rol&nbsp;&nbsp;</td>
								<td><input type="text" name="rol" id="rol" class="cajas" value="'.$Nombre_Rol.'"/></td>
							</tr>
							<tr>
								<td colspan="3"><br></td>
							</tr>
							<tr>
								<td colspan="3" class="titulobold">Asignacion de menus al rol</td>
							</tr>
							</table><table align="center" cellpadding="3" border="0" width="90%">
							<tr>
								<td class="subtitulo" align="center" width="50%">Menu</td>
								<td class="subtitulo" align="center" width="50%">Submenu</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							</table><div class="cajadepes"><table align="center" cellpadding="3" border="0" width="90%">';
							$i = 0;
							$sql = "SELECT idMenus,Menu,Submenu FROM menu";
							$query = mysql_query($sql);    
							if(mysql_num_rows($query)>0){
								while($row = mysql_fetch_assoc($query)){
									$Menu['idMenus'][$i] = $row['idMenus'];
									$Menu['menu'][$i] = $row['Menu'];
									$Menu['submenu'][$i] = $row['Submenu'];
									$i++;
								}
							}
							$Menus = null;
							for($j=0;$j<$i;$j++){
								$marca = null;
								for($k=0;$k<$h;$k++){
									if(($Menu['idMenus'][$j])==($idMenus[$k]))
										$marca = 'checked';
								}
								print '<tr>';
								if($Menus==$Menu['menu'][$j]){
									print'<td width="45%"><br></td>
									<td width="5%"><input type="checkbox" name="idmenus" id="idmenus" value="'.$Menu['idMenus'][$j].'" '.$marca.'/></td>
									<td width="45%">'.$Menu['submenu'][$j].'</td>';
								}
								else{
									$Menus=$Menu['menu'][$j];
									print'<td align="right" style="{text-decoration: underline;}" width="45%">'.$Menu['menu'][$j].':</td>
									<td width="5%"><input type="checkbox" name="idmenus" id="idmenus" value="'.$Menu['idMenus'][$j].'" '.$marca.'/></td>
									<td width="45%">'.$Menu['submenu'][$j].'</td>';
								}
								print '</tr>';
							}
							$MPar = "'idrol=".$idRol."&idmenu=".$idMenu."'";
							print '</table></div><table align="center" cellpadding="3" border="0" width="90%">
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td align="center" valign="bottom" width="40%"><input type="button" value="Atras" class="boton" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></td>
								<td align="center" valign="bottom" width="60%"><input type="button" value="Editar Rol" class="boton" onclick="ModificarRol('.$MUrl.','.$MPar.','.$this->Cont.');"/></td>
							</tr>
							</table>
						</form>
					</div><br><br>';
				}
			}
			$Cnx->Desconectar();
		}
		function EliminarRol($idRol){
			$num = 1;
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT COUNT(idRol) AS Num FROM rol_usuario WHERE idRol='".$idRol."'";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query))
					$num = $row['Num'];
			}
			if($num==0){
				$sql = "DELETE FROM menu_rol WHERE idRol='".$idRol."'";
				$eliminar = mysql_query($sql);
				if($eliminar){
					$sql = "DELETE FROM rol WHERE idRol='".$idRol."'";
					$eliminar = mysql_query($sql);
					$Cnx->Desconectar();	
					if($eliminar)
						$this->ConsultaRoles();
					else{
						$Mensaje = "Error: No se pudo eliminar el registro";
						$this->Atras($Mensaje);
					}
				}
				else{
					$Cnx->Desconectar();	
					$Mensaje = "Error: No se pudo eliminar el registro";
					$this->Atras($Mensaje);
				}
			}
			else{
				$Cnx->Desconectar();
				$Mensaje = "No se pudo eliminar el registro. Existen usuarios con este rol";
				$this->Atras($Mensaje);
			}
		}
		function GuardarRol($Rol,$IDM){
			$idMenus = explode('-',$IDM);
			$Tamano = sizeof($idMenus);
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "INSERT INTO rol (Nombre_Rol,Usuario_Creador,Fecha_Creacion) VALUES ('".$Rol."','".$_SESSION['usuario']."','".$Fecha."')";
			$insertar = mysql_query($sql);
			if($insertar){
				$idRol = mysql_insert_id();
				for($i=0;$i<$Tamano;$i++){
					$sql = "INSERT INTO menu_rol (idMenus,idRol,Usuario_Creador,Fecha_Creacion) VALUES ('".$idMenus[$i]."',
					'".$idRol."','".$_SESSION['usuario']."','".$Fecha."')";
					$insertar = mysql_query($sql);
				}
				$Cnx->Desconectar();
				if($insertar)
					$this->ConsultaRoles();
			}
			else{
				$Cnx->Desconectar();
				$Mensaje = "Error: Fallo el registro";
				$this->Atras($Mensaje);	
			}
		}
		function ModificarRol($idRol,$Rol,$IDMS,$IDM){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$idMenus = explode('-',$IDMS);
			$Tamano = sizeof($idMenus);
			
			$idMenu  = explode('-',$IDM);
			$Tamano2 = sizeof($idMenu);
			
			$sql = "UPDATE rol SET Nombre_Rol='".$Rol."' WHERE idRol='".$idRol."'";
			$actualizar = mysql_query($sql);
			if($actualizar){
				for($i=0;$i<$Tamano;$i++){
					$band = false;
					for($j=0;$j<$Tamano2;$j++){
						if($idMenus[$i]==$idMenu[$j])
							$band = true;
					}
					if($band == false){
						$sql = "INSERT INTO menu_rol (idMenus,idRol,Usuario_Creador,Fecha_Creacion) VALUES ('".$idMenus[$i]."','".$idRol."',
								'".$_SESSION['usuario']."','".$Fecha."')";
						$insertar = mysql_query($sql);
					}
				}
				for($j=0;$j<$Tamano2;$j++){
					$band = false;
					for($i=0;$i<$Tamano;$i++){
						if($idMenus[$i]==$idMenu[$j])
							$band = true;
					}
					if($band == false){
						$sql = "DELETE FROM menu_rol WHERE idMenus='".$idMenu[$j]."' AND idRol='".$idRol."'";
						$eliminar = mysql_query($sql);
					}	
				}
				$Cnx->Desconectar();
				$this->ConsultaRoles();
			}
			else{
				$Cnx->Desconectar();
				$Mensaje = "Error: Fallo el registro";
				$this->Atras($Mensaje);
			}
		}
	}
?>