<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../../index.html');
	if($_SESSION['Desincorporar']==0)
		header('Location: ../Menu.php');
	ini_set('post_max_size','50M');
	ini_set('upload_max_filesize','30M');
	ini_set('memory_limit','128M');
	ini_set('max_execution_time',120);
	ini_set('max_input_time',120);

	$idCarpeta = $_POST['idcarpeta'];
	$Nombre = $_POST['nombre'];
	$f = time()-16200;
	$Fcre = date("Y-m-d",$f);
	$Destino = '../../Archivos/';
	$Nom = preg_replace("/ /","",$_FILES['archivo']['name']);
	$Nom = $idCarpeta.$Nom;
	$Paquete = $_FILES['archivo']['size'];
	$Tipo = $_FILES['archivo']['type'];
	$Error = $_FILES['archivo']['error'];
	$Upload = $Destino.$Nom;
	
	if(($Paquete<=$_POST['MAX_FILE_SIZE'])&&($Paquete!=null)&&($_FILES['imagen']['error']==0)){
		$Archivo = $_FILES['archivo']['tmp_name'];
		$fp = fopen($Archivo, "rb");
		$Contenido = fread($fp,filesize($Archivo));
		$Archivo_Contenido = addslashes($Contenido);
		fclose($fp); 
		if(!file_exists($Upload)){
			if((($Tipo == "application/pdf")||($Tipo == "image/jpeg")||($Tipo == "application/x-rar-compressed")||
				($Tipo == "application/octet-stream"))&&(move_uploaded_file($Archivo,$Upload))){
				$Ruta = move_uploaded_file($Archivo,$Upload);
				include('../Conexion.php');
				$Cnx = new Conexion;
				$Cnx->Conectar();
				$sql = "INSERT INTO digitalizacion (idCarpeta,Nombre_Archivo,Tipo_Archivo,Tamano_Archivo,Ruta,Dpto,Usuario,Fecha_Creacion) 
						VALUES ('".$idCarpeta."','".$Nombre."','".$Tipo."','".$Paquete."','".$Upload."','".$_SESSION['dpto']."','".$_SESSION['usuario']."','".$Fcre."')";
				$insertar = mysql_query($sql);
				$Cnx->Desconectar();
				if($insertar)
					header('Location: Digitalizacion.php?p=2&idcarpeta='.$idCarpeta);
				else
					header('Location: Digitalizacion.php?p=3&idcarpeta='.$idCarpeta);
			}
			else{
				header('Location: Digitalizacion.php?p=1&idcarpeta='.$idCarpeta);
			}
		}
		else
			header('Location: Digitalizacion.php?p=4&idcarpeta='.$idCarpeta);
	}
	else{
		header('Location: Digitalizacion.php?p=5&idcarpeta='.$idCarpeta);
	}
?>
