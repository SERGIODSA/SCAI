<?php
	class Operaciones{
		function CarpetasDestruidas($Parametro){
			$f = time()-16200;
			$Hoy = "'".date("Y-m-d",$f)."'";
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			print '<table width="100%"><tr><td>';
			print '<div class="divuno"><table width="100%" align="left" border="0" cellpadding="4">
				<tr>
					<td><input type="checkbox" name="busqueda2" value="idcarpeta" onclick="PBCP();" /></td>
					<td>ID Carpeta</td>
					<td id="op2"><input type="text" disabled="disabled" name="idcarpeta" size="8" maxlength="8" class="cajas2" id="idcarpeta"/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda3" value="nserie" onclick="BNS();"/></td>
					<td>N&#176; Serie</td>
					<td id="op3">
						<input type="text" disabled="disabled" name="serieinf" size="6" maxlength="8" class="cajas2" id="serieinf"/>
						&nbsp;-&nbsp;
						<input type="text" disabled="disabled" name="seriesup" size="6" maxlength="8" class="cajas2" id="seriesup"/>
					</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda4" value="serie" onclick="BSD();"/></td>
					<td>Serie Doc.</td>
					<td id="op4"><input type="text" disabled="disabled" name="serie" size="24" maxlength="30" class="cajas2" id="serie"/></td>
				</tr>
				<tr>	
					<td><input type="checkbox" name="busqueda8" onclick="SSE();"/></td>
					<td>Subserie Doc.</td>
					<td id="op8"><input type="text" disabled="disabled" name="subserie" size="24" maxlength="100" class="cajas2" id="subserie"/></td>
				</tr>	
				<tr>
					<td><input type="checkbox" name="busqueda6" value="fecha" onclick="BFI('.$Hoy.');" /></td>
					<td>Fecha Inicial</td>
					<td id="op6"><input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda7" value="fecha" onclick="BFF('.$Hoy.');" /></td>
					<td>Fecha Final</td>
					<td id="op7"><input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda9" onclick="DPO();" size="20"/></td>
					<td>Departamento</td>
					<td id="op9">';
					print '<select name="departamento" class="cajas2" id="departamento" disabled="disabled">';
					$sql = "SELECT idDpto,Descripcion FROM departamento";
					$query = mysql_query($sql); 
					$Cnx->Desconectar();					
					if(mysql_num_rows($query)<=0){
						print '<option value="0">...</option>';	
					}
					else{
						print '<option value="0">...</option>';	
						while($row = mysql_fetch_assoc($query)){
							print '<option value="'.$row['idDpto'].'">'.$row['Descripcion'].'</option>';
						}
					}
				print '</select> 
					</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda10" onclick="BPFD('.$Hoy.');" size="20"/></td>
					<td>Fecha de destruccion</td>
					<td id="op10"><input type="text" class="cajas2" name="fecha3" id="fecha3" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				</table></div>';
			print '</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="BusquedaTRD('.$Parametro.');">
				</td></tr></table>';
		}
		function CarpetasDisponibles($Parametro){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Hoy = "'".date("Y-m-d",$f)."'";

			print '<table width="100%"><tr><td>
					<div class="divuno"><table width="100%" align="left" border="0" cellpadding="4"><tr>
					<td><input type="checkbox" name="busqueda2" value="idcarpeta" onclick="PBCP();" /></td>
					<td>ID Carpeta</td>
					<td id="op2"><input type="text" disabled="disabled" name="idcarpeta" size="8" maxlength="8" class="cajas2" id="idcarpeta"/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda3" value="nserie" onclick="BNS();"/></td>
					<td>N&#176; Serie</td>
					<td id="op3">
						<input type="text" disabled="disabled" name="serieinf" size="6" maxlength="8" class="cajas2" id="serieinf"/>
						&nbsp;-&nbsp;
						<input type="text" disabled="disabled" name="seriesup" size="6" maxlength="8" class="cajas2" id="seriesup"/>
					</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda4" value="serie" onclick="BSD();"/></td>
					<td>Serie Doc.</td>
					<td id="op4"><input type="text" disabled="disabled" name="serie" size="24" maxlength="30" class="cajas2" id="serie"/></td>
				</tr>
				<tr>	
					<td><input type="checkbox" name="busqueda8" onclick="SSE();" size="20"/></td>
					<td>Subserie Doc.</td>
					<td id="op8"><input type="text" disabled="disabled" name="subserie" size="24" maxlength="100" class="cajas2" id="subserie"/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda6" value="fecha" onclick="BFI('.$Hoy.');" /></td>
					<td>Fecha Inicial</td>
					<td id="op6"><input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda7" value="fecha" onclick="BFF('.$Hoy.');" /></td>
					<td>Fecha Final</td>
					<td id="op7"><input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" disabled="disabled" readonly/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda1" onclick="PBCJ();" /></td>
					<td>ID Caja</td>
					<td id="op1"><input type="text" disabled="disabled" name="idcaja" size="8" maxlength="8" class="cajas2" id="idcaja"/></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda5" value="valor" onclick="BVD();" /></td>
					<td>Valor Doc.</td>
					<td id="op5">';  
					include('../PHPs Compartidos/Valor/CargarValores.php');
					$Valor = new Valor;
					$Valor->DesabValores('cajas2');
					print '</td>
				</tr>
				<tr>
					<td><input type="checkbox" name="busqueda9" onclick="DPO();" size="20"/></td>
					<td>Departamento</td>
					<td id="op9">';
					print '<select name="departamento" class="cajas2" id="departamento" disabled="disabled">';
					$sql = "SELECT idDpto,Descripcion FROM departamento";
					$query = mysql_query($sql);
					$Cnx->Desconectar();					
					if(mysql_num_rows($query)<=0){
						print '<option value="0">...</option>';	
					}
					else{
						print '<option value="0">...</option>';	
						while($row = mysql_fetch_assoc($query)){
							print '<option value="'.$row['idDpto'].'">'.$row['Descripcion'].'</option>';
						}
					}
				print '</select> 
					</td>
				</tr>
				</table></div>';
			print '</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="BusquedaTRD('.$Parametro.');">
				</td></tr></table>';
		}
		function TodasLasCarpetas(){
			$Url = "'CarpetasUsuario.php'";
			$Cont = "'resultados'";
			print '<span class="letra2">ID Usuario</span>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" style="{text-align: center;}" name="usuario" size="12" maxlength="12" class="cajas2" id="usuario"/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="CarpetasUsuario('.$Url.','.$Cont.');">';
		}
		function CarpetasUsuario($Usuario){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT CP.idCaja,CP.Serie,CP.Subserie,CP.Fecha_Ini,CP.idCarpeta,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup, 
					CP.FechaMaxRet FROM carpeta CP WHERE CP.idUsuario='".$Usuario."'";
			$query = mysql_query($sql); 
			$Cnx->Desconectar();
			if(is_resource($query)){
				if(mysql_num_rows($query)<=0){
					print '<br><span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
				}
				else{
					print '<div><form action="../PHPs Compartidos/Excel/FicheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
						<p>Exportar a Excel  <img src="../../Imagenes/export_to_excel.png" class="botonExcel" onclick="Excel();"/></p>
						<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
						</form></div>
						<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0" id="Exportar_a_Excel">
						<tr>
							<td width="8%" class="tituloformulario">ID Carpeta</td>
							<td width="6%" class="tituloformulario">ID Caja</td>
							<td width="11%" class="tituloformulario">No. Serie</td>
							<td width="15%" class="tituloformulario">Serie</td>
							<td width="26%" class="tituloformulario">Subserie</td>
							<td width="9%" class="tituloformulario">Fecha Inicial</td>
							<td width="9%" class="tituloformulario">Fecha Final</td>
							<td width="10%" class="tituloformulario">Fecha Max. Ret.</td>
						</tr>';
					while($row = mysql_fetch_assoc($query)){
					list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
					$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
					list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
					$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
					list($ano3, $mes3, $dia3) = explode('-', $row['FechaMaxRet']);
					$fecha3 = $dia3.'-'.$mes3.'-'.$ano3;
					print '<tr>
							<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>';
							if($row['idCaja']==null)
								print '<td class="cuerpoformulario">Dest.</td>';
							else
								print '<td class="cuerpoformulario">'.$row['idCaja'].'</td>';
					 print '<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
							<td class="cuerpoformulario">'.$row['Serie'].'</td>
							<td class="cuerpoformulario">'.$row['Subserie'].'</td>
							<td class="cuerpoformulario">'.$fecha1.'</td>
							<td class="cuerpoformulario">'.$fecha2.'</td>
							<td class="cuerpoformulario">'.$fecha3.'</td>';
					}
					print '</table></div><br><br>';		
				}
			}
		}
		function ConsultaDisponibles($Disp,$idDpto,$Subserie,$idCaja,$idCarpeta,$SerieI,$SerieS,$Serie,$Valor,$FechaI,$FechaF){
			if(($idCaja!='null')||($idCarpeta!='null')||($SerieI!='null')||($SerieS!='null')||($Subserie!='null')||($Serie!='null')
				||($Valor!='null')||($FechaI!='null')||($FechaF!='null')||($idDpto!='null')){
			
				include('../Conexion.php');
				$Cnx = new Conexion;
				$Cnx->Conectar();
				
				$sql = "SELECT DE.Descripcion AS Depa,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.Subserie,
						V.Descripcion,CP.Fecha_Ini,CP.idCarpeta,CP.Fecha_Fin,CP.FechaMaxRet,CP.nSerieInf,CP.nSerieSup 
						FROM localizacion L,ubicacion U,caja CJ,departamento DE,carpeta CP,valordoc V 
						WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
						AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND L.idDpto=DE.idDpto ";
			
				if($idCaja!='null')
					$sql = $sql."AND CJ.idCaja='".$idCaja."' ";
				if($Subserie!='null')
					$sql = $sql."AND CP.Subserie LIKE '%".$Subserie."%' ";
				if($idDpto!='null')
					$sql = $sql."AND DE.idDpto='".$idDpto."' ";
				if($idCarpeta!='null')
					$sql = $sql."AND CP.idCarpeta='".$idCarpeta."' ";
				if($SerieI!='null')
					$sql = $sql."AND CP.nserieinf>='".$SerieI."' ";
				if($SerieS!='null')
					$sql = $sql."AND CP.nSerieSup<='".$SerieS."' ";
				if($Serie!='null')
					$sql = $sql."AND CP.Serie LIKE '%".$Serie."%' ";
				if($Valor!='null')
					$sql = $sql."AND V.Descripcion='".$Valor."' ";
				if($FechaI!='null')
					$sql = $sql."AND CP.Fecha_Ini>='".$FechaI."' ";
				if($FechaF!='null')
					$sql = $sql."AND CP.Fecha_Fin<='".$FechaF."' ";
				if($Disp=='1')
					$sql = $sql." AND CJ.idCaja IS NOT NULL AND CJ.Disponibilidad='Disponible' 
							ORDER BY L.idDpto,L.Estante,L.Fila,U.idUbicacion,CJ.idCaja,CP.idCarpeta";
				if($Disp=='2')
					$sql = $sql." AND CJ.idCaja IS NOT NULL AND CJ.Disponibilidad='En Uso' 
							ORDER BY L.idDpto,L.Estante,L.Fila,U.idUbicacion,CJ.idCaja,CP.idCarpeta";
	
				$query = mysql_query($sql); 
				$Cnx->Desconectar();
				if(mysql_num_rows($query)<=0){
					print '<br><span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
				}
				else{
					$es=0;
					$fi=0;
					$ub=0;
					$id=0;
					$dpto=null;
					print '<div><form action="../PHPs Compartidos/Excel/FicheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
						<p>Exportar a Excel  <img src="../../Imagenes/export_to_excel.png" class="botonExcel" onclick="Excel();"/></p>
						<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
						</form></div>';
					while($row = mysql_fetch_assoc($query)){
						print '<div id="Exportar_a_Excel">';
						list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
						$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
						list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
						$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
						list($ano3, $mes3, $dia3) = explode('-', $row['FechaMaxRet']);
						$fecha3 = $dia3.'-'.$mes3.'-'.$ano3;
						if((($es==0)&&($fi==0)&&($dpto==null))||($es!=$row['Estante'])||($fi!=$row['Fila'])||($dpto!=$row['Depa'])){
							if(($es==0)&&($fi==0)&&($dpto==null)){
								$es = $row['Estante'];
								$fi = $row['Fila'];
								$ub = $row['idUbicacion'];
								$id = $row['idCaja'];
								$dpto = $row['Depa'];
								print '<div class="dpto" align="center">'.$dpto.'</div>';
							}
							if(($es!=$row['Estante'])||($fi!=$row['Fila'])||($dpto!=$row['Depa'])){
								print '</table></div>';
								if($dpto!=$row['Depa']){
									$dpto = $row['Depa'];
									print '<br><div class="dpto" align="center">'.$dpto.'</div>';
								}
								$es = $row['Estante'];
								$fi = $row['Fila'];
								$ub = $row['idUbicacion'];
								$id = $row['idCaja'];
							}
							print '<br><div class="bordetit2"><table width="30%" border="0" align="center">
								<tr>
									<td align="center"><span class="subtitulo">Estante</span></td>
									<td><span class="numero">'.$es.'</span></td>
									<td><span class="numero">-</span></td>
									<td align="center"><span class="subtitulo">Fila</span></td>
									<td><span class="numero">'.$fi.'</span></td>
								</tr>
								</table></div><table width="100%" border="0" align="center">
								<tr>
									<td width="20%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="20%">'.$row['Descripcion'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="16%" class="tituloformulario">No. Serie</td>
								<td width="17%" class="tituloformulario">Serie</td>
								<td width="29%" class="tituloformulario">Subserie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="9%" class="tituloformulario">F. Max. Ret.</td>
							</tr>';
						}
						elseif(($ub!=$row['idUbicacion'])||($id!=$row['idCaja'])){
							print '</table></div>';
							$ub = $row['idUbicacion'];
							$id = $row['idCaja'];
							print '<br><table width="100%" border="0" align="center">
								<tr>
									<td width="20%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="20%">'.$row['Descripcion'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="16%" class="tituloformulario">No. Serie</td>
								<td width="17%" class="tituloformulario">Serie</td>
								<td width="29%" class="tituloformulario">Subserie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="9%" class="tituloformulario">F. Max. Ret.</td>
							</tr>';
						}
						print '<tr>
								<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
								<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
								<td class="cuerpoformulario">'.$row['Serie'].'</td>
								<td class="cuerpoformulario">'.$row['Subserie'].'</td>
								<td class="cuerpoformulario">'.$fecha1.'</td>
								<td class="cuerpoformulario">'.$fecha2.'</td>
								<td class="cuerpoformulario">'.$fecha3.'</td>
							</tr>';
					}
					print '</table></div><br><br></div>';		
				}
			}
		}
		function ConsultaDestruidas($Dpto,$Subserie,$idCarpeta,$SerieI,$SerieS,$Serie,$FechaI,$FechaF,$FechaD){		
			if(($idCarpeta!='null')||($SerieI!='null')||($SerieS!='null')||($Subserie!='null')||($Serie!='null')||($FechaI!='null')||
				($FechaF!='null')||($Dpto!='null')||($FechaD!='null')){
				
				include('../Conexion.php');
				$Cnx = new Conexion;
				$Cnx->Conectar();
				
				$sql = "SELECT CP.Serie,CP.Subserie,CP.Fecha_Ini,CP.idCarpeta,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,DE.Dpto,DE.Fecha_Destr  
						FROM carpeta CP,Destruccion DE LEFT JOIN Digitalizacion DI USING (idCarpeta) WHERE DI.idCarpeta IS NULL AND 
						CP.idCarpeta=DE.idCarpeta";

				if($Dpto!='null')
					$sql = $sql." AND DE.Dpto='".$Dpto."'";
				if($Subserie!='null')
					$sql = $sql." AND CP.Subserie LIKE '%".$Subserie."%'";
				if($idCarpeta!='null')
					$sql = $sql." AND CP.idCarpeta='".$idCarpeta."'";
				if($SerieI!='null')
					$sql = $sql." AND CP.nserieinf>='".$SerieI."'";
				if($SerieS!='null')
					$sql = $sql." AND CP.nSerieSup<='".$SerieS."'";
				if($Serie!='null')
					$sql = $sql." AND CP.Serie LIKE '%".$Serie."%'";
				if($FechaI!='null')
					$sql = $sql." AND CP.Fecha_Ini>='".$FechaI."'";
				if($FechaF!='null')
					$sql = $sql." AND CP.Fecha_Fin<='".$FechaF."'";
				if($FechaD!='null')
					$sql = $sql." AND DE.Fecha_Destr>='".$FechaD."'";
				
				$sql = $sql." AND CP.idCaja IS NULL ORDER BY DE.Dpto,CP.idCarpeta";

				$query = mysql_query($sql);
				$Cnx->Desconectar();			
				if(mysql_num_rows($query)<=0){
					print '<br><span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
				}
				else{
					print '<div><form action="../PHPs Compartidos/Excel/FicheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
						<p>Exportar a Excel  <img src="../../Imagenes/export_to_excel.png" class="botonExcel" onclick="Excel();"/></p>
						<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
						</form></div>';
					$dpto = null;
					while($row = mysql_fetch_assoc($query)){
						print '<div id="Exportar_a_Excel">';
						if($row['Dpto']!=$dpto){
							if($dpto==null){
								$dpto = $row['Dpto'];
								print '<div class="dpto" align="center">'.$dpto.'</div><br>';
							}
							if($row['Dpto']!=$dpto){
								$dpto = $row['Dpto'];
								print '</table></div><br><div class="dpto" align="center">'.$dpto.'</div><br>';	
							}
							print '<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="15%" class="tituloformulario">No. Serie</td>
								<td width="17%" class="tituloformulario">Serie</td>
								<td width="29%" class="tituloformulario">Subserie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="10%" class="tituloformulario">Fecha Destruccion</td>
							</tr>';
						}
						list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
						$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
						list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
						$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
						list($ano3, $mes3, $temp1) = explode('-', $row['Fecha_Destr']);
						list($temp2,$minuto,$segundo) = explode(':', $temp1);
						list($dia3,$hora) = explode(' ',$temp2);
						$fecha3 = $dia3.'-'.$mes3.'-'.$ano3;
						print '<tr>
								<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
								<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
								<td class="cuerpoformulario">'.$row['Serie'].'</td>
								<td class="cuerpoformulario">'.$row['Subserie'].'</td>
								<td class="cuerpoformulario">'.$fecha1.'</td>
								<td class="cuerpoformulario">'.$fecha2.'</td>
								<td class="cuerpoformulario">'.$fecha3.'</td>
							</tr>';
					}
					print '</table></div><br><br></div>';		
				}
			}
		}
		function ConsultaDigitalizado($Dpto,$Subserie,$idCarpeta,$SerieI,$SerieS,$Serie,$FechaI,$FechaF,$FechaD){
			if(($idCarpeta!='null')||($SerieI!='null')||($SerieS!='null')||($Subserie!='null')||($Serie!='null')||($FechaI!='null')||
				($FechaF!='null')||($Dpto!='null')||($FechaD!='null')){
			
				// RUTA VER DIGITALIZACION
				$Url = "'VerDigitalizacion.php'";
				$Cont = "'resultados'";
				// -----------------------
				
				include('../Conexion.php');
				$Cnx = new Conexion;
				$Cnx->Conectar();
				
				$sql = "SELECT DISTINCT(CP.idCarpeta),CP.Serie,CP.Subserie,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,DE.Dpto,DE.Fecha_Destr  
						FROM carpeta CP,Destruccion DE,Digitalizacion DI WHERE CP.idCarpeta=DE.idCarpeta AND DI.idCarpeta=CP.idCarpeta";

				if($Dpto!='null')	
					$sql = $sql." AND DE.Dpto='".$Dpto."'";
				if($Subserie!='null')	
					$sql = $sql." AND CP.Subserie LIKE '%".$Subserie."%'";
				if($idCarpeta!='null')
					$sql = $sql." AND CP.idCarpeta='".$idCarpeta."'";
				if($SerieI!='null')
					$sql = $sql." AND CP.nserieinf>='".$SerieI."'";
				if($SerieS!='null')
					$sql = $sql." AND CP.nSerieSup<='".$SerieS."'";
				if($Serie!='null')
					$sql = $sql." AND CP.Serie LIKE '%".$Serie."%'";
				if($FechaI!='null')
					$sql = $sql." AND CP.Fecha_Ini>='".$FechaI."'";
				if($FechaF!='null')
					$sql = $sql." AND CP.Fecha_Fin<='".$FechaF."'";
				if($FechaD!='null')
					$sql = $sql." AND DE.Fecha_Destr>='".$FechaD."'";

				$sql = $sql." AND CP.idCaja IS NULL ORDER BY DE.Dpto,CP.idCarpeta";

				$query = mysql_query($sql); 
				$Cnx->Desconectar();
				
				if(mysql_num_rows($query)<=0){
					print '<br><span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
				}
				else{
					print '<div><form action="../PHPs Compartidos/Excel/FicheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
						<p>Exportar a Excel  <img src="../../Imagenes/export_to_excel.png" class="botonExcel" onclick="Excel();"/></p>
						<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
						</form></div>';
					$dpto = null;
					while($row = mysql_fetch_assoc($query)){
						print '<div id="Exportar_a_Excel">';
						if($row['Dpto']!=$dpto){
							if($dpto==null){
								$dpto = $row['Dpto'];
								print '<div class="dpto" align="center">'.$dpto.'</div><br>';
							}
							if($row['Dpto']!=$dpto){
								$dpto = $row['Dpto'];
								print '</table></div><br><div class="dpto" align="center">'.$dpto.'</div><br>';	
							}
							print '<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="15%" class="tituloformulario">No. Serie</td>
								<td width="17%" class="tituloformulario">Serie</td>
								<td width="29%" class="tituloformulario">Subserie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="10%" class="tituloformulario">Acciones</td>
							</tr>';
						}
						list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
						$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
						list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
						$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
						$Par = "'idCarpeta=".$row['idCarpeta']."'";
						print '<tr>
								<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
								<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
								<td class="cuerpoformulario">'.$row['Serie'].'</td>
								<td class="cuerpoformulario">'.$row['Subserie'].'</td>
								<td class="cuerpoformulario">'.$fecha1.'</td>
								<td class="cuerpoformulario">'.$fecha2.'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Ver.png"><span style="cursor:pointer;" onclick="EnvioGet('.$Url.','.$Par.','.$Cont.');">Ver archivo</span></td>
							</tr>';
					}
					print '</table></div><br><br></div>';		
				}
			}
		}
		function VerDigitalizacion($idCarpeta){
			$i = 0;
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT idDigitalizacion,Nombre_Archivo,Tipo_Archivo,Ruta FROM digitalizacion WHERE idCarpeta='".$idCarpeta."'";
			$query =  mysql_query($sql);
			$Cnx->Desconectar();
			if(mysql_num_rows($query)>0){
				print '<br><div class="download"><table border="1" cellspacing="1" cellpadding="0" width="100%" align="center"><tr>
				<td class="tituloformulario">Nombre del archivo</td>
				<td class="tituloformulario">Acciones</td></tr>';
				while($row = mysql_fetch_assoc($query)){
					print '<tr>
					<td class="cuerpoformulario">'.$row['Nombre_Archivo'].'</td>
					<td class="cuerpoformulario"><a href="Descargar.php?id='.$row['idDigitalizacion'].'">Descargar</a></td></tr>';
					$i++;
				}
				print '</table></div>';
			}
		}
		function Descargar($idDig){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Tipo_Archivo,Tamano_Archivo,Ruta FROM digitalizacion WHERE idDigitalizacion='".$idDig."'";
			$resultado = mysql_query($sql) or die('Error al consultar...');  
			
			$Cnx->Desconectar();
			
			list($tipo,$tamano,$ruta) = mysql_fetch_array($resultado);  
			$archivo_arr = explode( "/", $ruta );
			$archivo = $archivo_arr[count($archivo_arr) - 1]; 
			header('Content-Description: File Transfer');
			header("Content-type: application/octet-stream"); 
			header("Content-Disposition: attachment; filename=$archivo"); 
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header("Content-Length: ".filesize($ruta)); 
			ob_clean();
			flush();	
			readfile($ruta); 
		}
	}
?>