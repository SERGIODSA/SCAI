<?php
	class Operaciones{
		function DevolverPrestamo($idCaja){
			include('../Conexion.php');
			include('../PHPs Compartidos/Tiempo/Tiempo.php');
			$Cnx = new Conexion;
			$Tiempo = new Tiempo;
			$Cnx->Conectar();		
			// RUTA GUARDAR DEVOLUCION
			$DUrl = "'GuardarDevolucion.php'";			
			// -----------------------
			$sql = "SELECT p.Fecha_prestamo,p.Entrega_estimada,c.Disponibilidad,p.Observacion,p.idUsuario_Receptor 
					FROM prestamo p,caja c WHERE c.idCaja=p.idCaja AND p.idCaja='".$idCaja."' 
					AND Entrega_prestamo IS NULL AND idUsuario='".$_SESSION['usuario']."'";   
			$query = mysql_query($sql);  
			$Cnx->Desconectar(); 			
			if(mysql_num_rows($query)<=0){
				print '<span align="center" style="{font-family: calibri;}">No se encontraron registros</span>';	
			}
			else{
				while($row = mysql_fetch_assoc($query)){
					if (($row['Disponibilidad'])=='Disponible')
						print '<span align="center" style="{font-family: calibri;}">La caja no se encuentra en prestamo</span>';	
					else{
						list($dia, $mes, $resto) = explode('-', $row['Fecha_prestamo']);
						list($resto2,$minuto,$segundo) = explode(':',$resto);
						list($ano,$hora) = explode(' ',$resto2);
						$fecha1 = $ano."-".$mes."-".$dia;
						$hora1 = $hora.":".$minuto;
						list($dia, $mes, $resto) = explode('-', $row['Entrega_estimada']);
						list($resto2,$minuto,$segundo) = explode(':',$resto);
						list($ano,$hora) = explode(' ',$resto2);
						$fecha2 = $ano."-".$mes."-".$dia;
						$hora2 = $hora.":".$minuto;
						$fecha3 = "'".$row['Fecha_prestamo']."'";
						$f = time()-16200;
						$fecha4 = date("d-m-Y",$f);
						print '<div class="prescaja"><form name="prestamo"><br>
							<table border="0" cellspacing="3" align="center">
								<tr>
									<td colspan="4" class="subtitulo">Datos del prestamo</td>
								</tr>
								<tr><td colspan="4"><hr></td></tr>
								<tr>
									<td class="letra" align="right"><span class="letracapa">Fecha de prestamo</span></td>
									<td class="letra" align="left"><input type="text" value="'.$fecha1.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="8" readonly/></td>
									<td class="letra" align="right"><span class="letracapa">Hora</span></td>
									<td class="letra" align="center"><input type="text" value="'.$hora1.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="6" readonly/></td>
								</tr>
								<tr>
									<td colspan="4"><br></td>
								</tr>
								<tr>
									<td class="letra" align="right"><span class="letracapa">Fecha de entrega<br>(Estimada)</span></td>
									<td class="letra" align="left"><input type="text" value="'.$fecha2.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="8" readonly/></td>
									<td class="letra" align="right"><span class="letracapa">Hora</span></td>
									<td class="letra" align="center"><input type="text" value="'.$hora2.'" class="cajas" style="{background-color: #E6E6E6; text-align: center;}" size="6" readonly/></td>
								</tr>
								<tr>
									<td colspan="4"><br></td>
								</tr>';
						if($row['idUsuario_Receptor']!=null){
							print '<tr>
									<td class="letra" align="right"><span class="letracapa">Usuario que recibe</span></td>
									<td colspan="3"><input type="text" name="receptor" id="receptor" class="cajas" style="{background-color: #E6E6E6;}" size="26" value="'.$row['idUsuario_Receptor'].'" readonly/></td>
								</tr>';
						}
						if($row['Observacion']!=null){
							print '<tr>
								<td colspan="4"><br></td>
							</tr>
							<tr>
								<td class="letra" align="right"><span class="letracapa">Observaciones</span></td>
								<td colspan="3"><textarea name="observacion" id="observacion" class="cajas" style="{background-color: #E6E6E6;}" maxlength="70" rows="2" cols="24" readonly>'.$row['Observacion'].'</textarea></td>
							</tr>';
						}
						print '<tr>
								<td colspan="4"><br></td>
							</tr>
							<tr>
								<td class="letra" align="right"><span class="letracapa">Fecha de entrega<br>(Real)</span></td>
								<td><input type="text" class="fechas" name="fecha1" id="fecha1" align="center" size="8" readonly/></td>
								<td class="letra" align="right"><span class="letracapa">Hora</span></td>
								<td>'; $Tiempo->Hora('1','cajas'); print ':'; $Tiempo->Minuto('1','cajas');  print '</td>
							</tr>
							<tr>
								<td colspan="4"><br><br></td>
							</tr>
							<tr>
								<td colspan="4" align="center"><input type="button" value="Registrar Devolucion" class="boton" onclick="GuardarDevolucion('.$DUrl.','.$idCaja.');"></td>
							</tr>
						</table>
						</form></div>';
					}
				}	
			}
		}
		function GuardarDevolucion($idCaja,$Fecha1){
			$data = 0;
		
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();	
			
			$sql = "UPDATE prestamo SET Entrega_prestamo=".$Fecha1." WHERE idCaja='".$idCaja."'"; 
			$actualizar = mysql_query($sql);
			if($actualizar){
				$sql = "UPDATE caja SET Disponibilidad='Disponible' WHERE idCaja='".$idCaja."'";
				$actualizar = mysql_query($sql);
				if($actualizar)
					$data = 1;
			}
			
			$Cnx->Desconectar(); 	
			echo json_encode($data);
		}
	}
?>