<?php
	class Operaciones{
		private function Atras($Mensaje,$Url,$Par,$Cont){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioPost('.$Url.','.$Par.','.$Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function CrearTRD(){
			include('../PHPs Compartidos/Valor/CargarValores.php');
			include('../PHPs Compartidos/Tipo/CargarTipo.php');
			include_once('../Conexion.php');
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Tiempo = new Tiempo;
			$Valor = new Valor;
			$Tipo = new tipo;
			$Cnx = new Conexion;
			$Cnx->Conectar();
			// RUTA INSERTAR CAJA
			$Url = "'InsertarCaja.php'";
			$Cont = "'resultados'";
			// ------------------
			print'<div class="formulario"><form name="trd">
			<table border="0" cellspacing="3" align="center">
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td colspan="4" class="subtitulo">Datos de la Carpeta</td>
				</tr>
				<tr><td colspan="4"><hr></td></tr>
				<tr>
					<td align="right" class="letra">Num. Serie</td>
					<td colspan="3">
						<table width="100%" border="0">
							<tr>
								<td align="right" width="40%">&nbsp;&nbsp;<input type="text" name="nserieinf" id="nserieinf" maxlength="8" size="12" class="cajas"/></td>
								<td align="center" width="5%">&nbsp;-&nbsp;</td>
								<td colspan="2" align="left"><input type="text" name="nseriesup" id="nseriesup" maxlength="8" size="12" class="cajas"/></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="letra" align="right">Descripcion Serie</td>
					<td colspan="3">&nbsp;&nbsp;<input type="text" name="serie" id="serie" maxlength="30" size="44" class="cajas"/></td>
				</tr>
				<tr>
					<td class="letra" align="right">Descripcion Subserie</td>
					<td colspan="3">&nbsp;&nbsp;<textarea name="subserie" id="subserie" maxlength="100" rows="2" cols="44" class="cajas"></textarea></td>
				</tr>
				<tr>
					<td class="letra" align="right">Fecha Inicial</td>
					<td class="letra">&nbsp;&nbsp;<input type="text" class="fechas" name="fecha1" id="fecha1" align="center" size="8" readonly/></td>
					<td class="letra" align="right">Fecha Final&nbsp;&nbsp;</td>
					<td class="letra"><input type="text" class="fechas" name="fecha2" id="fecha2" align="center" size="8" readonly/></td>
				</tr>
				<tr>
					<td class="letra" align="right">Valor</td>
					<td width="27%">&nbsp;&nbsp;<span id="limpieza">';
					$Valor->CargaValores('cajas');	
			print '</span>
					</td>
					<td align="right">Fecha a destruir&nbsp;&nbsp;</td>
					<td id="retencion"><input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" style="{background-color: #E6E6E6;}" readonly/></td>
				</tr>
				<tr>
					<td class="letra" align="right">Tipo de carpeta</td>
					<td colspan="4">&nbsp;&nbsp;';									
					$Tipo->CargaTipo('cajas'); 
			print '</td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td colspan="8" class="subtitulo">Datos de la transferencia</td>
				</tr>	
				<tr><td colspan="4"><hr></td></tr>						
				<tr>
					<td align="right">Fecha</td>
					<td>&nbsp;&nbsp;<input type="text" class="fechas" name="fecha3" id="fecha3" align="center" size="8" readonly/></td>
					<td align="right" class="letra">Hora&nbsp;&nbsp;</td>
					<td>';
					$Tiempo->Hora('1','cajas'); print ':'; $Tiempo->Minuto('1','cajas'); 
			print '</td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td colspan="4" align="center"><input type="button" value="Insertar en Caja" class="boton" onclick="InsertarEnCaja('.$Url.','.$Cont.');"></td>
				</tr>
			</table>
			</form></div>';
			$Cnx->Desconectar();
		}
		function InsertarCaja($Serie,$Subserie,$Fechatran,$nSerieInf,$nSerieSup,$Tipo,$Finicial,$Ffinal,$Fdestruc,$idValor){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$fila = null;
			$estante = null;  
			// RUTA CREAR CAJA
			$NUrl = "'CrearCaja.php'";
			$NPar = "'Fechatran=".$Fechatran."&nSerieInf=".$nSerieInf."&nSerieSup=".$nSerieSup."&Serie=".$Serie."&Subserie=".$Subserie."&Tipo=".$Tipo."&Finicial=".$Finicial."&Ffinal=".$Ffinal."&Fdestruc=".$Fdestruc."&idValor=".$idValor."'";
			$NCont = "'resultados'";
			// RUTA GUARDAR CARPETA
			$GUrl = "'GuardarTRD.php'";
			$GCont = "'resultados'";
			// RUTA INSERTAR CARPETA
			$AUrl = "'CrearTRD.php'";
			$APar = "''";
			$ACont = "'resultados'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// --------------------
			$sql = "SELECT u.idUbicacion, c.idCaja, l.Fila, l.Estante, v.Descripcion FROM caja c, localizacion l,ubicacion u, valordoc v 
					WHERE c.idUbicacion = u.idUbicacion AND u.idLocalizacion = l.idLocalizacion AND c.idValorDoc = v.idValorDoc 
					AND v.idValorDoc = ".$idValor." AND c.Disponibilidad = 'Disponible' AND c.idDpto_Dep='".$_SESSION['iddptodep']."'
					AND c.Capacidad='0' ORDER BY l.Estante,l.Fila,c.idCaja,u.idUbicacion";
			
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			print '<div class="agregar">
				<input type="button" value="Atras" class="boton" onclick="EnvioGet('.$AUrl.','.$APar.','.$ACont.');">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Crear Caja" class="boton" onclick="CrearCaja('.$NUrl.','.$NPar.','.$NCont.');">
				</div>';
			if(mysql_num_rows($query)>0){
				print '<br>';
				while($row = mysql_fetch_assoc($query)){
					if ((($fila==null)&&($estante==null))||($fila!=$row['Fila'])||($estante!=$row['Estante'])){
						if(($fila==null)&&($estante==null)){
							$fila = $row['Fila'];
							$estante = $row['Estante'];
						}
						if(($fila!=$row['Fila'])||($estante!=$row['Estante'])){
							print '</table></div><br>';
							$fila = $row['Fila'];
							$estante = $row['Estante'];
						}
						print '<div class="tamanotitulo"><table border="0" width="100%"><tr>
							<td width="25%" align="right">Estante:</td> 
							<td width="25%" align="left">&nbsp;&nbsp;'.$estante.'</td>
							<td width="25%" align="right">Fila:</td> 
							<td align="left">&nbsp;&nbsp;'.$fila.'</td>
							</tr></table>
						</div>
						<div class="tablaespacio">						
						<table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="20%" class="tituloformulario">ID Caja</td>
								<td width="20%" class="tituloformulario">Ubicacion</td>
								<td class="tituloformulario">Acciones</td>
							</tr>';
					}

					$GPar = "'fechatran=".$Fechatran."&nserieinf=".$nSerieInf."&nseriesup=".$nSerieSup."&serie=".$Serie."&subserie=".$Subserie."&tipo=".$Tipo."&finicial=".$Finicial."&ffinal=".$Ffinal."&fdestruc=".$Fdestruc."&idcaja=".$row['idCaja']."'";
					$PDFPar = "'fechatran=".$Fechatran."&idcaja=".$row['idCaja']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['idCaja'].'</td>
							<td class="cuerpoformulario">'.$row['idUbicacion'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Caja.png"><span style="cursor:pointer;" onclick="InsertarCarpeta('.$GUrl.','.$GPar.','.$PDFUrl.','.$PDFPar.');">Insertar Carpeta</span></td>
						</tr>';
				}
			}
			print '</table></div><br><br>';		
		}
		function CrearCaja($Serie,$Subserie,$Fechatran,$Tipo,$nSerieInf,$nSerieSup,$Finicial,$Ffinal,$Fdestruc,$idValor){
			// RUTA GUARDAR CAJA
			$GUrl = "'GuardarCaja.php'";
			$GPar = "'serie=".$Serie."&subserie=".$Subserie."&fechatran=".$Fechatran."&tipo=".$Tipo."&nserieinf=".$nSerieInf."&nseriesup=".$nSerieSup."&finicial=".$Finicial."&ffinal=".$Ffinal."&fdestruc=".$Fdestruc."&idvalor=".$idValor."'";
			$GCont = "'resultados'";
			// RUTA BUSCAR FILA
			$BUrl = "'../PHPs Compartidos/Ubicacion/BuscarFila.php'";
			$BCont1 = "'filas'";
			$BCont2 = "'ubicacion'";
			// RUTA INSERTAR CAJA
			$AUrl = "'InsertarCaja.php'";
			$APar = $GPar;
			$ACont = "'resultados'";
			// ------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT Distinct(l.Estante) FROM localizacion l,ubicacion u WHERE l.idLocalizacion=u.idLocalizacion AND u.Disponibilidad='Vacante' ORDER BY(l.Estante)";
			$query = mysql_query($sql);     
			$Cnx->Desconectar();
			if(mysql_num_rows($query)<=0){
				print 'No existen registros';	
			}
			else{
				print '<br><br><br><div class="formcaja"><table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
					<tr>
						<td colspan="2" class="titulobold">Nueva caja</td>
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
					<tr>
						<td colspan="2" class="subtitulo">Ubicacion</td>
					</tr>
					<tr>
						<td class="izqeditform">Estante&nbsp;&nbsp;</td>
						<td>
							<select name="estante" class="dereditform2" id="estante" onchange="Fila('.$BUrl.','.$BCont1.','.$BCont2.');">
								<option value="0"></option>';
							while($row = mysql_fetch_assoc($query)){
								print '<option value="'.$row['Estante'].'">'.$row['Estante'].'</option>';
							}
							print '</select>
						</td>
					</tr>
					<tr id="filas">
					</tr>
					<tr id="ubicacion">
					</tr>
					<tr>
						<td colspan="2"><br></td>
					</tr>
					<tr>
						<td align="center" width="50%"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EnvioPost('.$AUrl.','.$APar.','.$ACont.');"/></td>
						<td align="center"><input type="button" class="boton" name="guardar" id="guardar" value="Guardar" onclick="GuardarCaja('.$GUrl.','.$GPar.','.$GCont.');"/></td>
					</tr>
				</table></div>';
			}
		}
		function GuardarCaja($Serie,$Subserie,$Fechatran,$Tipo,$nSerieInf,$nSerieSup,$Finicial,$Ffinal,$Fdestruc,$idValor,$idUbicacion){
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			// RUTA BOTON ATRAS (INSERTAR EN CAJA)
			$AUrl = "'InsertarCaja.php'";
			$APar = "'serie=".$Serie."&subserie=".$Subserie."&fechatran=".$Fechatran."&tipo=".$Tipo."&nserieinf=".$nSerieInf."&nseriesup=".$nSerieSup."&finicial=".$Finicial."&ffinal=".$Ffinal."&fdestruc=".$Fdestruc."&idvalor=".$idValor."'";
			$ACont = "'resultados'";
			
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sqlcaja = "INSERT INTO Caja (idDpto_Dep,idUbicacion,idValorDoc,Disponibilidad,Usuario,Fecha_Creacion) VALUES ('".$_SESSION['iddptodep']."','".$idUbicacion."',".$idValor.",'Disponible','".$_SESSION['usuario']."','".$Fecha."')";
			$insertarcaja = mysql_query($sqlcaja);
			if($insertarcaja){
				$sqlubi = "UPDATE ubicacion SET Disponibilidad='Ocupado' WHERE idUbicacion='".$idUbicacion."'";
				$insertarubi = mysql_query($sqlubi);
				$Cnx->Desconectar();
				if($insertarubi){
					$this->InsertarCaja($Serie,$Subserie,$Fechatran,$nSerieInf,$nSerieSup,$Tipo,$Finicial,$Ffinal,$Fdestruc,$idValor);
				}
				else{
					$Mensaje = 'Error: Fallo el registro';
					$this->Atras($Mensaje,$AUrl,$APar,$ACont);
				}
			}
			else{
				$Cnx->Desconectar();
				$Mensaje = 'Error: Fallo el registro';
				$this->Atras($Mensaje,$AUrl,$APar,$ACont);
			}
		}
		function InsertarCarpeta($Serie,$Subserie,$nSerieInf,$nSerieSup,$Tipo,$idCaja,$Capacidad,$Finicial,$Ffinal,$Fechatran,$FDest,$Fechacre){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "UPDATE caja SET Capacidad='".$Capacidad."' WHERE idCaja='".$idCaja."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "INSERT INTO carpeta (idCaja,idTipoCarpeta,idUsuario,Fecha_Ini,Fecha_Fin,Serie,Subserie,nSerieInf,
						nSerieSup,FechaMaxRet,Fecha_Creacion) VALUES ('".$idCaja."','".$Tipo."','".$_SESSION['usuario']."','".$Finicial."',
						'".$Ffinal."','".$Serie."','".$Subserie."','".$nSerieInf."','".$nSerieSup."','".$FDest."','".$Fechacre."')";
				$insertar = mysql_query($sql);
				if($insertar){
					$idCarpeta = mysql_insert_id();
					$sql = "INSERT INTO traslado (idCarpeta,Usuario,Fecha_Traslado,Fecha_Creacion) VALUES ('".$idCarpeta."','".$_SESSION['usuario']."',
						   '".$Fechatran."','".$Fechacre."')";
					$insertar = mysql_query($sql);
					$Cnx->Desconectar();
					if($insertar){
						$data = $idCaja;
						echo json_encode($data);
					}
					else{
						$data=0;
						echo json_encode($data);
					}
				}
				else{
					$Cnx->Desconectar();
					$data=0;
					echo json_encode($data);
				}
			}
			else{
				$Cnx->Desconectar();
				$data=0;
				echo json_encode($data);
			}	
		}
		function BuscarRetencion($idValorDoc,$Ffinal){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Anos_Ret FROM valordoc WHERE idValorDoc='".$idValorDoc."'";
			$query = mysql_query($sql); 
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query))
					$ret = $row['Anos_Ret'];
			}
			list($dia, $mes, $ano) = explode('-',$Ffinal);
			$ano = $ano + $ret;
			$destruccion = $dia."-".$mes."-".$ano;
			print '<input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" value="'.$destruccion.'" style="{background-color: #E6E6E6;}" readonly/>';
		}
	}
?>