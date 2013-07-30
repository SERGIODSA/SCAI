<?php
	class Operaciones{
		function Busqueda($Atributo){
			$Url = "'Consulta.php'";
			$Cont = "'resultados'";
			switch($Atributo){
				case '1':
					print '<input type="text" name="buscar" size="16" style="{text-align: center;}" maxlength="12" class="cajas2" id="buscar"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');">';
					break;
				case '2':
					print '<table><tr><td align="right"><span style="{font-weight:bold;}">Desde:&nbsp;&nbsp;</span></td><td>';
					print '<input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" readonly/>';
					print '</td><td rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');"></td></tr><tr><td align="right"><span style="{font-weight:bold;}">Hasta:&nbsp;&nbsp;</span></td><td>';
					print '<input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" readonly/>';
					print '</td></tr></table>';
					break;
				case '3':
					print '<select name="departamento" class="cajas2" id="departamento" onchange="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');">';
						include('../Conexion.php');
						$Cnx = new Conexion;
						$Cnx->Conectar();
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
						print '</select>'; 
					break;
				case '4':
					print '<input type="text" name="buscar" size="16" style="{text-align: center;}" maxlength="12" class="cajas2" id="buscar"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');">';
					break;
				case '5':
					print '<select name="estante" class="cajas2" id="estante" onchange="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');">';
					include('../Conexion.php');
					$Cnx = new Conexion;
					$Cnx->Conectar();
					$sql = "SELECT DISTINCT(Estante) FROM localizacion";
					$query = mysql_query($sql); 
					$Cnx->Desconectar();					
					if(mysql_num_rows($query)<=0){
						print '<option value="0">...</option>';	
					}
					else{
						print '<option value="0">...</option>';	
						while($row = mysql_fetch_assoc($query)){
							print '<option value="'.$row['Estante'].'">'.$row['Estante'].'</option>';
						}
					}
					print '</select>'; 
					break;
				case '6':
					print '<table><tr><td align="right"><span style="{font-weight:bold;}">Desde:&nbsp;&nbsp;</span></td><td>';
					print '<input type="text" class="cajas2" name="fecha1" id="fecha1" align="center" size="8" readonly/>';
					print '</td><td rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="&nbsp;&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;" class="boton" onclick="ConsultaPrestamo('.$Url.','.$Cont.','.$Atributo.');"></td></tr><tr><td align="right"><span style="{font-weight:bold;}">Hasta:&nbsp;&nbsp;</span></td><td>';
					print '<input type="text" class="cajas2" name="fecha2" id="fecha2" align="center" size="8" readonly/>';
					print '</td></tr></table>';
					break;
			}
		}
		function Consulta($Atributo,$Campo){
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			switch($Atributo){
				case 1:
					$sql = "SELECT idUsuario,idCaja,Fecha_prestamo,Entrega_estimada,Entrega_prestamo,Observacion,idUsuario_Receptor
							FROM prestamo WHERE idUsuario='".$_SESSION['usuario']."'";
					break;
				case 2:
					list($Fecha1,$Fecha2) = explode(' ',$Campo);
					$sql = "SELECT idUsuario,idCaja,Fecha_prestamo,Entrega_estimada,Entrega_prestamo,Observacion,idUsuario_Receptor
							FROM prestamo WHERE Entrega_prestamo>='".$Fecha1."' AND Entrega_prestamo<='".$Fecha2."'";
					break;
				case 3:
					$sql = "SELECT DISTINCT P.idUsuario,P.idCaja,P.Fecha_prestamo,P.Entrega_estimada,P.Entrega_prestamo,
							P.Observacion,P.idUsuario_Receptor FROM prestamo P,caja CJ,dpto_dep DD, departamento DP 
							WHERE P.idCaja=CJ.idCaja AND CJ.idDpto_Dep=DD.idDpto_Dep AND DD.idDpto='".$Campo."'";
					break;
				case 4:
					$sql = "SELECT idUsuario,idCaja,Fecha_prestamo,Entrega_estimada,Entrega_prestamo,Observacion,idUsuario_Receptor
							FROM prestamo WHERE idCaja='".$Campo."'";
					break;
				case 5:
					$sql = "SELECT P.idUsuario,P.idCaja,P.Fecha_prestamo,P.Entrega_estimada,P.Entrega_prestamo,
							P.Observacion,P.idUsuario_Receptor FROM prestamo P,caja C,ubicacion U,localizacion L
							WHERE P.idCaja=C.idCaja AND C.idUbicacion=U.idUbicacion AND U.idLocalizacion=L.idLocalizacion
							AND L.Estante='".$Campo."'";
					break;
				case 6:
					list($Fecha1,$Fecha2) = explode(' ',$Campo);
					$sql = "SELECT idUsuario,idCaja,Fecha_prestamo,Entrega_estimada,Entrega_prestamo,Observacion,idUsuario_Receptor
							FROM prestamo WHERE Fecha_prestamo>='".$Fecha1."' AND Fecha_prestamo<='".$Fecha2."'";
					break;
			}
			$query = mysql_query($sql);
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)>0){
				print '<div><form action="../PHPs Compartidos/Excel/FicheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
					<p>Exportar a Excel  <img src="../../Imagenes/export_to_excel.png" class="botonExcel" onclick="Excel();"/></p>
					<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
					</form></div>';
				print '<div class="tablaloca">
					<table width="100%" border="1" cellspacing="1" cellpadding="0" id="Exportar_a_Excel">
					<tr>
						<td class="tituloformulario" rowspan="2" width="11%">Usuario que entrega</td>
						<td class="tituloformulario" rowspan="2" width="6%">ID Caja</td>
						<td class="tituloformulario" colspan="2">Fecha de prestamo</td>
						<td class="tituloformulario" colspan="2">Fecha de entrega estimada</td>
						<td class="tituloformulario" colspan="2">Fecha de entrega real</td>
						<td class="tituloformulario" rowspan="2" width="11%">Usuario que recibe</td>
						<td class="tituloformulario" rowspan="2">Observacion</td>
					</tr>
					<tr>
						<td class="tituloformulario" width="9%">Fecha</td>
						<td class="tituloformulario" width="5%">Hora</td>
						<td class="tituloformulario" width="9%">Fecha</td>
						<td class="tituloformulario" width="5%">Hora</td>
						<td class="tituloformulario" width="9%">Fecha</td>
						<td class="tituloformulario" width="5%">Hora</td>
					</tr>';
				while($row = mysql_fetch_assoc($query)){
					list($ano, $mes, $temp1) = explode('-',$row['Fecha_prestamo']);
					list($temp2,$minuto,$segundo) = explode(':',$temp1);
					list($dia,$hora) = explode(' ',$temp2);
					$Fecha1 = $dia."-".$mes."-".$ano;
					$Hora1 = $hora.':'.$minuto;
					list($ano, $mes, $temp1) = explode('-',$row['Entrega_estimada']);
					list($temp2,$minuto,$segundo) = explode(':',$temp1);
					list($dia,$hora) = explode(' ',$temp2);
					$Fecha2 = $dia."-".$mes."-".$ano;
					$Hora2 = $hora.':'.$minuto;
					if($row['Entrega_prestamo']!=NULL){
						list($ano, $mes, $temp1) = explode('-',$row['Entrega_prestamo']);
						list($temp2,$minuto,$segundo) = explode(':',$temp1);
						list($dia,$hora) = explode(' ',$temp2);
						$Fecha3 = $dia."-".$mes."-".$ano;
						$Hora3 = $hora.':'.$minuto;
					}
					else{
						$Fecha3 = '-';
						$Hora3 = '-';
					}
					if($row['idUsuario_Receptor']==null)
						$Persona = $_SESSION['usuario'];
					else
						$Persona = $row['idUsuario_Receptor'];
					print '<tr>
								<td class="cuerpoformulario">'.$row['idUsuario'].'</td>
								<td class="cuerpoformulario">'.$row['idCaja'].'</td>
								<td class="cuerpoformulario">'.$Fecha1.'</td>
								<td class="cuerpoformulario">'.$Hora1.'</td>
								<td class="cuerpoformulario">'.$Fecha2.'</td>
								<td class="cuerpoformulario">'.$Hora2.'</td>
								<td class="cuerpoformulario">'.$Fecha3.'</td>
								<td class="cuerpoformulario">'.$Hora3.'</td>
								<td class="cuerpoformulario">'.$Persona.'</td>';
								if($row['Observacion']==null)
									print '<td class="cuerpoformulario">-</td>';
								else
									print '<td class="cuerpoformulario">'.$row['Observacion'].'</td>';
							print '</tr>';
				}
				print '</table></div><br><br>';
			}
		}
	}
?>