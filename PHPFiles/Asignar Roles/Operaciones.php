<?php
	class Operaciones{
		function __construct(){
			$this->Url = "'ConsultaUsuariosxRol.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function ConsultaUsuariosxRol(){   
			// RUTA ASIGNAR ROLES
			$AUrl = "'AsignarRoles.php'";
			// ------------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = 'SELECT idUsuario,Nombre,Apellido,Cedula FROM usuario';           
			$query = mysql_query($sql);    
			$Cnx->Desconectar();	
			
			if(mysql_num_rows($query)>0){
				print '<div class="tablaadmin">
				<table width="100%" border="1" cellspacing="1" cellpadding="0">
				<tr>
					<td class="tituloformulario" width="14%">ID Usuario</td>
					<td class="tituloformulario" width="23%">Nombre</td>
					<td class="tituloformulario" width="23%">Apellido</td>
					<td class="tituloformulario" width="12%">Cedula</td>
					<td class="tituloformulario" width="18%">Acciones</td>
				</tr>';
				while($row = mysql_fetch_assoc($query)){
					$APar = "'idUsuario=".$row['idUsuario']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['idUsuario'].'</td>
							<td class="cuerpoformulario">'.$row['Nombre'].'</td>
							<td class="cuerpoformulario">'.$row['Apellido'].'</td>
							<td class="cuerpoformulario">'.$row['Cedula'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="EnvioGet('.$AUrl.','.$APar.','.$this->Cont.');">Asignar Roles</span></td>
						</tr>';
				}
				print '</table></div><br><br>';		
			}
		}
		function AsignarRoles($idUsuario){
			// RUTA AGREGAR ROLES
			$AUrl = "'AgregarRoles.php'";
			$APar = "'idUsuario=".$idUsuario."'";
			// RUTA QUITAR ROLES
			$QUrl = "'QuitarRoles.php'";
			$QPar = $APar;
			// ------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$idAcceso = null;
			$i = 0;
			$sql = "SELECT R.idRol,R.Nombre_Rol FROM rol R,rol_usuario RU WHERE R.idRol=RU.idRol AND RU.idUsuario='".$idUsuario."'";
			$query = mysql_query($sql);  
			if(mysql_num_rows($query)<=0){
				print '<div class="accesousuario"><br></div>';
			}
			else{
				print '<div class="accesousuario">
				<div class="leyenda"><span class="subtitulo">Roles Asignados al usuario:</span>&nbsp;&nbsp;'.$idUsuario.'</div><br>
				<form name="acc2"><div class="tablaacceso2">
						<table width="100%" border="1" cellspacing="1" cellpadding="0">
						<tr>
							<td class="tituloformulario" width="7%"><br></td>
							<td class="tituloformulario" width="72%">Rol</td>
						</tr>';
				while($row = mysql_fetch_assoc($query)){
					$NombreRol[$i] = $row['Nombre_Rol'];			
					print '<tr>
							<td class="cuerpoformulario"><input type="checkbox" value="'.$row['idRol'].'" name="seleccion2" id="seleccion2"></td>
							<td class="cuerpoformulario">'.$row['Nombre_Rol'].'</td>
						</tr>';
					$i++;
				}
				print '</table></div><br><br></form></div>';	
			}
			print '<div class="botones"><br><br><br><br>
				<input type="button" class="boton" value="Agregar &#62;&#62;" onclick="AgregarRol('.$AUrl.','.$APar.','.$this->Cont.');"/><br><br>
				<input type="button" class="boton" value="&#60;&#60; Quitar" onclick="QuitarRol('.$QUrl.','.$QPar.','.$this->Cont.');"/><br><br>
				<input type="button" class="boton" value="Finalizar" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/>
			</div>';
			$sql = "SELECT idRol,Nombre_Rol FROM rol";
			$query = mysql_query($sql);  
			$Cnx->Desconectar();
			if(mysql_num_rows($query)<=0){
				print '<div class="accesototal"><br></div>';
			}
			else{
				$x = 0;
				while($row = mysql_fetch_assoc($query)){
					$band = '0';
					for($j=0;$j<$i;$j++){
						if($row['Nombre_Rol']==$NombreRol[$j])
							$band = '1';
					}
					if(($x==0)&&($band==0)){
						print '<div class="accesototal">
						<div class="leyenda"><span class="subtitulo">Roles disponibles</span></div><br>
						<form name="acc"><div class="tablaacceso2">
						<table width="100%" border="1" cellspacing="1" cellpadding="0">
						<tr>
							<td class="tituloformulario" width="7%"><br></td>
							<td class="tituloformulario" width="72%">Rol</td>
						</tr>';
						$x = 1;
					}
					if($band=='0'){
						print '<tr>
									<td class="cuerpoformulario"><input type="checkbox" value="'.$row['idRol'].'" name="seleccion" id="seleccion"></td>
									<td class="cuerpoformulario">'.$row['Nombre_Rol'].'</td>
								</tr>';
					}
				}
				print '</table></div><br><br></form></div><br><br>';
			}
		}
		function AgregarRol($idUsuario,$IDR){
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			$idRol = explode('-',$IDR);
			$n = sizeof($idRol);
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			for($i=0;$i<$n;$i++){
				$sql = "INSERT INTO Rol_Usuario (idRol,idUsuario,Usuario_Creador,Fecha_Creacion) 
						VALUES ('".$idRol[$i]."','".$idUsuario."','".$_SESSION['usuario']."','".$Fecha."')";
				$insertar = mysql_query($sql);
			}
			$Cnx->Desconectar();
			if($insertar)
				$this->AsignarRoles($idUsuario);
			else{
				$Mensaje = "Error: Fallo el registro";
				$this->Atras($Mensaje);
			}
		}
		function QuitarRoles($idUsuario,$IDR){
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$idRol = explode('-',$IDR);
			$n = sizeof($idRol);
			for($i=0;$i<$n;$i++){
				$sql = "DELETE FROM Rol_Usuario WHERE idUsuario='".$idUsuario."' AND idRol='".$idRol[$i]."'";
				$eliminar = mysql_query($sql);
			}
			$Cnx->Desconectar();
			if($eliminar)
				$this->AsignarRoles($idUsuario);
			else{
				$Mensaje = "Error: Fallo el registro";
				$this->Atras($Mensaje);
			}
		}
	}
?>