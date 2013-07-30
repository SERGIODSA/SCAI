<?php	
	function Consulta1($idCaja){
		include_once('../../Conexion.php');
		$Cnx = new Conexion;
		$Cnx->Conectar();
		$sql = "SELECT CP.idCarpeta,CP.nSerieInf,CP.nSerieSup,CP.Serie,CP.Subserie,CP.Fecha_Ini,
				CP.Fecha_Fin,CP.FechaMaxRet FROM Carpeta CP, Caja CJ WHERE CP.idCaja=CJ.idCaja 
				AND CJ.idCaja='".$idCaja."'";
		$query = mysql_query($sql);  
		$Cnx->Desconectar();
		if(mysql_num_rows($query)>0){
			$i=0;
			while($row = mysql_fetch_assoc($query)){
				$Serie = html_entity_decode($row['Serie']);
				$Subserie = html_entity_decode($row['Subserie']);
				$datos['idCarpeta'][$i]=$row['idCarpeta'];
				$datos['nSerieInf'][$i]=$row['nSerieInf'];
				$datos['nSerieSup'][$i]=$row['nSerieSup'];
				$datos['Serie'][$i]=$Serie;
				$datos['Subserie'][$i]=$Subserie;
				list($ano,$mes,$dia) = explode('-',$row['Fecha_Ini']);
				$datos['Fecha_Ini'][$i]=$dia.'-'.$mes.'-'.$ano;
				list($ano,$mes,$dia) = explode('-',$row['Fecha_Fin']);
				$datos['Fecha_Fin'][$i]=$dia.'-'.$mes.'-'.$ano;
				list($ano,$mes,$dia) = explode('-',$row['FechaMaxRet']);
				$datos['FechaMaxRet'][$i]=$dia.'-'.$mes.'-'.$ano;
				$i++;
			}
		}
		return $datos;
	}
	function Consulta2($idCaja){
		include_once('../../Conexion.php');
		$Cnx = new Conexion;
		$Cnx->Conectar();
		$sql = "SELECT DISTINCT(V.Descripcion) AS Valor,CJ.idDpto_Dep,V.Anos_Ret,L.Estante,L.Fila
				FROM Caja CJ, Valordoc V, ubicacion U, Localizacion L 
				WHERE CJ.idValorDoc=V.idValorDoc AND CJ.idCaja='".$idCaja."'
				AND CJ.idUbicacion=U.idUbicacion AND U.idLocalizacion=L.idLocalizacion";
		$query = mysql_query($sql); 	
		if(mysql_num_rows($query)>0){
			while($row = mysql_fetch_assoc($query)){
				$datos['Valor']=$row['Valor'];
				$datos['Anos']=$row['Anos_Ret'];
				$datos['Estante']=$row['Estante'];
				$datos['Fila']=$row['Fila'];
				$datos['idCaja']=$idCaja;
				$idDptoDep = $row['idDpto_Dep'];
			}
		}
		$sql = "SELECT DA.Descripcion AS Depa, DE.Descripcion AS Depe FROM Departamento DA, Dependencia DE, 
				Dpto_Dep DD WHERE DD.idDpto=DA.idDpto AND DD.idDep=DE.idDep AND DD.idDpto_Dep='".$idDptoDep."'";
		$query = mysql_query($sql);  
		if(mysql_num_rows($query)>0){
			while($row = mysql_fetch_assoc($query)){
				$datos['Depa']=$row['Depa'];
				$datos['Depe']=$row['Depe'];
			}
		}
		$sql = "SELECT Nombre,Apellido FROM usuario WHERE idUsuario='".$_SESSION['usuario']."'";
		$query = mysql_query($sql);  
		$Cnx->Desconectar();
		if(mysql_num_rows($query)>0){
			while($row = mysql_fetch_assoc($query)){
				$Nombre = html_entity_decode($row['Nombre']);
				$Apellido = html_entity_decode($row['Apellido']);
				$datos['nombre']=$Nombre;
				$datos['apellido']=$Apellido;
			}
		}
		return $datos;
	}
	function Consulta3(){
		include_once('../../Conexion.php');
		$Cnx = new Conexion;
		$Cnx->Conectar();
		$sql = "SELECT U.Nombre,U.Apellido,DP.Descripcion AS Depa,DE.Descripcion AS Depe FROM Usuario U, 
				Usuario_Dpto UD,dpto_dep DD,Departamento DP,Dependencia DE WHERE U.idUsuario=UD.idUsuario 
				AND UD.idDpto_Dep=DD.idDpto_Dep AND DD.idDpto=DP.idDpto AND DD.idDep=DE.idDep 
				AND U.idUsuario='".$_SESSION['usuario']."' AND UD.idDpto_Dep='".$_SESSION['iddptodep']."'";
		$query = mysql_query($sql);
		$Cnx->Desconectar();		
		if(mysql_num_rows($query)>0){
			while($row = mysql_fetch_assoc($query)){
				$Nombre = html_entity_decode($row['Nombre']);
				$Apellido = html_entity_decode($row['Apellido']);
				$datos['nombre']= $Nombre;
				$datos['apellido']= $Apellido;
				$datos['Depa']=$row['Depa'];
				$datos['Depe']=$row['Depe'];
			}
		}
		return $datos;
	}
?>