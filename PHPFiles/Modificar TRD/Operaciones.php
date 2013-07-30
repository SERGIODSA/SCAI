<?php	
	class Operaciones{
		private function Atras($Mensaje,$Url,$Par,$Cont){
			print '<span class="atras"><input type="button" class="boton" value="Atras" onclick="EnvioPost('.$Url.','.$Par.','.$Cont.');"/></span>
			<br><span align="center" class="fallo">'.$Mensaje.'</span>';
		}
		function BuscarTRD(){
			// RUTA MODIFICAR TRD
			$MUrl = "'EditarTRD.php'";
			$MCont = "'resultados'";
			// RUTA MODIFICAR UBICACION
			$UUrl = "'EditarUbicacion.php'";
			$UCont = "'resultados'";
			// RUTA MODIFICAR CAJA
			$CUrl = "'EditarCaja.php'";
			$CCont = "'resultados'";
			// ------------------------
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
				
			$x = 0;
			$idCaja = null;
			$idCarpeta = null;
			$SerieI = null;
			$SerieS = null;
			$Serie = null;
			$Valor = null;
			$FechaI = null;
			$FechaF = null;
			$sql = null;
			$f = time()-16200;
			$Hoy = "'".date("d-m-Y",$f)."'";

			if($_GET['idcaja']!='null'){
				$idCaja = $_GET['idcaja'];
				$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,  
						V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
						ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
						U.idUbicacion=CJ.idUbicacion AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja='".$idCaja."'";
				$x++;
			}
			if($_GET['idcarpeta']!='null'){
				$idCarpeta = $_GET['idcarpeta'];
				if($x>0){
					$sql = $sql." AND CP.idCarpeta='".$idCarpeta."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,  
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc AND CP.idCarpeta='".$idCarpeta."'";
				}
				$x++;
			}
			if($_GET['serieinf']!='null'){
				$SerieI = $_GET['serieinf'];
				if($x>0){
					$sql = $sql." AND CP.nserieinf>='".$SerieI."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,   
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc AND CP.nserieinf>='".$SerieI."'";
				}
				$x++;
			}
			if($_GET['seriesup']!='null'){
				$SerieS = $_GET['seriesup'];
				if($x>0){
					$sql = $sql." AND CP.nSerieSup<='".$SerieS."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,   
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc AND CP.nSerieSup<='".$SerieS."'";
				}
				$x++;
			}
			if($_GET['serie']!='null'){
				
				if (get_magic_quotes_gpc()!=1)
					$Ser = addslashes($_GET['serie']);
				else
					$Ser = $_GET['serie'];
				$Serie = htmlentities($Ser);
				
				if($x>0){
					$sql = $sql." AND CP.Serie LIKE '%".$Serie."%'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,   
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idValorDoc=V.idValorDoc AND CJ.idValorDoc=V.idValorDoc 
							AND CJ.idCaja=CP.idCaja AND CP.Serie LIKE '%".$Serie."%'";
				}
				$x++;
			}
			if($_GET['valor']!='null'){
				$Valor = $_GET['valor'];
				if($x>0){
					$sql = $sql." AND V.Descripcion='".$Valor."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,   
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc
							AND V.Descripcion='".$Valor."'";
				}
				$x++;
			}
			if($_GET['fechai']!='null'){
				$FechaI = $_GET['fechai'];
				if($x>0){
					$sql = $sql." AND CP.Fecha_Ini>='".$FechaI."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,  
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc
							AND CP.Fecha_Ini>='".$FechaI."'";
				}
				$x++;
			}
			if($_GET['fechaf']!='null'){
				$FechaF = $_GET['fechaf'];
				if($x>0){
					$sql = $sql." AND CP.Fecha_Fin<='".$FechaF."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,CP.FechaMaxRet,V.Descripcion AS Val,  
							V.idValorDoc,CP.Fecha_Ini,CP.Fecha_Fin,CP.nSerieInf,CP.nSerieSup,CJ.Capacidad FROM localizacion L,
							ubicacion U,caja CJ,carpeta CP,valordoc V WHERE L.idLocalizacion=U.idLocalizacion AND 
							U.idUbicacion=CJ.idUbicacion AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CJ.idValorDoc=V.idValorDoc
							AND CP.Fecha_Fin<='".$FechaF."'";
				}
				$x++;
			}
			if(($_GET['idcaja']!='null')||($_GET['idcarpeta']!='null')||($_GET['serieinf']!='null')||($_GET['seriesup']!='null')||
				($_GET['serie']!='null')||($_GET['valor']!='null')||($_GET['fechai']!='null')||($_GET['fechaf']!='null')){
				$sql = $sql." AND CJ.idDpto_Dep='".$_SESSION['iddptodep']."' AND (CJ.Disponibilidad='Disponible' OR CJ.Disponibilidad='En Uso') 
							  ORDER BY L.Estante,L.Fila,CJ.idCaja,U.idUbicacion,CP.idCarpeta";
			}
			$query = mysql_query($sql); 
			$Cnx->Desconectar();
			if(is_resource($query)){
				if(mysql_num_rows($query)>0){
					$es=0;
					$fi=0;
					$ub=0;
					$id=0;
					$f = time()-16200;
					$Hoy = "'".date("Y-m-d",$f)."'";
					while($row = mysql_fetch_assoc($query)){
						list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
						$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
						$fei = "'".$fecha1."'";
						list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
						$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
						$fef = "'".$fecha2."'";
						$Ffinal = "'".$row['Fecha_Fin']."'";
						list($ano3, $mes3, $dia3) = explode('-', $row['FechaMaxRet']);
						$fecha3 = $dia3.'-'.$mes3.'-'.$ano3;
						$fmr = "'".$fecha3."'";
						$UPar = "'idUbicacion=".$row['idUbicacion']."&idCaja=".$row['idCaja']."&Ffinal=".$row['Fecha_Fin']."'";
						$MPar = "'idCarpeta=".$row['idCarpeta']."'";
						$CPar = "'idCaja=".$row['idCaja']."'";
						if((($es==0)&&($fi==0))||($es!=$row['Estante'])||($fi!=$row['Fila'])){
							if(($es==0)&&($fi==0)){
								$es = $row['Estante'];
								$fi = $row['Fila'];
								$ub = $row['idUbicacion'];
								$id = $row['idCaja'];
							}
							if(($es!=$row['Estante'])||($fi!=$row['Fila'])){
								print '</table></div>';
								$es = $row['Estante'];
								$fi = $row['Fila'];
								$ub = $row['idUbicacion'];
								$id = $row['idCaja'];
							}
							print '<br><div class="bordetit"><table width="30%" border="0" align="center">
								<tr>
									<td align="center"><span class="subtitulo">Estante</span></td>
									<td><span class="numero">'.$es.'</span></td>
									<td><span class="numero">-</span></td>
									<td align="center"><span class="subtitulo">Fila</span></td>
									<td><span class="numero">'.$fi.'</span></td>
								</tr>
								</table></div><br><input type="button" value="Editar Ubicacion" class="boton" onclick="EditarUbicacion('.$UUrl.','.$UPar.','.$UCont.','.$Hoy.','.$Ffinal.');">&nbsp;&nbsp;<input type="button" value="Editar Caja" class="boton" onclick="EnvioGet('.$CUrl.','.$CPar.','.$CCont.');">
								<table width="100%" border="0" align="center">
								<tr>
									<td width="15%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.' '; if($row['Capacidad']=='1') print('(Llena)'); print'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$row['Val'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="15%" class="tituloformulario">No. Serie</td>
								<td width="34%" class="tituloformulario">Serie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="9%" class="tituloformulario">F. Max. Ret.</td>
								<td width="12%" class="tituloformulario">Acciones</td>
							</tr>';
						}
						elseif(($ub!=$row['idUbicacion'])||($id!=$row['idCaja'])){
							print '</table></div>';
							$ub = $row['idUbicacion'];
							$id = $row['idCaja'];
							print '<br><input type="button" value="Editar Ubicacion" class="boton" onclick="EditarUbicacion('.$UUrl.','.$UPar.','.$UCont.','.$Hoy.','.$Ffinal.');">&nbsp;&nbsp;<input type="button" value="Editar Caja" class="boton" onclick="EnvioGet('.$CUrl.','.$CPar.','.$CCont.');"><table width="100%" border="0" align="center">
								<tr>
									<td width="15%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.' '; if($row['Capacidad']=='1') print('(Llena)'); print'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$row['Val'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="8%" class="tituloformulario">ID Carpeta</td>
								<td width="15%" class="tituloformulario">No. Serie</td>
								<td width="34%" class="tituloformulario">Serie</td>
								<td width="9%" class="tituloformulario">Fecha Inicial</td>
								<td width="9%" class="tituloformulario">Fecha Final</td>
								<td width="9%" class="tituloformulario">F. Max. Ret.</td>
								<td width="12%" class="tituloformulario">Acciones</td>
							</tr>';
						}
						print '<tr>
								<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
								<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
								<td class="cuerpoformulario">'.$row['Serie'].'</td>
								<td class="cuerpoformulario">'.$fecha1.'</td>
								<td class="cuerpoformulario">'.$fecha2.'</td>
								<td class="cuerpoformulario">'.$fecha3.'</td>
								<td class="cuerpoformulario"><img src="../../Imagenes/Editar.png"><span style="cursor:pointer;" onclick="EditarTRD('.$MUrl.','.$MPar.','.$MCont.','.$fei.','.$fef.','.$Hoy.');">Editar TRD</span></td>
							</tr>';
					}
					print '</table></div><br><br>';		
				}
			}
		}
		function EditarTRD($idCarpeta){
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// RUTA GUARDAR MODIFICACION DE TRD
			$MUrl1 = "'GuardarTRD1.php'";
			$MUrl2 = "'EditarTRD2.php'";
			$MCont = "'resultados'";
			// --------------------------------
			$Parametro = "'Modificar'";
			include('../Conexion.php');
			include('../PHPs Compartidos/Valor/CargarValores.php');
			include('../PHPs Compartidos/Tipo/CargarTipo.php');
			$Valor = new Valor;
			$Tipo = new tipo;
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$sql = "SELECT T.Fecha_Traslado,CP.nSerieInf,CP.nSerieSup,CP.Fecha_Ini,CP.Fecha_Fin,CP.Serie,CP.Subserie,
					CP.FechaMaxRet,CP.idTipoCarpeta,CP.idCaja,CJ.idValorDoc FROM traslado T, Carpeta CP, Caja CJ 
					WHERE CP.idCarpeta='".$idCarpeta."' AND T.idCarpeta=CP.idCarpeta AND CP.idCaja=CJ.idCaja";
			$query = mysql_query($sql);   			
			if(mysql_num_rows($query)<=0){
				print 'Error realizando la consulta';	
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					$Fechatran = "'".$row['Fecha_Traslado']."'";
					$nSerieInf = $row['nSerieInf'];
					$nSerieSup = $row['nSerieSup'];
					$Serie = $row['Serie'];
					$Subserie = $row['Subserie'];
					$FechaMaxRet = $row['FechaMaxRet'];
					$idTipoCarpeta = $row['idTipoCarpeta'];
					$idCaja = $row['idCaja'];
					$idValorDoc = $row['idValorDoc'];
				}
			}
			list($ano3, $mes3, $dia3) = explode('-',$FechaMaxRet);
			$Fmro = "'".$FechaMaxRet."'";
			$Fmr = $dia3."-".$mes3."-".$ano3;
			$f = time()-16200;
			$Fee = "'".date("Y-m-d",$f)."'";
			
			print'<div class="formulario2">
					<table border="0" cellspacing="3" align="center">
						<tr>
							<td colspan="5" class="subtitulo">Datos de la Carpeta</td>
						</tr>
						<tr>
							<td align="right" class="letra">Num. Serie</td>
							<td colspan="3">
								<table width="100%" border="0">
									<tr>
										<td align="right" width="40%">&nbsp;&nbsp;<input type="text" name="nserieinf" id="nserieinf" maxlength="8" size="12" class="dereditform" value="'.$nSerieInf.'"/></td>
										<td align="center" width="5%">&nbsp;-&nbsp;</td>
										<td colspan="2" align="left"><input type="text" name="nseriesup" id="nseriesup" maxlength="8" size="12" class="dereditform" value="'.$nSerieSup.'"/></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="letra" align="right">Descripcion Serie</td>
							<td colspan="3">&nbsp;&nbsp;<input type="text" name="doc" id="doc" maxlength="30" size="44" class="cajas" value="'.$Serie.'"/></td>
						</tr>
						<tr>
							<td class="letra" align="right">Descripcion Subserie</td>
							<td colspan="3">&nbsp;&nbsp;<textarea name="subserie" id="subserie" maxlength="100" rows="2" cols="44" class="cajas">'; print $Subserie; print '</textarea></td>
						</tr>
						<tr>
							<td class="letra" align="right">Fecha Inicial</td>
							<td>&nbsp;&nbsp;<input type="text" class="fechas" name="fecha3" id="fecha3" align="center" size="8" readonly/></td>
							<td class="letra" align="right">Fecha Final</td>
							<td><input type="text" class="fechas" name="fecha4" id="fecha4" align="center" size="8" readonly/></td>	
						</tr>
						<tr>
							<td class="letra" align="right">Valor</td>
							<td width="27%">&nbsp;<span id="limpieza">&nbsp;'; $Valor->ModificarValores('cajas',$idValorDoc,$Fmro); print'</span></td>
							<td align="right">Fecha a destruir&nbsp;&nbsp;</td>
							<td id="retencion"><input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" value="'.$Fmr.'" style="{background-color: #E6E6E6;}" readonly/></span></td>
						</tr>
						<tr>
							<td class="letra" align="right">Tipo de carpeta</td>
							<td colspan="3">&nbsp;&nbsp;'; $Tipo->ModificarTipo('cajas',$idTipoCarpeta); print'</td>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td colspan="4" align="center"><input type="button" value="Atras" class="boton" onclick="BusquedaTRD('.$Parametro.');">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							print '<input type="button" value="Guardar" class="boton" onclick="ModificarTRD('.$idCarpeta.','.$idCaja.','.$idValorDoc.','.$Fechatran.','.$idCaja.','.$MUrl1.','.$MUrl2.','.$MCont.','.$PDFUrl.');"></td>
						</tr>
					</table>
			</div><br><br>';
			$Cnx->Desconectar();
		}
		function EditarTRD2($idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Serie,$Subserie,$Tipo,$Fdestruc,$Fechatran,$idValor,$idValorDoc,$Fini,$Ffin){
			// RUTA MODIFICAR TRD
			$MUrl = "'EditarTRD.php'";
			$MPar = "'idCarpeta=".$idCarpeta."'";
			$MCont = "'resultados'";
			// RUTA CREAR CAJA
			$NUrl = "'CrearCaja.php'";
			$NPar = "'idCaja=".$idCaja."&idCarpeta=".$idCarpeta."&Fechatran=".$Fechatran."&nSerieInf=".$nSerieInf."&nSerieSup=".$nSerieSup."&Serie=".$Serie."&Subserie=".$Subserie."&Tipo=".$Tipo."&Finicial=".$Fini."&Ffinal=".$Ffin."&Fdestruc=".$Fdestruc."&idValor=".$idValor."&idValorDoc=".$idValorDoc."'";
			$NCont = "'resultados'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// RUTA INSERTAR TRD
			$GUrl = "'GuardarTRD3.php'";
			// ------------------
			list($ano1, $mes1, $dia1) = explode('-',$Fini);
			$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
			$fei = "'".$fecha1."'";
			list($ano2, $mes2, $dia2) = explode('-',$Ffin);
			$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
			$fef = "'".$fecha2."'";
			$f = time()-16200;
			$Hoy = "'".date("Y-m-d",$f)."'";
			
			include_once('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			$fila = null;
			$estante = null;
			$sql = "SELECT u.idUbicacion, c.idCaja, l.Fila, l.Estante, v.Descripcion FROM caja c, localizacion l,ubicacion u, valordoc v 
					WHERE c.idUbicacion = u.idUbicacion AND u.idLocalizacion = l.idLocalizacion AND c.idValorDoc = v.idValorDoc 
					AND v.idValorDoc = ".$idValor." AND c.Disponibilidad = 'Disponible' AND c.idDpto_Dep='".$_SESSION['iddptodep']."'
					AND c.Capacidad='0' ORDER BY l.Estante,l.Fila,c.idCaja,u.idUbicacion";
			$query = mysql_query($sql);     
			
			print '<div class="agregar">
				<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="EditarTRD('.$MUrl.','.$MPar.','.$MCont.','.$fei.','.$fef.','.$Hoy.');"/>
				<input type="button" value="Crear Caja" class="boton" onclick="CrearCaja('.$NUrl.','.$NPar.','.$NCont.');"/>
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
					list($ano,$mes,$resto1) = explode('-',$Fechatran);
					list($resto2,$minuto,$segundo) = explode(':',$resto1);
					list($dia,$hora) = explode(' ',$resto2);
					$Ftranpdf = $dia.'-'.$mes.'-'.$ano.' '.$hora.':'.$minuto.':'.$segundo;
					$PDFPar = "'fechatran=".$Ftranpdf."&idcaja=".$row['idCaja']."'";
					$GPar = "'serie=".$Serie."&subserie=".$Subserie."&cajavieja=".$idCaja."&idcaja=".$row['idCaja']."&idcarpeta=".$idCarpeta."&nserieinf=".$nSerieInf."&nseriesup=".$nSerieSup."&tipo=".$Tipo."&fechatran=".$Fechatran."&fdestruc=".$Fdestruc."&fini=".$Fini."&ffin=".$Ffin."'";
					print '<tr>
							<td class="cuerpoformulario">'.$row['idCaja'].'</td>
							<td class="cuerpoformulario">'.$row['idUbicacion'].'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Caja.png"><span style="cursor:pointer;" onclick="InsertarCarpeta('.$GUrl.','.$GPar.','.$PDFUrl.','.$PDFPar.');">Insertar Carpeta</span></td>
						</tr>';
				}
				print '</table></div><br><br>';		
			}
			$Cnx->Desconectar();
		}
		function InsertarCarpeta($Serie,$Subserie,$Capacidad,$CajaVieja,$idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Fed,$Fechatran,$Fini,$Ffin){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data = 0;
			
			$sql = "UPDATE carpeta SET idCaja='".$idCaja."',idUsuario='".$_SESSION['usuario']."',
					nSerieInf='".$nSerieInf."',nSerieSup='".$nSerieSup."',Serie='".$Serie."',
					Subserie='".$Subserie."',idTipoCarpeta='".$Tipo."',Fecha_Ini='".$Fini."',Fecha_Fin='".$Ffin."',
					FechaMaxRet='".$Fed ."' WHERE idCarpeta='".$idCarpeta."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "UPDATE traslado SET Usuario='".$_SESSION['usuario']."',Fecha_Traslado='".$Fechatran."' 
				WHERE idCarpeta='".$idCarpeta."'";
				$insertar = mysql_query($sql);
				if($insertar){
					$sql = "UPDATE caja SET capacidad='".$Capacidad."' WHERE idCaja='".$idCaja."'";
					$insertar = mysql_query($sql);
					if($insertar){
						$sql = "UPDATE caja SET capacidad='0' WHERE idCaja='".$CajaVieja."'";
						$insertar = mysql_query($sql);
						if($insertar)
							$data = 1;
					}
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function EditarUbicacion($idCaja,$idUbicacion,$Ffinal){
			// RUTA BUSCAR FILA
			$BUrl = "'../PHPs Compartidos/Ubicacion/BuscarFila.php'";
			$BCont1 = "'filas'";
			$BCont2 = "'ubicacion'";
			// RUTA MODIFICAR UBICACION
			$MUrl = "'ModificarUbicacion.php'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// ----------------
			include('../Conexion.php');
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Cnx = new Conexion;
			$Tiempo = new Tiempo();
			$Cnx->Conectar();
			$Parametro = "'Modificar'";
			$Ffinal = "'".$Ffinal."'";
			$sql = "SELECT L.Estante,L.Fila,U.idUbicacion FROM localizacion L,ubicacion U WHERE L.idLocalizacion=U.idLocalizacion
					AND U.idUbicacion='".$idUbicacion."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query)>0){	
				while($row = mysql_fetch_assoc($query)){
					$idUbi = $row['idUbicacion'];
					$Fila = $row['Fila'];
					$Estante = $row['Estante'];
				}
			}
			$sql = "SELECT Distinct(l.Estante) FROM localizacion l,ubicacion u WHERE l.idLocalizacion=u.idLocalizacion AND u.Disponibilidad='Vacante' ORDER BY(l.Estante)";
			$query = mysql_query($sql);     
			print '<br><div class="formcaja2"><table width="90%" border="0" cellspacing="2" cellpadding="0" align="center">
				<tr>
					<td colspan="5" class="titulobold">Editar Ubicacion</td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td colspan="2" class="subtitulo" align="center">Ubicacion actual</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td colspan="2" class="subtitulo" align="center">Nueva Ubicacion</td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td class="izqeditform">Estante&nbsp;&nbsp;</td>
					<td><input type="text" value="'.$Estante.'" class="cajas" size="3" style="{background-color: #E6E6E6;}" readonly/></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="izqeditform" colspan="2">Estante&nbsp;&nbsp;
						<select name="estante" class="dereditform2" id="estante" onchange="Fila('.$BUrl.','.$BCont1.','.$BCont2.');">
							<option value="0"></option>';
						while($row = mysql_fetch_assoc($query)){
							print '<option value="'.$row['Estante'].'">'.$row['Estante'].'</option>';
						}
						print '</select>&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
				<tr>
					<td class="izqeditform">Fila&nbsp;&nbsp;</td>
					<td><input type="text" value="'.$Fila.'" class="cajas" size="3" style="{background-color: #E6E6E6;}" readonly/></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td colspan="2" id="filas" align="right" class="izqeditform"></td>
				</tr>
				<tr>
					<td class="izqeditform">Ubicacion&nbsp;&nbsp;</td>
					<td><input type="text" value="'.$idUbi.'" class="cajas" size="3" id="ubiactual" style="{background-color: #E6E6E6;}" readonly/></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td colspan="2" id="ubicacion" class="izqeditform"></td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td colspan="5" class="subtitulo" align="center">Datos de la transferencia</td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td class="izqeditform" align="right">Fecha&nbsp;&nbsp;</td>
					<td>&nbsp;&nbsp;<input type="text" class="fechas" name="fecha5" id="fecha5" align="center" size="8" readonly/></td>
					<td class="izqeditform" align="right">Hora&nbsp;&nbsp;</td>
					<td>';
					$Tiempo->Hora('1','cajas'); print ':'; $Tiempo->Minuto('1','cajas'); 
			print '</td>
				</tr>
				<tr>
					<td colspan="5"><br></td>
				</tr>
				<tr>
					<td align="center" colspan="2"><input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="BusquedaTRD('.$Parametro.');"/></td>
					<td></td>
					<td align="center" colspan="2"><input type="button" class="boton" name="guardar" id="guardar" value="Guardar" onclick="ModificarUbicacion('.$MUrl.','.$PDFUrl.','.$idCaja.','.$Ffinal.');"/></td>
				</tr>
			</table></div><br><br>';
			$Cnx->Desconectar();
		}
		function CrearCaja($Serie,$Subserie,$idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Fdestruc,$Fechatran,$idValor,$idValorDoc,$Finicial,$Ffinal){
			// RUTA GUARDAR CAJA
			$GUrl = "'GuardarCaja.php'";
			$GPar = "'idcaja=".$idCaja."&idcarpeta=".$idCarpeta."&serie=".$Serie."&subserie=".$Subserie."&fechatran=".$Fechatran."&tipo=".$Tipo."&nserieinf=".$nSerieInf."&nseriesup=".$nSerieSup."&finicial=".$Finicial."&ffinal=".$Ffinal."&fdestruc=".$Fdestruc."&idvalor=".$idValor."&idvalordoc=".$idValorDoc."'";			
			$GCont = "'resultados'";
			// RUTA BUSCAR FILA
			$BUrl = "'../PHPs Compartidos/Ubicacion/BuscarFila.php'";
			$BCont1 = "'filas'";
			$BCont2 = "'ubicacion'";
			// RUTA INSERTAR CAJA
			$AUrl = "'EditarTRD2.php'";
			$APar = $GPar;
			$ACont = "'resultados'";
			include_once('../Conexion.php');
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
		function GuardarCaja($idCaja,$idCarpeta,$Serie,$Subserie,$Fechatran,$Tipo,$nSerieInf,$nSerieSup,$Finicial,$Ffinal,$Fdestruc,$idValor,$idUbicacion,$idValorDoc){
			$f = time()-16200;
			$Fecha = date("Y-m-d",$f);
			// RUTA BOTON ATRAS (INSERTAR EN CAJA)
			$AUrl = "'CrearCaja.php'";
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
					$this->EditarTRD2($idCaja,$idCarpeta,$nSerieInf,$nSerieSup,$Serie,$Subserie,$Tipo,$Fdestruc,$Fechatran,$idValor,$idValorDoc,$Finicial,$Ffinal);
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
		function EditarCaja($idCaja){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			// RUTA MODIFICAR CAJA
			$MUrl = "'ModificarCaja.php'";
			// RUTA MOSTRAR DEPENDENCIA
			$VUrl = "'BuscarDependencia.php'";
			$VCont = "'dependencia'";
			// RUTA GENERAR PDF
			$PDFUrl = "'../PHPs Compartidos/TRD/GenerarPDF.php'";
			// -------------------
			$Parametro = "'Modificar'";
			$sql = "SELECT T.Fecha_Traslado,CJ.Capacidad,CJ.idValorDoc,DP.idDpto,DE.idDep,DD.idDpto_Dep,V.Anos_Ret FROM caja CJ,
					dpto_dep DD,Traslado T,carpeta CP,departamento DP,dependencia DE,valordoc V WHERE CJ.idCaja='".$idCaja."' 
					AND DD.idDpto_Dep=CJ.idDpto_Dep AND DD.idDpto=Dp.idDpto AND DD.idDep=DE.idDep AND CJ.idCaja=CP.idCaja 
					AND CP.idCarpeta=T.idCarpeta AND V.idValorDoc=CJ.idValorDoc";
			$query = mysql_query($sql);
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$Capacidad = $row['Capacidad'];
					$idDpto = $row['idDpto'];
					$idDep = $row['idDep'];
					$FTraslado = $row['Fecha_Traslado'];
					$idValorDoc = $row['idValorDoc'];
					$AnosRet = $row['Anos_Ret'];
				}
				// FECHA TRANSLADO
				list($ano, $mes, $temp1) = explode('-',$FTraslado);
				list($temp2,$minuto,$segundo) = explode(':',$temp1);
				list($dia,$hora) = explode(' ',$temp2);
				$FTraslado = "'".$FTraslado."'";
				$FT = $dia.'-'.$mes.'-'.$ano.' '.$hora.':'.$minuto.':'.$segundo;
				// ---------------
				$PDFPar = "'fechatran=".$FT."&idcaja=".$idCaja."'";
				print '<br><div class="formcaja4"><table width="90%" border="0" cellspacing="2" cellpadding="4" align="center">
					<tr>
						<td colspan="3" class="titulobold">Datos de la caja</td>
					</tr>
					<tr>
						<td colspan="3"><br></td>
					</tr>
					<tr>
						<td align="right">Capacidad&nbsp;&nbsp;</td>
						<td class="izqeditform" width="15%">';
						if($Capacidad=='1')
							print '<input type="checkbox" id="capacidad" name="capacidad" class="cajas" checked />&nbsp;&nbsp;';
						else
							print '<input type="checkbox" id="capacidad" name="capacidad" class="cajas" />&nbsp;&nbsp;';							
						print '</td>
						<td class="letracaja">Llena</td>
					</tr>
					<tr>
						<td align="right">Valor Documental&nbsp;&nbsp;</td>
						<td colspan="2"><select id="valor" name="valor" class="cajas">';
						$sql = "SELECT idValorDoc,Anos_Ret,Descripcion FROM valordoc";
						$query = mysql_query($sql);
						if(mysql_num_rows($query)>0){
							while($row = mysql_fetch_assoc($query)){
								if($idValorDoc==$row['idValorDoc'])
									print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'" selected>'.$row['Descripcion'].'</option>';
								else
									print '<option value="'.$row['idValorDoc'].'-'.$row['Anos_Ret'].'">'.$row['Descripcion'].'</option>';
							}
						}
						print '</select></td>
					</tr>
					<tr>
						<td align="right" class="letracaja">Departamento&nbsp;&nbsp;</td>
						<td colspan="2"><select id="dpto" name="dpto" class="cajas" onchange="Dependencia('.$VUrl.','.$VCont.');">';
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
						print '</select></td>
					</tr>
					<tr>
						<td align="right" class="letracaja">Dependencia&nbsp;&nbsp;</td>
						<td colspan="2" id="dependencia"><select id="dep" name="dep" class="cajas">';
							$sql = "SELECT DD.idDpto_Dep,DE.idDep,DE.Descripcion FROM dependencia DE,dpto_dep DD 
									WHERE DD.idDep=DE.idDep AND DD.idDpto='".$idDpto."'";
							$query = mysql_query($sql);
							if(mysql_num_rows($query)>0){
								while($row = mysql_fetch_assoc($query)){
									if($idDep==$row['idDep'])
										print '<option value="'.$row['idDpto_Dep'].'" selected>'.$row['Descripcion'].'</option>';
									else
										print '<option value="'.$row['idDpto_Dep'].'">'.$row['Descripcion'].'</option>';
								}
							}
						print '</select></td>
					</tr>
					<tr>
						<td colspan="3"><br></td>
					</tr>
					<tr>
						<td align="center" colspan="3">
							<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="BusquedaTRD('.$Parametro.');"/>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" class="boton" name="guardar" id="guardar" value="Guardar" onclick="ModificarCaja('.$MUrl.','.$PDFUrl.','.$PDFPar.','.$idCaja.','.$FTraslado.','.$AnosRet.');"/>
						</td>
					</tr>
				</table></div>';
			}
			$Cnx->Desconectar();
		}
		function ModificarTRD1($Serie,$Subserie,$idCarpeta,$nSerieInf,$nSerieSup,$Tipo,$Finicial,$Ffinal,$FDest){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data=0;
			$f = time()-16200;
			$Fechacre = date("Y-m-d",$f);
			
			$sql = "UPDATE carpeta SET idUsuario='".$_SESSION['usuario']."',nSerieInf='".$nSerieInf."',
					nSerieSup='".$nSerieSup."',Serie='".$Serie."',Subserie='".$Subserie."',idTipoCarpeta='".$Tipo."',
					Fecha_Ini='".$Finicial."',Fecha_Fin='".$Ffinal."',FechaMaxRet='".$FDest."',
					Fecha_Creacion='".$Fechacre."' WHERE idCarpeta='".$idCarpeta."'";
					
			$insertar = mysql_query($sql);
			if($insertar)
				$data=1;
				
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ModificarTRD2($Fechatran,$Fdest,$idCaja,$idCarpeta,$idCajav,$Capacidad){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data=0;
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
						$Cnx->Desconectar();
						if($insertar)
							$data=1;
					}
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function BuscarRetencion($idValor,$Fmr,$Fmryar){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			if($Fmryar!=0){	
				list($idValorN,$ARet) = explode('-',$Fmryar);
				$sql = "SELECT Anos_Ret FROM valordoc WHERE idValorDoc='".$idValor."'";
				$query = mysql_query($sql);   
				$Cnx->Desconectar();				
				if(mysql_num_rows($query)>0){
					while($row = mysql_fetch_assoc($query)){
						$ret = $row['Anos_Ret'];
					}
				}
				list($ano, $mes, $dia) = explode('-',$Fmr);
				$ano = $ano - $ret + $ARet;
				$destruccion = $dia."-".$mes."-".$ano;
				print '<input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" value="'.$destruccion.'" style="{background-color: #E6E6E6;}" readonly/>';
			}
			else
				print '<input type="text" name="dest" id="dest" maxlength="10" size="8" class="dereditform" style="{background-color: #E6E6E6;}" readonly/>';
		}
		function BuscarDependencia($idDpto){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT DE.Descripcion AS Depe,DD.idDpto_Dep FROM dpto_dep DD, dependencia DE WHERE DD.idDpto='".$idDpto."' 
					AND DD.idDep=DE.idDep";
			$query = mysql_query($sql);    
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)>0){
				print '<select name="dep" class="cajas" id="dep">';
				while($row = mysql_fetch_assoc($query)){
					print '<option value="'.$row['idDpto_Dep'].'">'.$row['Depe'].'</option>'; 
				}
				print '</select>';
			}
		}
		function ModificarCaja($idCaja,$Valor,$Anos,$Capacidad,$idDptoDep,$idDpto,$ARet){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$data=0;
			$i = 0;
			$sql = "SELECT idCarpeta,FechaMaxRet FROM carpeta WHERE idCaja='".$idCaja."'";
			$query = mysql_query($sql);
			if(mysql_num_rows($query)>0){
				while($row = mysql_fetch_assoc($query)){
					$idCarpeta[$i] = $row['idCarpeta'];
					list($ano,$mes,$dia) = explode('-',$row['FechaMaxRet']);
					$ano = $ano + $Anos - $ARet;
					$FDes[$i] = $ano.'-'.$mes.'-'.$dia;
					$i++;
				}
			}
			for($j=0;$j<$i;$j++){
				$sql = "UPDATE carpeta SET FechaMaxRet='".$FDes[$j]."' WHERE idCarpeta='".$idCarpeta[$j]."'";
				$insertar = mysql_query($sql);
			}
			$sql = "UPDATE caja SET Capacidad='".$Capacidad."',idDpto_Dep='".$idDptoDep."',idValorDoc='".$Valor."' WHERE idCaja='".$idCaja."'";
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "SELECT U.idLocalizacion FROM caja CJ,Ubicacion U WHERE CJ.idUbicacion=U.idUbicacion 
						AND CJ.idCaja='".$idCaja."'";
				$query = mysql_query($sql);
				if(mysql_num_rows($query)>0){
					while($row = mysql_fetch_assoc($query)){
						$idLoca = $row['idLocalizacion'];
					}
					$sql = "UPDATE localizacion SET idDpto='".$idDpto."' WHERE idLocalizacion='".$idLoca."'";
					$actualizar = mysql_query($sql);
					if($actualizar)
						$data=1;
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ModificarUbicacion($idCaja,$idUbi,$Ubiactual,$Fechatran){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$f = time()-16200;
			$Fcre = date("Y-m-d",$f);
			$idCarpeta = null;
			$n = 0;
			$data=0;
		
			$sql = "SELECT idCarpeta FROM carpeta WHERE idCaja='".$idCaja."'";
			$query = mysql_query($sql);
			if($query){
				while($row = mysql_fetch_assoc($query)){
					$idCarpeta[$n] = $row['idCarpeta'];
					$n++;
				}
				for($i=0;$i<$n;$i++){
					$sql = "INSERT INTO traslado (idCarpeta,Usuario,Fecha_Traslado,Fecha_Creacion) VALUES 
							('".$idCarpeta[$i]."','".$_SESSION['usuario']."','".$Fechatran."','".$Fcre."')";
					$insertar = mysql_query($sql);
				}
			}
			if($insertar){
				$sql = "UPDATE ubicacion SET Disponibilidad='Vacante' WHERE idUbicacion='".$Ubiactual."'";
				$insertar = mysql_query($sql);
				if($insertar){
					$sql = "UPDATE ubicacion SET Disponibilidad='Ocupado' WHERE idUbicacion='".$idUbi."'";
					$insertar = mysql_query($sql);
					if($insertar){
						$sql = "UPDATE caja SET idUbicacion='".$idUbi."' WHERE idCaja='".$idCaja."'";
						$insertar = mysql_query($sql);
						if($insertar)
							$data=1;
					}
				}
			}
			$Cnx->Desconectar();
			echo json_encode($data);
		}
		function ComprobarEspacio(){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			$sql = "SELECT Distinct(l.Estante) FROM localizacion l,ubicacion u WHERE l.idLocalizacion=u.idLocalizacion AND u.Disponibilidad='Vacante' ORDER BY(l.Estante)";
			$query = mysql_query($sql);     
			if(mysql_num_rows($query)<=0)
				$data = 0;		
			else
				$data = 1;
				
			$Cnx->Desconectar();
			echo json_encode($data);
		}
	}
?>