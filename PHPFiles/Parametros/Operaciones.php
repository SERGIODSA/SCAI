<?php	
	class Operaciones{	
		function __construct(){
			$this->Url = "'BuscarPar.php'";
			$this->Par = "''";
			$this->Cont = "'resultados'";
		}
		private function Atras($Mensaje){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"/></span>
			<br><span align="center" class="atras">'.$Mensaje.'</span>';
		}
		function BuscarParametro(){ 
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			// RUTA AGREGAR PARAMETRO
			$AUrl = "'AgregarPar.php'";
			$AFoco = "'descripcion'";
			// RUTA EDITAR PARAMETRO
			$EUrl = "'EditarPar.php'";
			$EFoco = "'valor'";
			// ----------------------			
			$sql = 'SELECT * FROM parametro';           
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			print '<div class="nuevo2">
			<input type="button" class="boton" name="nuevo" class="boton" id="nuevo" value="Nuevo Parametro" onclick="EnvioGet('.$AUrl.','.$this->Par.','.$this->Cont.','.$AFoco.');">
			</div>';				
			if(mysql_num_rows($query)>0){			
				print '<br><div class="tablapar">
					<table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td width="8%" class="tituloformulario">ID</td>
						<td class="tituloformulario">Descripcion</td>
						<td width="9%" class="tituloformulario">Valor</td>
						<td width="20%" class="tituloformulario">Fecha de creacion</td>
						<td width="13%" class="tituloformulario">Acciones</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					list($ano, $mes, $dia) = explode('-',$row['Fecha_Creacion']);
					$fe = $dia."-".$mes."-".$ano;
					$EPar = "'id=".$row['idParametro']."'";
					print '<tr>
								<td class="cuerpoformulario">'.$row['idParametro'].'</td>
								<td class="cuerpoformulario">'.$row['Descripcion'].'</td>
								<td class="cuerpoformulario">'.$row['Valor'].'</td>
								<td class="cuerpoformulario">'.$fe.'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EnvioGet('.$EUrl.','.$EPar.','.$this->Cont.','.$EFoco.');">Editar</span></td>
							</tr>';
							
				}
				print '</table></div>';	
			}
		}
		function CrearParametro(){
			// RUTA GUARDAR
			$GUrl = "'GuardarPar.php'";
			// ------------
			print '<br><br><br><div class="tablapar2">
			<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="2" class="titulobold">Nuevo parametro</td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
					<td><textarea name="descripcion" class="dereditform" id="descripcion" cols="16" maxlength="40" rows="2"/></textarea></td>
				</tr>
				<tr>
					<td class="izqeditform">Valor&nbsp;&nbsp;</td>
					<td><input type="text" name="valor" class="dereditform" id="valor" size="17" maxlength="5"/></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
					<td align="center"><input type="button" class="boton" name="guardar" class="boton" id="guardar" value="Guardar" onclick="GuardarParametro('.$GUrl.','.$this->Cont.');"></td>
				</tr>
			</table></div>';
		}
		function EditarParametro(){
			// RUTA MODIFICAR
			$MUrl = "'ModificarPar.php'";
			include('../Conexion.php');
			$idParametro = $_GET['id'];
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = 'SELECT idParametro,Descripcion,Valor FROM parametro WHERE idParametro='.$idParametro;
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)<=0){
				$Mensaje = 'No se encontraron registros';
				$this->Atras($Mensaje);			
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					print '<br><br><br><div class="tablapar2">
						<table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
						<tr>
							<td colspan="2" class="titulobold">Edicion de parametro</td>
						</tr>
						<tr>
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td class="izqeditform">Descripcion&nbsp;&nbsp;</td>
							<td><textarea name="descripcion" class="dereditform" id="descripcion" cols="16" maxlength="40" rows="2" style="{background-color: #E6E6E6;}" readonly/>'.$row['Descripcion'].'</textarea></td>
						</tr>
						<tr>
							<td class="izqeditform">Valor&nbsp;&nbsp;</td>
							<td><input type="text" value="'.$row['Valor'].'" name="valor" class="dereditform" id="valor" maxlength="5" size="17" /></td>
						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
							<td align="center" width="50%"><input type="button" class="boton" ame="atras" id="atras" value="Atras" onclick="EnvioGet('.$this->Url.','.$this->Par.','.$this->Cont.');"></td>
							<td align="center"><input type="button" class="boton" name="modificar" id="modificar" value="Modificar" onclick="ModificarParametro('.$MUrl.','.$row['idParametro'].','.$this->Cont.');"></td>
						</tr>
					</table></div>';
				}
			}
			$Cnx->Desconectar();
		}
		function GuardarParametro(){	
			if (get_magic_quotes_gpc()!=1)
				$Desc = addslashes($_GET['desc']);
			else
				$Desc = $_GET['desc'];
			$Descripcion = htmlentities($Desc);
			
			$Valor = $_GET['val'];
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "INSERT INTO parametro (Usuario,Descripcion,Valor,Fecha_Creacion,idDpto_Dep) VALUES ('".$_SESSION['usuario']."','".$Descripcion."','".$Valor."','".$Fecha."','".$_SESSION['iddptodep']."')";
			$insertar = mysql_query($sql);
			$Cnx->Desconectar();
			if($insertar){
				$this->BuscarParametro();
			}
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
		function ModificarParametro(){
			$idParametro = $_GET['idp'];
			$Valor = $_GET['val'];
			
			if (get_magic_quotes_gpc()!=1)
				$Desc = addslashes($_GET['desc']);
			else
				$Desc = $_GET['desc'];
			$Descripcion = htmlentities($Desc);
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE parametro SET Descripcion='".$Descripcion."',Valor='".$Valor."' WHERE idParametro='".$idParametro."'";
			$actualizar = mysql_query($sql);
			$Cnx->Desconectar();
			if($actualizar)
				$this->BuscarParametro();
			else{
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje);
			}
		}
	}
?>