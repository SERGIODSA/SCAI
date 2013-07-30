<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'ConsultaMenus.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function ConsultaMenus(){
			// RUTA VER SUBMENUS
			$VUrl = "'ConsultaSubmenus.php'";
			// -----------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();

			$sql = 'SELECT DISTINCT(Menu) FROM menu';			
			$query = mysql_query($sql);     
			
			$Cnx->Desconectar();
			
			if(mysql_num_rows($query)>0){				
				print '<br><div class="tablamenus">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
				<tr>
					<td class="tituloformulario" width="70%">Menu</td>
					<td class="tituloformulario">Acciones</td>
				</tr>';
				while($row = mysql_fetch_assoc($query)){
					$VPar = "'Menu=".$row['Menu']."'";
					print '<tr>';
					print '<td class="cuerpoformulario">'.$row['Menu'].'</td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="EnvioGet('.$VUrl.','.$VPar.','.$this->Cont.');">Ver submenus</span></td>
					</tr>';
				}
			}
			print '</table></div><br><br>';	
		}
		function ConsultaSubmenus($Menu){
			// RUTA CREAR SUBMENU
			$CUrl = "'CrearSubmenu.php'";
			$CPar = "'Menu=".$Menu."'";
			// RUTA EDITAR SUBMENU
			$EUrl = "'EditarSubmenu.php'";
			$EFoco = "'submenu'";
			// -------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Submenu,idMenus FROM menu WHERE Menu='".$Menu."'"; 
			$query = mysql_query($sql); 

			$Cnx->Desconectar();
			
			print '<div class="nuevo3">
				<input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/>
				<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Crear submenu" onclick="EnvioGet('.$CUrl.','.$CPar.','.$this->Cont.');">
				</div><br>';
			if(mysql_num_rows($query)>0){
				print '<div class="titdepa"><span class="negrita">Menu:</span> '.$Menu.'</div><br>';
				print '<div class="tablamenus">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
				<tr>
					<td class="tituloformulario" width="70%">Submenu</td>
					<td class="tituloformulario">Acciones</td>
				</tr>';
				while($row = mysql_fetch_assoc($query)){
					$EPar = "'id=".$row['idMenus']."&Menu=".$Menu."'";
					print '<tr>';
					print '<td class="cuerpoformulario">'.$row['Submenu'].'</td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$EUrl.','.$EPar.','.$this->Cont.','.$EFoco.');">Editar</span></td>
					</tr>';
				}
			}
		}
		function CrearSubmenu($Menu){
			// RUTA VER SUBMENUS
			$VUrl = "'ConsultaSubmenus.php'";
			$VPar = "'Menu=".$Menu."'";
			// RUTA GUARDAR SUBMENU
			$GUrl = "'GuardarSubmenu.php'";
			$GPar = $VPar;
			// -----------------
			print '<br><br><br><div class="tablamenus2"><form name="datos">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nuevo menu</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Submenu&nbsp;&nbsp;</td>
					<td><input type="text" name="submenu" class="dereditform" id="submenu" size="20" maxlength="20"/></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$VUrl.','.$VPar.','.$this->Cont.');"></td>
					<td align="center"><input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Guardar" onclick="GuardarSubmenu('.$GUrl.','.$GPar.','.$this->Cont.');"></td>
				</tr>
			</table></form></div>';
		}
		function EditarSubmenu($idMenu,$Menu){
			// RUTA VER SUBMENUS
			$VUrl = "'ConsultaSubmenus.php'";
			$VPar = "'Menu=".$Menu."'";
			// RUTA MODIFICAR SUBMENUS
			$MUrl = "'ModificarSubmenu.php'";
			$MPar = "'idmenus=".$idMenu."&Menu=".$Menu."'";
			// -----------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT idMenus,Menu,Submenu FROM menu WHERE idMenus='".$idMenu."'";
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					print '<br><br><br><div class="tablamenus2"><form name="datos">
						<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de submenu</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Submenu&nbsp;&nbsp;</td>
							<td><input type="text" value="'.$row['Submenu'].'" name="submenu" class="dereditform" id="submenu" maxlength="20" size="20" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$VUrl.','.$VPar.','.$this->Cont.');"></td>
							<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarSubmenu('.$MUrl.','.$MPar.','.$this->Cont.');"></td>
						</tr>
					</table></form></div>';
				}
			}
		}
		function GuardarSubmenu($Menu,$Submenu){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$sql = "INSERT INTO menu (Menu,Submenu,Usuario_Creador,Fecha_Creacion) VALUES ('".$Menu."','".$Submenu."',
					'".$_SESSION['usuario']."','".$Fecha."')";
			$actualizar = mysql_query($sql);  
			$Cnx->Desconectar(); 
			
			if($actualizar)
				$this->ConsultaSubmenus($Menu);
			else{
				$Mensaje = "No se encontraron registros";
				$this->Atras($Mensaje);
			}
		}
		function ModificarSubmenu($idMenus,$Menu,$Submenu){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$sql = "UPDATE menu SET Submenu='".$Submenu."' WHERE idMenus='".$idMenus."'";
			$actualizar = mysql_query($sql); 
			
			$Cnx->Desconectar();   		
			
			if($actualizar)
				$this->ConsultaSubmenus($Menu);
			else{
				$Mensaje = "No se encontraron registros";
				$this->Atras($Mensaje);
			}
		}
	}
?>