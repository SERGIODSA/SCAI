<?php
	class Operaciones{
		private function IniciarRol(){
			// Mantenimiento
			$_SESSION['Parametros'] = 0;
			$_SESSION['Departamentos'] = 0;
			$_SESSION['Localizaciones'] = 0;
			$_SESSION['ValorDoc'] = 0;
			$_SESSION['TipoCarpeta'] = 0;
			// Procesos
			$_SESSION['IngresarTRD'] = 0;
			$_SESSION['ModificarTRD'] = 0;
			$_SESSION['Desincorporar'] = 0;
			$_SESSION['RegistroPrestamo'] = 0;
			$_SESSION['DevolverPrestamo'] = 0;
			// Consultas
			$_SESSION['ConsultaPrestamo'] = 0;
			$_SESSION['ConsultaCarpetas'] = 0;
			$_SESSION['ConsultaLocal'] = 0;
			// Seguridad
			$_SESSION['AdmonUser'] = 0;
			$_SESSION['MantMenus'] = 0;
			$_SESSION['Roles'] = 0;
			$_SESSION['AsignarRol'] = 0;
		}
		private function CargarRol($Usuario){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT DISTINCT(MR.idMenus) FROM rol_usuario RU,rol R,menu_rol MR WHERE RU.idRol=R.idRol 
					AND R.idRol=MR.idRol AND Ru.idUsuario='".$Usuario."' ORDER BY MR.idMenus";
			$query = mysql_query($sql); 

			$Cnx->Desconectar();
			
			if (mysql_num_rows($query)!=0){
				while($row = mysql_fetch_assoc($query)){
					switch($row['idMenus']){
						case '1':
							$_SESSION['Parametros'] = 1;
							break;
						case '2':
							$_SESSION['Departamentos'] = 1;
							break;
						case '3':
							$_SESSION['Localizaciones'] = 1;
							break;
						case '4':
							$_SESSION['ValorDoc'] = 1;
							break;
						case '5':
							$_SESSION['TipoCarpeta'] = 1;
							break;
						case '6':
							$_SESSION['IngresarTRD'] = 1;
							break;
						case '7':
							$_SESSION['ModificarTRD'] = 1;
							break;
						case '8':
							$_SESSION['Desincorporar'] = 1;
							break;
						case '9':
							$_SESSION['RegistroPrestamo'] = 1;
							break;
						case '10':
							$_SESSION['DevolverPrestamo'] = 1;
							break;
						case '11':
							$_SESSION['ConsultaPrestamo'] = 1;
							break;
						case '12':
							$_SESSION['ConsultaCarpetas'] = 1;
							break;
						case '13':
							$_SESSION['ConsultaLocal'] = 1;
							break;
						case '14':
							$_SESSION['AdmonUser'] = 1;
							break;
						case '15':
							$_SESSION['MantMenus'] = 1;
							break;
						case '16':
							$_SESSION['Roles'] = 1;
							break;
						case '17':
							$_SESSION['AsignarRol'] = 1;
							break;
					}
				}
			}
		}
		function VerificarDatos1($Usuario,$Clave){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT DD.idDpto,DP.Descripcion FROM usuario U, Usuario_Dpto UD,dpto_dep DD, departamento DP 
					WHERE U.idUsuario='".$Usuario."' AND U.Clave='".$Clave."' AND U.idUsuario=UD.idUsuario 
					AND UD.idDpto_Dep=DD.idDpto_Dep AND DD.idDpto=DP.idDpto ORDER BY DD.idDpto";
			$query = mysql_query($sql);
			
			$Cnx->Desconectar();
			
			if (mysql_num_rows($query)!=0){
				$i = 0;
				$j = 0;
				$temp = 0;
				while($row = mysql_fetch_assoc($query)){
					if($temp!=$row['idDpto']){
						$temp = $row['idDpto'];
						$Depauser[$j] = $row['Descripcion'];
						$idDpto[$j] = $row['idDpto'];
						$j++;
					}
					$i++;
				}
				if($i==1){
					$sql = "SELECT UD.idDpto_Dep FROM Usuario_Dpto UD,dpto_dep DD WHERE UD.idDpto_Dep=DD.idDPto_Dep 
							AND UD.idUsuario='".$Usuario."' AND DD.idDpto='".$idDpto[0]."'";
					$query = mysql_query($sql);
					if (mysql_num_rows($query)!=0){
						while($row = mysql_fetch_assoc($query)){
							$idDptoDep = $row['idDpto_Dep'];
						}
						session_start();
						$_SESSION['iddptodep'] = $idDptoDep;
						$_SESSION['dpto'] = $Depauser[0];
						$_SESSION['usuario'] = $Usuario;
						$_SESSION['clave'] = $Clave;
						
						$this->IniciarRol();
						$this->CargarRol($Usuario);
						
						header('Location: /../menu.php');
					}
				}
				else{
					$depa = 0;
					print '<div align="center"><br><br><img src="../../Imagenes/FondoLogin.png"/></div>
						   <br><div class="depas"><form name="login" action="VerificarDatos2.php" method="POST"><table align="center" width="100%" border="0">
						   <tr><td></td></tr>
						   <tr><td>&nbsp;&nbsp;Seleccione un departamento:
						   <input type="hidden" name="usuario" value="'.$Usuario.'"/>
						   <input type="hidden" name="clave" value="'.$Clave.'"/>
						   </td></tr>';
					print '<tr><td><br></td></tr><tr><td align="center"><select name="depa" id="depa" size="5" class="select">';
					for($k=0;$k<$j;$k++){
						print '<option value="'.$idDpto[$k].'-'.$Depauser[$k].'"/><span class="letra">'.$Depauser[$k].'</span></option>';
					}
					print '</select></td></tr><tr><td><br></td></tr>';
					print '<tr><td align="center"><input type="button" class="boton" value="Aceptar" onclick="logear();"/></td></tr>';
					print '</table></form></div><br><br>';
				}
			} 
			else{
				?><script>
					alert('El usuario no existe o la contrase\xF1a es incorrecta');
					window.location.href='../../index.html';
				</script><?php
			}
		}
		function VerificarDatos2($Usuario,$Clave,$Dpto,$Desc){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$i = 0;
			$sql = "SELECT DISTINCT(DE.Descripcion),UD.idDpto_Dep FROM Usuario_Dpto UD,dpto_dep DD,dependencia DE 
					WHERE UD.idDpto_Dep=DD.idDpto_Dep AND DD.idDep=DE.idDep AND UD.idUsuario='".$Usuario."' 
					AND DD.idDpto='".$Dpto."'";
			$query = mysql_query($sql);
			
			$Cnx->Desconectar();
			
			if (mysql_num_rows($query)!=0){
				while($row = mysql_fetch_assoc($query)){
					$idDptoDep[$i] = $row['idDpto_Dep'];
					$Dependencia[$i] = $row['Descripcion'];
					$i++;
				}
				if($i==1){
					session_start();
					$_SESSION['usuario'] = $Usuario;
					$_SESSION['clave'] = $Clave;
					$_SESSION['iddptodep'] = $idDptoDep[0];
					$_SESSION['dpto'] = $Dependencia[0];

					$this->IniciarRol();
					$this->CargarRol($Usuario);
					
					header('Location: ../menu.php');
				}
				else{
					print '<div align="center"><br><br><img src="../../Imagenes/FondoLogin.png"/></div>
						   <br><div class="depas"><form name="login" action="VerificarDatos3.php" method="POST"><table align="center" width="100%" border="0">
						   <tr><td colspan="2"></td></tr>
						   <tr><td colspan="2"><span class="letra">&nbsp;&nbsp;Seleccione una dependencia:</span>
						   <input type="hidden" name="usuario" value="'.$Usuario.'"/>
						   <input type="hidden" name="clave" value="'.$Clave.'"/>
						   </td></tr>';
					print '<tr><td><br></td></tr><tr><td align="center"><select name="depe" id="depe" size="5" class="select">';
					for($j=0;$j<$i;$j++){
						print '<option value="'.$idDptoDep[$j].'-'.$Desc.'"><span class="letra">'.$Dependencia[$j].'</span></option>';
					}
					print '</select></td></tr><tr><td><br></td></tr>';
					print '<tr><td align="center"><input type="button" class="boton" value="Aceptar" onclick="logear();"/></td></tr>';
					print '</table></form></div><br><br>';
				}
			}
			else{
				?><script>
					alert('Error al intentar cargar la informacion del usuario');
					window.location.href='../../index.html';
				</script><?php
			}
		}
		function VerificarDatos3($Usuario,$Clave,$idDptoDep,$Depa){
			session_start();
			$_SESSION['usuario'] = $Usuario;
			$_SESSION['clave'] = $Clave;
			$_SESSION['iddptodep'] = $idDptoDep;
			$_SESSION['dpto'] = $Depa;

			$this->IniciarRol();
			$this->CargarRol($Usuario);	

			header('Location: ../menu.php');
		}
	}
?>