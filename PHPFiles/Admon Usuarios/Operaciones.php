<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'ConsultaUsuarios.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function ConsultaUsuarios(){
			// RUTA NUEVO USUARIO
			$NUrl = "'CrearUsuario.php'";
			$NPar = "''";
			$NCont = "'resultados'";
			// RUTA CAMBIAR CLAVE
			$CUrl = "'CambiarClave.php'";
			$CCont = "'resultados'";
			$CFoco = "'clave'";
			// RUTA EDITAR USUARIO
			$EUrl = "'EditarUsuario.php'";
			$ECont = "'resultados'";
			// -------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = 'SELECT idUsuario,Nombre,Apellido,Cedula FROM usuario';           
			$query = mysql_query($sql);  
			$Cnx->Desconectar();
			
			if(mysql_num_rows($query)>0){
				print '<div class="nuevouser">
				<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Crear nuevo usuario" onclick="EnvioGet('.$NUrl.','.$NPar.','.$NCont.');">
				</div><br><div class="tablausuarios">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
				<tr>
					<td class="tituloformulario" width="11%">ID Usuario</td>
					<td class="tituloformulario" width="21%">Nombre</td>
					<td class="tituloformulario" width="21%">Apellido</td>
					<td class="tituloformulario" width="10%">Cedula</td>
					<td class="tituloformulario" colspan="2" width="27%">Acciones</td>
				</tr>';
				while($row = mysql_fetch_assoc($query)){
					$EPar = $CPar = "'idUsuario=".$row['idUsuario']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['idUsuario'].'</td>
							<td class="cuerpoformulario">'.$row['Nombre'].'</td>
							<td class="cuerpoformulario">'.$row['Apellido'].'</td>
							<td class="cuerpoformulario">'.$row['Cedula'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="EnvioGet('.$CUrl.','.$CPar.','.$CCont.','.$CFoco.');">Cambiar contrase&ntilde;a</span></td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$EUrl.','.$EPar.','.$ECont.');">Editar</span></td>
						</tr>';
				}
				print '</table></div><br><br>';		
			}
		}
		function CrearUsuario(){
			// RUTA GUARDAR USUARIO
			$GUrl = "'GuardarUsuario.php'";
			// --------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT DD.idDpto_Dep,DP.Descripcion AS Depa,DE.Descripcion AS Depe FROM dpto_dep DD,
					departamento DP,dependencia DE WHERE DD.idDpto=DP.idDpto AND DD.idDep=DE.idDep ORDER BY DD.idDpto";
			$query = mysql_query($sql); 
			
			$Cnx->Desconectar();
			$i = 0;			
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$Depadepe['idDptoDep'][$i] = $row['idDpto_Dep'];
					$Depadepe['Depa'][$i] = $row['Depa'];
					$Depadepe['Depe'][$i] = $row['Depe'];
					$i++;
				}
			}
			print '<div class="registro">
				<form name="datos">
					<table align="center" cellpadding="3" border="0" width="90%"> 
						<tr>
							<td colspan="3" class="subtitulo">Datos del usuario</td>
						</tr>
						<tr>
							<td class="letra">Nombre&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="nombre" id="nombre" maxlength="25" size="25" class="cajas"/></td>
						</tr>
						<tr>
							<td class="letra">Apellido&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="apellido" id="apellido" maxlength="25" size="25" class="cajas" /></td>
						</tr>
						<tr>
							<td class="letra">Cedula&nbsp;&nbsp;</td>
							<td colspan="2"><select class="cajas" id="nacionalidad"><option value="V">V</option><option value="E">E</option></select>&nbsp;&nbsp;<input type="text" name="cedula" maxlength="8" size="10" class="cajas" id="cedula"/></td>
						</tr>
						<tr>
							<td class="letra">ID Usuario&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="pass" maxlength="12" size="12" class="cajas" id="idusuario"/></td>
						</tr>
						<tr>
							<td class="letra">Contrase&ntilde;a&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="pass" maxlength="12" size="12" class="cajas" id="contrasena"/></td>
						</tr>
						<tr>
							<td colspan="3"><hr></td>
						</tr>
						<tr>
							<td colspan="3" class="subtitulo">Asignacion de dependencias</td>
						</tr>
					</table><table align="center" cellpadding="3" border="0" width="90%">
						<tr>
							<td class="subtitulo" align="center" width="45%">Departamento</td>
							<td width="10%" align="center"></td>
							<td class="subtitulo" align="center" width="45%">Dependencia</td>
						</tr>
					</table><div class="cajadepes"><table align="center" cellpadding="3" border="0" width="90%">';
						$Depa = null;
						for($j=0;$j<$i;$j++){
							print '<tr>';
							if($Depa==$Depadepe['Depa'][$j]){
								print'<td width="47%"><br></td>
								<td width="5%"><input type="checkbox" name="iddptodep" id="iddptodep" value="'.$Depadepe['idDptoDep'][$j].'"/></td>
								<td width="43%">'.$Depadepe['Depe'][$j].'</td>';
							}
							else{
								$Depa=$Depadepe['Depa'][$j];
								print'<td align="right" style="{text-decoration: underline;}" width="47%">'.$Depadepe['Depa'][$j].':</td>
								<td width="5%"><input type="checkbox" name="iddptodep" id="iddptodep" value="'.$Depadepe['idDptoDep'][$j].'"/></td>
								<td width="43%">'.$Depadepe['Depe'][$j].'</td>';
							}
							print '</tr>';
						}
						print '</table></div><table align="center" cellpadding="3" border="0" width="90%">
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" valign="bottom" width="37%"><input type="button" value="Atras" class="boton" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></td>
							<td align="center" valign="bottom" width="63%"><input type="button" value="Registrar Usuario" class="boton" onclick="GuardarUsuario('.$GUrl.');"/></td>
						</tr>
					</table>
				</form>
			</div><br><br>';
		}
		function CambiarClave($idUsuario){
			// RUTA GUARDAR CLAVE
			$GUrl = "'GuardarClave.php'";
			$GPar = "'idusuario=".$idUsuario."'";
			// ------------------
			print '<br><br><br><div class="cambioclave"><form name="datos">
				<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
					<tr>
						<td colspan="2" class="titulobold">Cambio de contrase&ntilde;a</td>
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
					<tr>
						<td class="izqeditform">Nueva contrase&ntilde;a&nbsp;&nbsp;</td>
						<td><input type="text" name="clave" class="dereditform" id="clave" maxlength="12" size="14" /></td>
					</tr>
					<tr>
						<td colspan="2"><hr></td>
					</tr>
					<tr>
						<td align="center" colspan="2"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" class="boton" name="modificar" id="modificar" value="Guardar contrase&ntilde;a" onclick="GuardarClave('.$GUrl.','.$GPar.');"></td>
					</tr>
				</table></form></div>';
		}
		function EditarUsuario($idUsuario){
			// RUTA MODIFICAR USUARIO
			$GUrl = "'ModificarUsuario.php'";
			$GPar = "'idusuario=".$idUsuario."'";
			$GCont = "'resultados'";
			// ----------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Nombre,Apellido,Cedula,Clave FROM usuario WHERE idUsuario='".$idUsuario."'";
			$query = mysql_query($sql);    	
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$Nombre = $row['Nombre'];
					$Apellido = $row['Apellido'];
					list($Nacionalidad,$Cedula) = explode('-',$row['Cedula']);
					$Clave = $row['Clave'];
				}
			}	
			$sql = "SELECT idDpto_Dep FROM usuario_dpto WHERE idUsuario='".$idUsuario."'";
			$query = mysql_query($sql);  
			$h = 0;	
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$UsuarioDD[$h] = $row['idDpto_Dep']; 
					$h++;
				}
			}
			print '<br><div class="registro">
				<form name="datos">
					<table align="center" cellpadding="3" border="0" width="90%"> 
						<tr>
							<td colspan="3" class="subtitulo">Datos del usuario</td>
						</tr>
						<tr>
							<td class="letra">ID Usuario&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" maxlength="12" size="12" class="cajas" value="'.$idUsuario.'" style="{background-color: #E6E6E6;}" readonly/></td>
						</tr>
						<tr>
							<td class="letra">Nombre&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="nombre" id="nombre" maxlength="25" size="25" class="cajas" value="'.$Nombre.'"/></td>
						</tr>
						<tr>
							<td class="letra">Apellido&nbsp;&nbsp;</td>
							<td colspan="2"><input type="text" name="apellido" id="apellido" maxlength="25" size="25" class="cajas" value="'.$Apellido.'"/></td>
						</tr>
						<tr>
							<td class="letra">Cedula&nbsp;&nbsp;</td>
							<td colspan="2">
								<select class="cajas" id="nacionalidad">';
									if($Nacionalidad=='V')
										print '<option value="V" selected>V</option><option value="E">E</option>';
									else
										print '<option value="V">V</option><option value="E" selected>E</option>';
								print '</select>
								&nbsp;&nbsp;
								<input type="text" name="cedula" maxlength="8" size="10" class="cajas" id="cedula" value="'.$Cedula.'"/>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="subtitulo">Asignacion de dependencias</td>
						</tr>
						</table><table align="center" cellpadding="3" border="0" width="90%">
							<tr>
								<td class="subtitulo" align="center" width="45%">Departamento</td>
								<td width="10%" align="center"></td>
								<td class="subtitulo" align="center" width="45%">Dependencia</td>
							</tr>
						</table><div class="cajadepes"><table align="center" cellpadding="3" border="0" width="90%">';
						$Depa = null;
						$sql = "SELECT DD.idDpto_Dep,DP.Descripcion AS Depa,DE.Descripcion AS Depe FROM dpto_dep DD,
								departamento DP,dependencia DE WHERE DD.idDpto=DP.idDpto AND DD.idDep=DE.idDep ORDER BY DD.idDpto";
						$query = mysql_query($sql);  
						$i = 0;	
						$Depa = null;				
						if(mysql_num_rows($query)>0){
							while($row = mysql_fetch_assoc($query)){
								$Depadepe['idDptoDep'][$i] = $row['idDpto_Dep'];
								$Depadepe['Depa'][$i] = $row['Depa'];
								$Depadepe['Depe'][$i] = $row['Depe'];
								$i++;
							}
						}
						for($j=0;$j<$i;$j++){
							$marca = null;
							for($k=0;$k<$h;$k++){
								if(($Depadepe['idDptoDep'][$j])==($UsuarioDD[$k]))
									$marca = 'checked';
							}
							print '<tr>';
							if($Depa==$Depadepe['Depa'][$j]){
								print'<td><br></td>
								<td><input type="checkbox" name="iddptodep" id="iddptodep" value="'.$Depadepe['idDptoDep'][$j].'" '.$marca.'/></td>
								<td>'.$Depadepe['Depe'][$j].'</td>';
							}
							else{
								$Depa=$Depadepe['Depa'][$j];
								print'<td align="right" style="{text-decoration: underline;}">'.$Depadepe['Depa'][$j].':</td>
								<td><input type="checkbox" name="iddptodep" id="iddptodep" value="'.$Depadepe['idDptoDep'][$j].'" '.$marca.'/></td>
								<td>'.$Depadepe['Depe'][$j].'</td>';
							}
							print '</tr>';
						}
						print '</table></div><table align="center" cellpadding="3" border="0" width="90%">
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td align="center" valign="bottom" width="37%"><input type="button" value="Atras" class="boton" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></td>
							<td align="center" valign="bottom" width="63%"><input type="button" value="Modificar usuario" class="boton" onclick="ModificarUsuario('.$GUrl.','.$GPar.','.$GCont.');"/></td>
							
						</tr>
					</table>
				</form>
			</div><br><br>';
			$Cnx->Desconectar();
		}
		function GuardarUsuario($Nombre,$Apellido,$idUsuario,$Contrasena,$IDDxD,$Cedula){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);
			$data=0;
			
			$idDptoDep = explode('-',$IDDxD);
			$Tamano = sizeof($idDptoDep);
			
			$sql = "SELECT COUNT(idUsuario) AS Num FROM usuario WHERE idUsuario='".$idUsuario."'";
			$insertar = mysql_query($sql);
			while($row = mysql_fetch_assoc($insertar))
				$Num = $row['Num'];
			if($Num==0){
				$sql = "INSERT INTO usuario (idUsuario,Clave,Nombre,Apellido,Cedula,Usuario_Creador,
						Fecha_Creacion) VALUES ('".$idUsuario."','".$Contrasena."','".$Nombre."',
						'".$Apellido."','".$Cedula."','".$_SESSION['usuario']."','".$Fechacre."')";
				$insertar = mysql_query($sql);
				if($insertar){
					for($i=0;$i<$Tamano;$i++){
						$sql = "INSERT INTO Usuario_Dpto (idDpto_Dep,idUsuario,Usuario_Creador,Fecha_Creacion) 
								VALUES ('".$idDptoDep[$i]."','".$idUsuario."','".$_SESSION['usuario']."','".$Fechacre."')";
						$insertar = mysql_query($sql);
					}
					if($insertar)
						$data=1;
				}
			}
			else
				$data=2;
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ModificarUsuario($Nombre,$Apellido,$idUsuario,$Cedula,$IDDxD){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);
			
			$idDptoDep = explode('-',$IDDxD);
			$Tamano = sizeof($idDptoDep);
			
			$sql = "UPDATE usuario SET Nombre='".$Nombre."',Apellido='".$Apellido."',Cedula='".$Cedula."' 
					WHERE idUsuario='".$idUsuario."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "DELETE FROM usuario_Dpto WHERE idUsuario='".$idUsuario."'";
				$insertar = mysql_query($sql);
				if($insertar){
					for($i=0;$i<$Tamano;$i++){
						$sql = "INSERT INTO Usuario_Dpto (idDpto_Dep,idUsuario,Usuario_Creador,Fecha_Creacion) 
								VALUES ('".$idDptoDep[$i]."','".$idUsuario."','".$_SESSION['usuario']."','".$Fechacre."')";
						$insertar = mysql_query($sql);
					}
					$Cnx->Desconectar();
					if($insertar)
						$this->ConsultaUsuarios();
					else{
						$Mensaje = "'Error: Fallo el registro'";
						$this->Atras($Mensaje);
					}
				}
				else{
					$Cnx->Desconectar();
					$Mensaje = "'Error: Fallo el registro'";
					$this->Atras($Mensaje);
				}
			}
			else
				$Cnx->Desconectar();
		}
		function GuardarClave($idUsuario,$Contrasena){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE usuario SET Clave='".$Contrasena."' WHERE idUsuario='".$idUsuario."'";
			$insertar = mysql_query($sql);
			$Cnx->Desconectar();
			if($insertar)
				$data=$Contrasena;
			else
				$data=0;
			echo json_encode($data);
		}
	}
?>