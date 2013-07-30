<?php
	class Operaciones{
		private function Atras($Mensaje,$Url,$Par,$Cont){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioPost('.$Url.','.$Par.','.$Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function MostrarCarpetas($idDptoDep,$Expirar){
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$Cont = "'resultados'";
			// RUTA CONSERVAR CARPETA
			$CUrl = "'Conservar.php'";
			// RUTA DESTRUIR CARPETA
			$DUrl = "'Destruir.php'";
			// ----------------------
			$dia = 86400;
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			$Hoy = "'".date("d-m-Y",$f)."'";
			$sql = "SELECT CP.FechaMaxRet,CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.Fecha_Ini,CP.Fecha_Fin,
					CP.nSerieInf,CP.nSerieSup,V.Descripcion,CJ.Capacidad FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
					WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
				    AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc AND CJ.idDpto_Dep='".$idDptoDep."' AND CJ.Disponibilidad='Disponible'";
			switch($Expirar){
				case '1':
					$sql = $sql." AND CP.FechaMaxRet<'".$Fecha."'";
					break;
				case '3':
					$sql = $sql." AND CP.FechaMaxRet>='".$Fecha."'";
					break;
				case '4':
					$fe = time()-16200-($dia*7);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
				case '5':
					$fe = time()-16200-($dia*15);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
				case '6':
					$fe = time()-16200-($dia*30);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
				case '7':
					$fe = time()-16200-($dia*60);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
				case '8':
					$fe = time()-16200-($dia*90);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
				case '9':
					$fe = time()-16200-($dia*180);
					$Fprox = date("Y-m-d",$fe);
					$sql = $sql." AND CP.FechaMaxRet>='".$Fprox."' AND CP.FechaMaxRet<='".$Fecha."'";
					break;
			}
			$sql = $sql." ORDER BY L.Estante,L.Fila,U.idUbicacion,CJ.idCaja,CP.idCarpeta";
			$query = mysql_query($sql);
			$Cnx->Desconectar();
			$caja = 0;
			$ubicacion = 0;
			$estante = 0;
			$fila = 0;
			if(mysql_num_rows($query)<=0){
				print '<span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
			}
			else{
				while($row = mysql_fetch_assoc($query)){
				list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
				$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
				list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
				$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
				list($ano3, $mes3, $dia3) = explode('-', $row['FechaMaxRet']);
				$fecha3 = $dia3.'-'.$mes3.'-'.$ano3;
				if((($caja==0)&&($ubicacion==0)&&($estante==0)&&($fila==0))||($caja!=$row['idCaja'])||($ubicacion!=$row['idUbicacion'])||($fila!=$row['Fila'])||($estante!=$row['Estante'])){
					if(($caja==0)&&($ubicacion==0)&&($estante==0)&&($fila==0)){
						$estante = $row['Estante'];
						$fila = $row['Fila'];
						$caja = $row['idCaja'];
						$ubicacion = $row['idUbicacion'];
						print '<div class="bordetit"><table width="30%" border="0" align="center">
						<tr>
							<td align="center"><span class="subtitulo">Estante</span></td>
							<td><span class="numero">'.$estante.'</span></td>
							<td><span class="numero">-</span></td>
							<td align="center"><span class="subtitulo">Fila</span></td>
							<td><span class="numero">'.$fila.'</span></td>
						</tr>
						</table></div><br>';
					}
					if(($estante!=$row['Estante'])||($fila!=$row['Fila'])){
						print '</table></div><br>';
						$estante = $row['Estante'];
						$fila = $row['Fila'];
						$caja = $row['idCaja'];
						$ubicacion = $row['idUbicacion'];
						print '<div class="bordetit"><table width="30%" border="0" align="center">
					<tr>
						<td align="center"><span class="subtitulo">Estante</span></td>
						<td><span class="numero">'.$estante.'</span></td>
						<td><span class="numero">-</span></td>
						<td align="center"><span class="subtitulo">Fila</span></td>
						<td><span class="numero">'.$fila.'</span></td>
					</tr>
					</table></div><br>';
					}
					if(($caja!=$row['idCaja'])||($ubicacion!=$row['idUbicacion'])){
						print '</table></div><br>';
						$caja = $row['idCaja'];
						$ubicacion = $row['idUbicacion'];
					}
				print '<table width="100%" border="0" align="center">
					<tr>
						<td width="15%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
						<td width="15%">'.$row['idUbicacion'].'</td>
						<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
						<td width="15%">'.$row['idCaja'].' '; if($row['Capacidad']=='1') print('(Llena)'); print '</td>
						<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
						<td width="15%">'.$row['Descripcion'].'</td>
					</tr>
				</table>
					<div class="tablades"><table width="100%" border="1" cellspacing="1" cellpadding="0">
					<tr>
						<td class="tituloformulario" width="8%">ID Carpeta</td>
						<td class="tituloformulario" width="14%">No. Serie</td>
						<td class="tituloformulario" width="33%">Serie</td>
						<td class="tituloformulario" width="8%">Fecha Inicial</td>
						<td class="tituloformulario" width="8%">Fecha Final</td>
						<td class="tituloformulario" width="8%">F. Max. Ret.</td>
						<td class="tituloformulario" colspan="2" width="16%">Acciones</td>
					</tr>';
				}
				$CPar = "'idcarpeta=".$row['idCarpeta']."&expirar=".$Expirar."'";
				$DPar = "'idcaja=".$row['idCaja']."&idcarpeta=".$row['idCarpeta']."&expirar=".$Expirar."'";
				print '<tr>
						<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
						<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
						<td class="cuerpoformulario">'.$row['Serie'].'</td>
						<td class="cuerpoformulario">'.$fecha1.'</td>
						<td class="cuerpoformulario">'.$fecha2.'</td>
						<td class="cuerpoformulario">'.$fecha3.'</td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Insertar.png"><span style="cursor:pointer;" onclick="Conservar('.$CUrl.','.$CPar.','.$Cont.','.$Hoy.');">Conservar</span></td>
						<td class="cuerpoformulario"><img src="../../Imagenes/Eliminar.png"><span style="cursor:pointer;" onclick="Destruir('.$DUrl.','.$DPar.','.$Cont.','.$Hoy.');">Destruir</span></td>
					</tr>';
				}
				print '</table></div><br><br>';	
			}
		}
		function Conservar($idCarpeta,$Expirar){
			// RUTA ATRAS
			$AUrl = "'BuscarDes2.php'";
			$AContenedor = "'resultados'";
			// RUTA GUARDAR PDF SIN MODIFICAR VALOR
			$Url = "'GuardarTRD1.php'";
			// RUTA INSERTAR EN CAJA
			$CUrl = "'ConservarTRD2.php'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// ----------
			include('../Conexion.php');
			include('../PHPs Compartidos/Valor/CargarValores.php');
			include('../PHPs Compartidos/Tipo/CargarTipo.php');
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Tiempo = new Tiempo;
			$Cnx = new Conexion;
			$Valor = new Valor;
			$Tipo = new tipo;
			$Cnx->Conectar();

			$f = time()-16200;
			$Fee = "'".date("Y-m-d",$f)."'";
			$sql = "SELECT CP.idCaja,CP.Fecha_Ini,CP.Fecha_Fin,CP.Serie,CP.Subserie,CP.nSerieInf,CP.nSerieSup,V.idValorDoc,CP.FechaMaxRet,
					TC.Descripcion FROM carpeta CP,tipocarpeta TC,valordoc V,caja CJ WHERE CP.idcarpeta='".$idCarpeta."' 
					AND CP.idTipoCarpeta=TC.idTipoCarpeta AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc";
			$query = mysql_query($sql);
			if(mysql_num_rows($query)<=0){
				print 'No existen registros';
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
					$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
					list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
					$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
					$Fmr = "'".$row['FechaMaxRet']."'";
					print'<div class="formulario2">
						<table border="0" cellspacing="3" align="center">
							<tr>
								<td colspan="4"><br></td>
							</tr>
							<tr>
								<td colspan="4" class="subtitulo">Datos de la Carpeta</td>
							</tr>
							<tr>
								<td colspan="4"><hr></td>
							</tr>
							<tr>
								<td align="right" class="letra">Num. Serie</td>
								<td colspan="3">
									<table width="100%" border="0">
										<tr>
											<td align="right" width="40%">&nbsp;&nbsp;<input type="text" name="nserieinf" maxlength="8" size="12" class="dereditform" value="'.$row['nSerieInf'].'" style="{background-color: #E6E6E6;}" readonly/></td>
											<td align="center" width="5%">&nbsp;-&nbsp;</td>
											<td colspan="2" align="left"><input type="text" name="nseriesup" maxlength="8" size="12" class="dereditform" value="'.$row['nSerieSup'].'" style="{background-color: #E6E6E6;}" readonly/></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td class="letra" align="right">Descripcion Serie</td>
								<td colspan="3">&nbsp;&nbsp;<input type="text" name="serie" maxlength="30" size="44" class="cajas" value="'.$row['Serie'].'" style="{background-color: #E6E6E6;}" readonly/></td>
							</tr>
							<tr>
								<td class="letra" align="right">Descripcion Subserie</td>
								<td colspan="3">&nbsp;&nbsp;<textarea name="subserie" maxlength="100" rows="2" cols="44" class="cajas" style="{background-color: #E6E6E6;}" readonly>'; print $row['Subserie']; print '</textarea></td>
							</tr>
							<tr>
								<td class="letra" align="right">Fecha Inicial</td>
								<td>&nbsp;&nbsp;<input type="text" name="fecha1" id="fecha1" maxlength="8" size="12" class="dereditform" value="'.$fecha1.'" style="{background-color: #E6E6E6;}" readonly/></td>
								<td colspan="2" class="letra" align="center">Fecha Final&nbsp;&nbsp;
								<input type="text" name="fecha2" id="fecha2" maxlength="8" size="12" class="dereditform" value="'.$fecha2.'" style="{background-color: #E6E6E6;}" readonly/><input type="hidden" value="'.$row['Fecha_Fin'].'" id="ffinal"></td>
							</tr>
							<tr>
								<td class="letra" align="right">Valor</td>								
								<td width="27%">&nbsp;&nbsp;'; $Valor->ConservarValores('cajas'); print '</td>
								<td align="right">Fecha a destruir&nbsp;&nbsp;</td>
								<td id="retencion"><input type="text" name="dest" maxlength="10" size="8" class="dereditform" style="{background-color: #E6E6E6;}" readonly/></td>
							</tr>
							<tr>
								<td class="letra" align="right">Tipo de carpeta</td>
								<td colspan="3">&nbsp;&nbsp;<input type="text" name="tipo" class="dereditform" value="'.$row['Descripcion'].'" style="{background-color: #E6E6E6;}" readonly/></td>
							</tr>
							<tr>
								<td colspan="4"><br></td>
							</tr>
							<tr>
								<td colspan="4" class="subtitulo">Datos de la transferencia</td>
							</tr>	
							<tr>
								<td colspan="4"><hr></td>
							</tr>							
							<tr>
								<td align="right" class="letra">Fecha</td>
								<td>&nbsp;&nbsp;<input type="text" class="fechas" name="fecha3" id="fecha3" align="center" size="8" readonly/></td>
								<td align="right" class="letra">Hora&nbsp;&nbsp;</td>
								<td>'; $Tiempo->hora('1','cajas'); print ':'; $Tiempo->minuto('1','cajas'); print '</td>
							</tr>
							<tr>
								<td colspan="4"><br></td>
							</tr>
							<tr><td colspan="4" align="center">';
								$Serie = "'".$row['Serie']."'";
								$Subserie = "'".$row['Subserie']."'";
								$Finicial = "'".$row['Fecha_Ini']."'";
								$Ffinal = "'".$row['Fecha_Fin']."'";
								print '<input type="button" value="Atras" class="boton" onclick="Desincorporar('.$AUrl.','.$AContenedor.','.$Expirar.');" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Insertar en Caja" class="boton" onclick="ConservarTRD('.$Url.','.$CUrl.','.$PDFUrl.','.$AContenedor.','.$row['idValorDoc'].','.$idCarpeta.','.$row['idCaja'].','.$Expirar.');"/>
							</td></tr>
						</table><br>
					</div>';
				}
			}
			$Cnx->Desconectar();
		}
		function GuardarTRD1($idCarpeta,$Fechatran,$Fdestruc){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data = 0;
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);
			list($dia, $mes, $ano) = explode('-',$Fdestruc);
			$dest = $ano."-".$mes."-".$dia;

			$sql = "UPDATE carpeta SET idUsuario='".$_SESSION['usuario']."',
					FechaMaxRet='".$dest."',Fecha_Creacion='".$Fechacre."' WHERE idCarpeta='".$idCarpeta."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "INSERT INTO traslado (idCarpeta,Usuario,Fecha_Traslado,Fecha_Creacion) 
						VALUES ('".$idCarpeta."','".$_SESSION['usuario']."','".$Fechatran."','".$Fechacre."')";
				$insertar = mysql_query($sql);
				if($insertar)
					$data = $sql;
				else
					$data = 1;
			}
			
			$Cnx->Desconectar();
			echo json_encode($data);	
		}
		function ConservarTRD2($idCarpeta,$idCaja,$idValor,$Fechatran,$Fdestruc,$Expirar){
			// RUTA CONSERVAR CARPETA
			$CUrl = "'Conservar.php'";
			$CPar = "'idcarpeta=".$idCarpeta."&expirar=".$Expirar."'";
			$CCont = "'resultados'";
			// RUTA CREAR CAJA
			$NUrl = "'CrearCaja.php'";
			$NPar = "'fechatran=".$Fechatran."&fdestruc=".$Fdestruc."&idvalor=".$idValor."&idcarpeta=".$idCarpeta."&idcaja=".$idCaja."&expirar=".$Expirar."'";
			$NCont = "'resultados'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// RUTA GUARDAR CARPETA
			$GUrl = "'GuardarTRD2.php'";
			// ----------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Hoy = "'".date("d-m-Y",$f)."'";
			$fila = null;
			$estante = null;  
			
			print '<div class="agregar">
				<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="Conservar('.$CUrl.','.$CPar.','.$CCont.','.$Hoy.');"/>
				<input type="button" value="Crear Caja" class="boton" onclick="CrearCaja('.$NUrl.','.$NPar.','.$NCont.');">
				</div>';
			
			$sql = "SELECT u.idUbicacion, c.idCaja, l.Fila, l.Estante, v.Descripcion FROM caja c, localizacion l,ubicacion u, valordoc v 
					WHERE c.idUbicacion = u.idUbicacion AND u.idLocalizacion = l.idLocalizacion AND c.idValorDoc = v.idValorDoc 
					AND v.idValorDoc = ".$idValor." AND c.Disponibilidad = 'Disponible' AND c.idDpto_Dep='".$_SESSION['iddptodep']."'
					AND c.Capacidad='0' ORDER BY l.Estante,l.Fila,c.idCaja,u.idUbicacion";
			$query = mysql_query($sql);
			$Cnx->Desconectar();
			if(mysql_num_rows($query)>0){
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
					$GPar = "'idcajav=".$idCaja."&idcaja=".$row['idCaja']."&idcarpeta=".$idCarpeta."&fechatran=".$Fechatran."&fdestruc=".$Fdestruc."'";
					$PDFPar = "'fechatran=".$Fechatran."&idcaja=".$row['idCaja']."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['idCaja'].'</td>
							<td class="cuerpoformulario">'.$row['idUbicacion'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Caja.png"><span style="cursor:pointer;" onclick="InsertarCarpeta('.$GUrl.','.$GPar.','.$PDFUrl.','.$PDFPar.');">Insertar Carpeta</span></td>
						</tr>';
				}
				print '</table></div><br><br>';		
			}
		}
		function CrearCaja($idCaja,$idCarpeta,$idValor,$Fdestruc,$Fechatran,$Expirar){
			// RUTA GUARDAR CAJA
			$GUrl = "'GuardarCaja.php'";
			$GPar = "'idcaja=".$idCaja."&idcarpeta=".$idCarpeta."&idvalor=".$idValor."&Fdestruc=".$Fdestruc."&Fechatran=".$Fechatran."&expirar=".$Expirar."'";
			$GCont = "'resultados'";
			// RUTA BUSCAR FILA
			$BUrl = "'../PHPs Compartidos/Ubicacion/BuscarFila.php'";
			$BCont1 = "'filas'";
			$BCont2 = "'ubicacion'";
			// RUTA INSERTAR CAJA
			$AUrl = "'ConservarTRD2.php'";
			$APar = $GPar;
			$ACont = "'resultados'";
			// ----------------
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT Distinct(l.Estante) FROM localizacion l,ubicacion u WHERE l.idLocalizacion=u.idLocalizacion AND u.Disponibilidad='Vacante' ORDER BY(l.Estante)";
			$query = mysql_query($sql);  
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)>0){
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
		function GuardarCaja($idCarpeta,$idCaja,$idValor,$Fechatran,$Fdestruc,$Expirar,$idUbicacion){
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			// RUTA BOTON ATRAS (INSERTAR EN CAJA)
			$AUrl = "'ConservarTRD2.php'";
			$APar = "'idcaja=".$idCaja."&idcarpeta=".$idCarpeta."&idvalor=".$idValor."&Fdestruc=".$Fdestruc."&Fechatran=".$Fechatran."&expirar=".$Expirar."'";
			$ACont = "'resultados'";
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sqlcaja = "INSERT INTO Caja (idDpto_Dep,idUbicacion,idValorDoc,Disponibilidad,Usuario,Fecha_Creacion) VALUES ('".$_SESSION['iddptodep']."','".$idUbicacion."',".$idValor.",'Disponible','".$_SESSION['usuario']."','".$Fecha."')";
			$insertarcaja = mysql_query($sqlcaja);
			if($insertarcaja){
				$sqlubi = "UPDATE ubicacion SET Disponibilidad='Ocupado' WHERE idUbicacion='".$idUbicacion."'";
				$insertarubi = mysql_query($sqlubi);
				$Cnx->Desconectar();
				if($insertarubi){
					$this->ConservarTRD2($idCarpeta,$idCaja,$idValor,$Fechatran,$Fdestruc,$Expirar);
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
		function GuardarTRD2($idCaja,$idCajav,$idCarpeta,$Capacidad,$Fechatran,$Fdestruc){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			list($dia, $mes, $ano) = explode('-',$Fdestruc);
			$dest = $ano."-".$mes."-".$dia;
			$data = 0;
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);
			
			$sql = "UPDATE caja SET Capacidad='".$Capacidad."' WHERE idCaja='".$idCaja."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "UPDATE caja SET Capacidad='0' WHERE idCaja='".$idCajav."'";
				$insertar = mysql_query($sql);
				if($insertar){
					$sql = "UPDATE carpeta SET idCaja='".$idCaja."',idUsuario='".$_SESSION['usuario']."',
							FechaMaxRet='".$dest."',Fecha_Creacion='".$Fechacre."' WHERE idCarpeta='".$idCarpeta."'";
					$insertar = mysql_query($sql);
					if($insertar){
						$sql = "INSERT INTO traslado (idCarpeta,Usuario,Fecha_Traslado,Fecha_Creacion) 
								VALUES ('".$idCarpeta."','".$_SESSION['usuario']."','".$Fechatran."','".$Fechacre."')";
						$insertar = mysql_query($sql);
						if($insertar)
							$data=1;
					}
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function Destruir($idCaja,$idCarpeta,$Expirar){
			// RUTA ATRAS
			$AUrl = "'BuscarDes2.php'";
			$AContenedor = "'resultados'";
			// RUTA DIGITALIZAR
			$DUrl = "'Digitalizacion.php'";
			$DPar = "'idcarpeta=".$idCarpeta."'";
			$DCont = "'resultados'";
			// RUTA DESTRUCCION
			$EUrl = "'Destruccion.php'";
			$EPar = "'idcarpeta=".$idCarpeta."&idcaja=".$idCaja."'";
			// RUTA DESINCORPORAR
			$Url = "'Desincorporar.php'";
			// ------------------
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Tiempo = new Tiempo;
			
			print '<br><br><div class="formcaja2"><table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="4" class="titulobold">Destruccion de carpeta</td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td colspan="4" class="subtitulo" align="center">Datos de la destruccion</td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td class="izqeditform" align="right" width="25%">Fecha&nbsp;&nbsp;</td>
					<td><input type="text" class="fechas" name="fecha4" id="fecha4" align="center" size="8" readonly/></td>
					<td class="izqeditform" align="right">Hora&nbsp;&nbsp;</td>
					<td>'; $Tiempo->Hora('3','cajas'); print'&nbsp;:&nbsp;'; $Tiempo->Minuto('3','cajas'); print'</td>
				</tr>
				<tr>
					<td colspan="4"><br></td>
				</tr>
				<tr>
					<td align="center" colspan="4">
					<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="Desincorporar('.$AUrl.','.$AContenedor.','.$Expirar.');"/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" class="boton" name="guardar" id="guardar" value="Guardar" onclick="RegistrarDestruccion('.$Url.','.$EUrl.','.$EPar.','.$DUrl.','.$DPar.','.$DCont.');">
					</td>
				</tr>
			</table></div><br><br>';
		}
		function Destruccion($idCarpeta,$idCaja,$Fechades){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data = 0;
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);

			$sql = "UPDATE caja SET Capacidad='0' WHERE idCaja='".$idCaja."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "UPDATE carpeta SET idCaja=NULL WHERE idCarpeta='".$idCarpeta."'";
				$insertar = mysql_query($sql);
				if($insertar){
					$sql = "INSERT INTO destruccion (idUsuario,idCarpeta,Dpto,Fecha_Destr,Fecha_Creacion)
							VALUES ('".$_SESSION['usuario']."','".$idCarpeta."','".$_SESSION['dpto']."','".$Fechades."','".$Fechacre."')";
					$insertar = mysql_query($sql);
					if($insertar)
						$data=1;
				}
			}
			
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function BuscarRetencion($idValor,$ARet){
			$f = time()-16200;
			$ano = date("Y",$f);
			$mes = date("m",$f);
			$dia = date("d",$f);
			$ano = $ano + $ARet;
			$destruccion = $dia."-".$mes."-".$ano;
			print '<input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" value="'.$destruccion.'" style="{background-color: #E6E6E6;}" readonly/>';
		}
		function PorVencer(){
			$url = "'BuscarDes2.php'";
			$contenedor = "'resultados'";
			print'<select name="tiempo" id="tiempo" class="cajas2" onchange="Desincorporar('.$url.','.$contenedor.');">
					<option value="0">...</option>
					<option value="4">Una semana</option>
					<option value="5">Dos semanas</option>
					<option value="6">Un mes</option>
					<option value="7">Dos meses</option>
					<option value="8">Tres meses</option>
					<option value="9">seis meses</option>
				</select>';
		}
	}
?>