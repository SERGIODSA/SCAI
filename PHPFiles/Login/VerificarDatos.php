<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="stylesheet" href="../../CSSFiles/Login.css" type="text/css">
	<script>
		function logear(){
			band = 0;
			for (var i=0; i < document.login.depa.length; i++){
				if (document.login.depa[i].selected){
					band = 1;
					document.login.submit();
				}
			}
			if(band==0){
				alert('Seleccione un departamento');
			}
		}
	</script>
</head>

<body>
<?php
	$Usuario = $_POST['usuario'];
	$Clave = $_POST['clave'];
	include('Operaciones.php');
	$Operacion = new Operaciones;
	$Operacion->VerificarDatos1($Usuario,$Clave);
?>
</body>
</html>