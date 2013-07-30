<?php
	class Operaciones{
		function ConsultaLocalizacion($Estatus){   
			include('../Conexion.php');
			$Cnx = new Conexion;
			$Cnx->Conectar();
			
			if($Estatus==1)
				$sql = "SELECT CJ.idCaja,DE.Descripcion,L.Fila,L.Estante,U.idUbicacion FROM localizacion L,ubicacion U,
						departamento DE,caja CJ WHERE U.Disponibilidad='Ocupado' AND L.idDpto=DE.idDpto 
						AND L.idLocalizacion=U.idLocalizacion AND CJ.idUbicacion=U.idUbicacion ORDER BY 
						L.idDpto,L.Estante,L.Fila,U.idUbicacion,CJ.idCaja"; 
			else
				$sql = "SELECT DE.Descripcion,L.Fila,L.Estante,U.idUbicacion FROM localizacion L,ubicacion U,
						departamento DE WHERE U.Disponibilidad='Vacante' AND L.idDpto=DE.idDpto 
						AND L.idLocalizacion=U.idLocalizacion ORDER BY L.idDpto,L.Estante,L.Fila,U.idUbicacion"; 

			$query = mysql_query($sql); 
			$Cnx->Desconectar();			
			if(mysql_num_rows($query)>0){
				$estante = 0;
				$fila = 0;
				$dpto = null;
				print '<div class="busqueda">';
				while($row = mysql_fetch_assoc($query)){
					if((($estante==0)&&($fila==0)&&($dpto==null))||($fila!=$row['Fila'])||($estante!=$row['Estante'])){
						if(($estante==0)&&($fila==0)&&($dpto==null)){
							$estante = $row['Estante'];
							$fila = $row['Fila'];
							$dpto = $row['Descripcion'];
							print '<div class="dpto" align="center">'.$dpto.'</div><br><div class="bordetit">
							<table width="60%" border="0" align="center">
							<tr>
								<td align="center"><span class="subtitulo">Estante</span></td>
								<td><span class="numero">'.$estante.'</span></td>
								<td><span class="numero">-</span></td>
								<td align="center"><span class="subtitulo">Fila</span></td>
								<td><span class="numero">'.$fila.'</span></td>
							</tr>
							</table></div><br>';
							print '<div class="tablaloca"><table width="100%" border="1" cellspacing="1" cellpadding="0">
							<tr>
								<td width="60%" class="tituloformulario">Ubicacion</td>
								<td width="40%" class="tituloformulario">Caja</td>
							</tr>';
						}
						if(($estante!=$row['Estante'])||($fila!=$row['Fila'])||($dpto!=$row['Descripcion'])){
							print '</table></div><br>';
							if($dpto!=$row['Descripcion']){
								$dpto = $row['Descripcion'];
								print '<div class="dpto" align="center">'.$dpto.'</div><br>';
							}
							$estante = $row['Estante'];
							$fila = $row['Fila'];
							print '<div class="bordetit"><table width="60%" border="0" align="center">
						<tr>
							<td align="center"><span class="subtitulo">Estante</span></td>
							<td><span class="numero">'.$estante.'</span></td>
							<td><span class="numero">-</span></td>
							<td align="center"><span class="subtitulo">Fila</span></td>
							<td><span class="numero">'.$fila.'</span></td>
						</tr>
						</table></div><br>';
						print '<div class="tablaloca"><table width="100%" border="1" cellspacing="1" cellpadding="0">
						<tr>
							<td width="60%" class="tituloformulario">Ubicacion</td>
							<td width="40%"class="tituloformulario">Caja</td>
						</tr>';
						}
					}
					if($Estatus==1)
						$idCaja = $row['idCaja'];
					else
						$idCaja = '-';
					print '<tr>
								<td class="cuerpoformulario">'.$row['idUbicacion'].'</td>
								<td class="cuerpoformulario">'.$idCaja.'</td>
							</tr>';
				}
				print '</table></div><br><br></div>
				<div class="croquis"><img src="../../Imagenes/Almacen2.jpg"></div>';		
			}
		}
	}
?>