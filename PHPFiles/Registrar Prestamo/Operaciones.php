<?php
	class Operaciones{
		function BuscarPrestamo(){
			// RUTA REGISTRAR PRESTAMO
			$Url = "'NuevoPrestamo.php'";
			$Cont = "'resultados'";
			// -----------------------
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
				$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
						CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
						WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
						AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CJ.idCaja='".$idCaja."'";
				$x++;
			}
			if($_GET['idcarpeta']!='null'){
				$idCarpeta = $_GET['idcarpeta'];
				if($x>0){
					$sql = $sql." AND CP.idCarpeta='".$idCarpeta."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.idCarpeta='".$idCarpeta."'";
				}
				$x++;
			}
			if($_GET['serieinf']!='null'){
				$SerieI = $_GET['serieinf'];
				if($x>0){
					$sql = $sql." AND CP.nserieinf>='".$SerieI."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.nserieinf>='".$SerieI."'";
				}
				$x++;
			}
			if($_GET['seriesup']!='null'){
				$SerieS = $_GET['seriesup'];
				if($x>0){
					$sql = $sql." AND CP.nSerieSup<='".$SerieS."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.nSerieSup<='".$SerieS."'";
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
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.Serie LIKE '%".$Serie."%'";
				}
				$x++;
			}
			if($_GET['valor']!='null'){
				$Valor = $_GET['valor'];
				if($x>0){
					$sql = $sql." AND V.Descripcion='".$Valor."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND V.Descripcion='".$Valor."'";
				}
				$x++;
			}
			if($_GET['fechai']!='null'){
				$FechaI = $_GET['fechai'];
				if($x>0){
					$sql = $sql." AND CP.Fecha_Ini>='".$FechaI."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.Fecha_Ini>='".$FechaI."'";
				}
				$x++;
			}
			if($_GET['fechaf']!='null'){
				$FechaF = $_GET['fechaf'];
				if($x>0){
					$sql = $sql." AND CP.Fecha_Fin<='".$FechaF."'";
				}
				else{
					$sql = "SELECT CP.idCarpeta,L.Fila,L.Estante,U.idUbicacion,CJ.idCaja,CP.Serie,V.Descripcion,CP.Fecha_Ini,CP.Fecha_Fin,
							CP.nSerieInf,CP.nSerieSup FROM localizacion L,ubicacion U,caja CJ,carpeta CP,valordoc V 
							WHERE L.idLocalizacion=U.idLocalizacion AND U.idUbicacion=CJ.idUbicacion 
							AND CJ.idValorDoc=V.idValorDoc AND CJ.idCaja=CP.idCaja AND CP.Fecha_Fin<='".$FechaF."'";
				}
				$x++;
			}
			if(($_GET['idcaja']!='null')||($_GET['idcarpeta']!='null')||($_GET['serieinf']!='null')||($_GET['seriesup']!='null')||
				($_GET['serie']!='null')||($_GET['valor']!='null')||($_GET['fechai']!='null')||($_GET['fechaf']!='null')){
				$sql = $sql." AND CJ.idDpto_Dep='".$_SESSION['iddptodep']."' AND CJ.Disponibilidad='Disponible' ORDER BY L.Estante,L.Fila,U.idUbicacion,CJ.idCaja,CP.idCarpeta";
			}
			$query = mysql_query($sql); 
			$Cnx->Desconectar();
			if(is_resource($query)){
				if(mysql_num_rows($query)<=0){
					print '<br><span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';
				}
				else{
					$es=0;
					$fi=0;
					$ub=0;
					$id=0;
					while($row = mysql_fetch_assoc($query)){
						list($ano1, $mes1, $dia1) = explode('-', $row['Fecha_Ini']);
						$fecha1 = $dia1.'-'.$mes1.'-'.$ano1;
						list($ano2, $mes2, $dia2) = explode('-', $row['Fecha_Fin']);
						$fecha2 = $dia2.'-'.$mes2.'-'.$ano2;
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
								</table></div><table width="100%" border="0" align="center">
								<tr>
									<td width="15%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$row['Descripcion'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="10%" class="tituloformulario">ID Carpeta</td>
								<td width="17%" class="tituloformulario">No. Serie</td>
								<td width="36%" class="tituloformulario">Serie</td>
								<td width="10%" class="tituloformulario">Fecha Inicial</td>
								<td width="10%" class="tituloformulario">Fecha Final</td>
								<td width="16%" class="tituloformulario" colspan="2">Acciones</td>
							</tr>';
						}
						elseif(($ub!=$row['idUbicacion'])||($id!=$row['idCaja'])){
							print '</table></div>';
							$ub = $row['idUbicacion'];
							$id = $row['idCaja'];
							print '<br><table width="100%" border="0" align="center">
								<tr>
									<td width="15%" align="right"><span class="subtitulo">Ubicacion:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$ub.'</td>
									<td width="15%" align="right"><span class="subtitulo">Caja:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$id.'</td>
									<td width="15%" align="right"><span class="subtitulo">Valor:&nbsp;&nbsp;</span></td>
									<td width="15%">'.$row['Descripcion'].'</td>
								</tr>
							</table>
							<div class="tablapre"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="10%" class="tituloformulario">ID Carpeta</td>
								<td width="17%" class="tituloformulario">No. Serie</td>
								<td width="36%" class="tituloformulario">Serie</td>
								<td width="10%" class="tituloformulario">Fecha Inicial</td>
								<td width="10%" class="tituloformulario">Fecha Final</td>
								<td width="16%" class="tituloformulario" colspan="2">Acciones</td>
							</tr>';
						}
						$Par = "'idcaja=".$row['idCaja']."&ubic=".$row['idUbicacion']."&estante=".$row['Estante']."&fila=".$row['Fila']."'";
						print '<tr>
							<td class="cuerpoformulario">'.$row['idCarpeta'].'</td>
							<td class="cuerpoformulario">'.$row['nSerieInf'].' - '.$row['nSerieSup'].'</td>
							<td class="cuerpoformulario">'.$row['Serie'].'</td>
							<td class="cuerpoformulario">'.$fecha1.'</td>
							<td class="cuerpoformulario">'.$fecha2.'</td>
							<td class="cuerpoformulario"><img src="../../Imagenes/Insertar.png"><span style="cursor:pointer;" onclick="NuevoPrestamo('.$Url.','.$Par.','.$Cont.','.$Hoy.');">Registrar prestamo</span></td>
						</tr>';
					}
					print '</table></div><br><br>';		
				}
			}
		}
		function RegistrarPrestamo($idCaja,$Ubic,$Estante,$Fila){
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Tiempo = new Tiempo;
			
			$f = time()-16200;
			$Fecha = date("d-m-Y",$f);
			$Hora = date("H:i",$f);
			$Fecha2 = "'".date("Y-m-d H:i:s",$f)."'";
			// RUTA ATRAS
			$APar = "'Prestamo'";
			// RUTA GUARDAR
			$GUrl = "'GuardarPrestamo.php'";
			$GPar = "'idcaja=".$idCaja."&ubic=".$Ubic."&estante=".$Estante."&fila=".$Fila."'";
			// ------------
			print '<div class="prescaja"><br>
				<form name="prestamo">
					<table border="0" cellspacing="3" align="center">
						<tr>
							<td colspan="4" class="subtitulo">Datos del prestamo</td>
						</tr>
						<tr><td colspan="4"><hr></td></tr>
						<tr>
							<td class="letra" align="right"><span class="letracapa">Fecha de prestamo</span></td>
							<td colspan="3"><input type="text" value="'.$Fecha.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="8" readonly/>
							&nbsp;&nbsp;&nbsp;&nbsp;<span class="letracapa">Hora</span>
							<input type="text" value="'.$Hora.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="6" readonly/></td>
						</tr>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td class="letra" align="right"><span class="letracapa">Fecha de entrega<br>(Estimada)</span></td>
							<td><input type="text" class="fechas" name="fecha3" id="fecha3" align="center" size="8" readonly/></td>
							<td align="right" class="letra"><span class="letracapa">Hora</span></td>
							<td>';
							$Tiempo->Hora('3','cajas'); print ':'; $Tiempo->Minuto('3','cajas'); 
					print '</td>
						</tr>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td class="letra" align="right"><span class="letracapa">*Usuario que recibe</span></td>
							<td colspan="3"><input type="text" name="responsable" id="responsable" class="cajas" size="24"/></td>
						</tr>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td class="letra" align="right"><span class="letracapa">*Observaciones</span></td>
							<td colspan="3"><textarea name="observacion" id="observacion" class="cajas" maxlength="70" rows="2" cols="24"></textarea></td>
						</tr>
						<tr>
							<td colspan="4"><span class="nota">&nbsp;&nbsp;&nbsp;(* Opcional)</span></td>
						</tr>
						<tr>
							<td colspan="4"><br></td>
						</tr>
						<tr>
							<td colspan="4" align="center">
								<input type="button" class="boton" name="atras" id="atras" value="Atras" onclick="BusquedaTRD('.$APar.');"/>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="button" value="Registrar Prestamo" class="boton" onclick="GuardarPrestamo('.$GUrl.','.$GPar.','.$Fecha2.');">
							</td>
						</tr>
					</table>
				</form></div><br><br>';
		}
		function GuardarPrestamo($Ubic,$Estante,$Fila,$Fprestamo,$Festimada,$idCaja,$Observacion,$Receptor){
			$fecha = time()-16200;
			$fe = date('Y-m-d',$fecha);
			$data = null;
			
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();

			$sql = "INSERT INTO prestamo (idUsuario,idCaja,Fecha_Prestamo,Entrega_estimada,Observacion,idUsuario_Receptor,
					Fecha_Creacion) VALUES ('".$_SESSION['usuario']."','".$idCaja."',".$Fprestamo.",".$Festimada.",
					'".$Observacion."','".$Receptor."','".$fe."')"; 
			$insertar = mysql_query($sql);
			if($insertar){
				$sql = "UPDATE caja SET Disponibilidad='En Uso' WHERE idCaja='".$idCaja."'";
				$actualizar = mysql_query($sql);
				if($actualizar)
					$data = array('idcaja' => $idCaja, 'ubic' => $Ubic, 'estante' => $Estante, 'fila' => $Fila);
			}
			
			$Cnx->Desconectar();
			echo json_encode($data);
		}
	}
?>