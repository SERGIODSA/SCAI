<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" href="../../CSSFiles/Login.css" type="text/css">
	<script>
		function logear(){
			band = 0;
			for (var i=0; i < document.login.depe.length; i++){
				if (document.login.depe[i].selected)
					band = 1;
					document.login.submit();
			}
			if(band==0){
				alert('Seleccione una dependencia');
			}
		}
	</script>
</head>

<body>
<?php
	$Usuario = $_POST['usuario'];
	$Clave = $_POST['clave'];
	list($Dpto,$Desc) = explode('-',$_POST['depa']);
	include('Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->VerificarDatos2($Usuario,$Clave,$Dpto,$Desc);
?>
</body>
</html>