<?php
	session_start();
	if (!$_SESSION['usuario'])
		header('Location: ../index.html');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Menu Principal | Distribuidora Universal Kia C.A.</title>
	<link rel="stylesheet" type="text/css" href="../CSSFiles/Menu.css">
	<script>
		function cambio_pagina(url){
			window.location = url;  
		}
	</script>
<head>

<body>
	<div class="logokia">
	   <img src="../Imagenes/KiaLogo.png">
	</div>
	<div class="usuario">
	    <div class="izquierda"><table cellpadding="0" cellspacing="0">
			<tr>
				<td rowspan="2"><img src="../Imagenes/Usuario.png" title='Info. Usuario/Cambio Clave'/></td>
				<td><?php echo($_SESSION['usuario']); ?></td>
			</tr>
			<tr><td><?php echo($_SESSION['dpto']);?></td></tr>
		</table></div>
	</div>
	<div class="desconexion">
		<div class="cambiosesion">
			<form action="Login/VerificarDatos.php" method="POST">
				<input type="hidden" name="usuario" id="usuario" value="<?php echo($_SESSION['usuario']);?>"/>
				<input type="hidden" name="clave" value="<?php echo($_SESSION['clave']);?>"/>
				<input type="image" src="../Imagenes/CambioSesion.png" title="Cambiar Sesion" />
			</form>
		</div>
		<div class="salir">
			<form action="Login/salir.php">
				<input type="image" src="../Imagenes/Desconectar.png" title="Desconectar" />
			</form>
		</div>
	</div>
	<div id="menu">
		<ul>
			<li>Mantenimiento
				<ul>
					<li><span onclick="cambio_pagina('Parametros/Parametros.php');">Parametros</span></li>
					<li><span onclick="cambio_pagina('Departamento/Departamento.php');">Departamentos</span></li>
					<li><span onclick="cambio_pagina('Localizaciones/Localizaciones.php');">Localizaciones</span></li>
					<li><span onclick="cambio_pagina('Valor Documental/Valor.php');">Valor documental</span></li>
					<li><span onclick="cambio_pagina('Tipo Carpeta/TipoCarpeta.php');">Tipo de carpetas</span></li>
				</ul>
			</li>
			<li>Procesos
				<ul>
					<li><span onclick="cambio_pagina('Registrar TRD/RegistrarTRD.php');">Ingresar TRD</span></li>
					<li><span onclick="cambio_pagina('Modificar TRD/ModificarTRD.php');">Modificar TRD</span></li>
					<li><span onclick="cambio_pagina('Desincorporar/Desincorporar.php');">Desincorporar</span></li>
					<li><span onclick="cambio_pagina('Registrar Prestamo/RegistroPrestamo.php');">Registrar prestamo</span></li>
					<li><span onclick="cambio_pagina('Devolucion Prestamo/DevolucionPrestamo.php');">Devolver prestamo</span></li>
				</ul>
			</li>
			<li>Consultas
				<ul>
					<li><span onclick="cambio_pagina('Consulta Prestamo/ConsultaPrestamo.php');">Prestamos</span></li>
					<li><span onclick="cambio_pagina('Consulta Carpetas/ConsultaCarpetas.php');">Carpetas</span></li>
					<li><span onclick="cambio_pagina('Consulta Localizacion/ConsultaLocal.php');">Localizaciones</span></li>
				</ul>
			</li>
			<li>Seguridad
				<ul>
					<li><span onclick="cambio_pagina('Admon Usuarios/AdmonUsuario.php');">Admon. usuarios</span></li>
					<li><span onclick="cambio_pagina('Mant. Menus/Menus.php');">Mant. de Menus</span></li>
					<li><span onclick="cambio_pagina('Definir Roles/Roles.php');">Definir roles</span></li>
					<li><span onclick="cambio_pagina('Asignar Roles/AsignacionRoles.php');">Asignar roles</span></li>
				</ul>
			</li>
		</ul>
	</div>
</body>
</html>