/*******************************************************************************************************************/
/*                                                    Seguridad                                                    */
/*******************************************************************************************************************/

/*********************************************Administracion de Usuarios********************************************/
function GuardarUsuario(url){
	nombre = document.getElementById('nombre').value;
	apellido = document.getElementById('apellido').value;
	nacionalidad = document.getElementById('nacionalidad').value;
	cedula = document.getElementById('cedula').value;
	idusuario = document.getElementById('idusuario').value;
	contrasena = document.getElementById('contrasena').value;
	var j = 0;
	var idDptoDep = null;
	if(document.datos.iddptodep.length!=null){
		for (var i=0; i < document.datos.iddptodep.length; i++){
			if (document.datos.iddptodep[i].checked){
				if (j==0)
					var idDptoDep = document.datos.iddptodep[i].value;
				else
					var idDptoDep = idDptoDep+'-'+document.datos.iddptodep[i].value;
				j++;
			}
		}
	}
	else
		idDptoDep = document.getElementById('iddptodep').value;
	if((idDptoDep!=null)&&(nombre!=null)&&(apellido!=null)&&(cedula!=null)&&(idusuario!=null)&&(contrasena!=null)){
		band = validarEntero(cedula);
		if(band==true){
			ced = nacionalidad+'-'+cedula;
			c = confirm('\xbfEsta seguro que desea guardar el registro?');
			if(c){
				var parametros = "nombre="+nombre+"&apellido="+apellido+"&ced="+ced+"&idusuario="+idusuario+"&contrasena="+contrasena+"&iddptodep="+idDptoDep;
				$.ajax({
					data: parametros,
					type: "POST",
					dataType: "json",
					url: url,												
					success: function(data){	
						if(data=='1')
							location.href = "AdmonUsuario.php";
						if(data=='2')
							alert('El ID de usuario ya existe');
						else
							alert('Error de registro');
					},
					error: function(data){
						alert('Error de ajax');
					}
				})
			}
		}
		else{
			alert('La cedula deben ser numeros enteros');
		}
	}
	else{
		alert('Existe uno o mas campos vacios');
	}
}	
function ModificarUsuario(url,parametros,contenedor){
	nombre = document.getElementById('nombre').value;
	apellido = document.getElementById('apellido').value;
	nacionalidad = document.getElementById('nacionalidad').value;
	cedula = document.getElementById('cedula').value;
	var j = 0;
	var idDptoDep = null;
	if(document.datos.iddptodep.length!=null){
		for (var i=0; i < document.datos.iddptodep.length; i++){
			if (document.datos.iddptodep[i].checked){
				if (j==0)
					var idDptoDep = document.datos.iddptodep[i].value;
				else
					var idDptoDep = idDptoDep+'-'+document.datos.iddptodep[i].value;
				j++;
			}
		}
	}
	else
		idDptoDep = document.getElementById('iddptodep').value;
	if((nombre!=null)||(apellido!=null)||(cedula!=null)){
		band = validarEntero(cedula);
		if(band==true){
			c = confirm('\xbfEsta seguro que desea modificar el registro?');
			if(c){
				var ced = nacionalidad+'-'+cedula;
				parametros = parametros+"&nombre="+nombre+"&apellido="+apellido+"&ced="+ced+"&iddptodep="+idDptoDep;
				EnvioPost(url,parametros,contenedor);
			}
		}
		else
			alert('La cedula deben ser numeros enteros');
	}
	else
		alert('Existe uno o mas campos vacios');
}
function GuardarClave(url,parametros){
	clave = document.getElementById('clave').value;
	if(clave!=''){
		parametros = parametros+"&contrasena="+clave;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url,												
			success: function(data){	
				if(data!='0'){
					alert('Su nueva contrase\u00f1a es: '+data);
					location.href = "AdmonUsuario.php";
				}
				else{
					alert('Error de registro');
				}
			},
			error: function(data){
				alert('Error de ajax');
			}
		})
	}
	else{
		alert('Existe uno o mas campos vacios');
	}
}
/*******************************************************Menus*******************************************************/
function GuardarSubmenu(url,parametros,contenedor){
	submenu = document.getElementById('submenu').value;
	c = confirm('\xbfEsta seguro que desea guardar el registro?');
	if(c){
		parametros = parametros+"&submenu="+submenu;
		EnvioPost(url,parametros,contenedor);
	}
}

function ModificarSubmenu(url,parametros,contenedor){
	submenu = document.getElementById('submenu').value;
	c = confirm('\xbfEsta seguro que desea modificar el registro?');
	if(c){
		parametros = parametros+"&submenu="+submenu;
		EnvioPost(url,parametros,contenedor);
	}
}
/*******************************************************Roles*******************************************************/
function EliminarRol(url,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea eliminar el registro?');
	if(c){
		EnvioPost(url,parametros,contenedor);
	}
}
function GuardarRol(url,parametros,contenedor){
	rol = document.getElementById('rol').value;
	var j = 0;
	var idMenus = null;
	if(document.datos.idmenus.length!=null){
		for (var i=0; i < document.datos.idmenus.length; i++){
			if (document.datos.idmenus[i].checked){
				if (j==0)
					var idMenus = document.datos.idmenus[i].value;
				else
					var idMenus = idMenus+'-'+document.datos.idmenus[i].value;
				j++;
			}
		}
	}
	else
		idMenus = document.getElementById('idMenus').value;
	if((idMenus!=null)&&(rol!='')){
		parametros = "rol="+rol+"&idmenus="+idMenus;
		EnvioPost(url,parametros,contenedor);
	}
	else
		alert('Existe uno o mas campos vacios');
}
function ModificarRol(url,parametros,contenedor){
	rol = document.getElementById('rol').value;
	var j = 0;
	var idMenus = null;
	if(document.datos.idmenus.length!=null){
		for (var i=0; i < document.datos.idmenus.length; i++){
			if (document.datos.idmenus[i].checked){
				if (j==0)
					var idMenus = document.datos.idmenus[i].value;
				else
					var idMenus = idMenus+'-'+document.datos.idmenus[i].value;
				j++;
			}
		}
	}
	else
		idMenus = document.getElementById('idMenus').value;
	if((idMenus!=null)&&(rol!='')){
		parametros = parametros+"&rol="+rol+"&idmenus="+idMenus;
		EnvioPost(url,parametros,contenedor);
	}
	else
		alert('Existe uno o mas campos vacios');
}
/********************************************Asignacion de roles*********************************************/
function AgregarRol(url,parametros,contenedor){
	var j = 0;
	var idRol = null;
	if(document.acc.seleccion.length!=null){
		for (var i=0; i < document.acc.seleccion.length; i++){
			if (document.acc.seleccion[i].checked){
				if (j==0)
					var idRol = document.acc.seleccion[i].value;
				else
					var idRol = idRol+'-'+document.acc.seleccion[i].value;
				j++;
			}
		}
	}
	else
		idRol = document.getElementById('seleccion').value;
	if(idRol!=null){
		parametros = parametros+"&idrol="+idRol
		EnvioPost(url,parametros,contenedor);
	}
	else
		alert('Debe seleccionar una opcion');
}
function QuitarRol(url,parametros,contenedor){
	var j = 0;
	var idRol = null;
	if(document.acc2.seleccion2.length!=null){
		for (var i=0; i < document.acc2.seleccion2.length; i++){
			if (document.acc2.seleccion2[i].checked)
				if (j==0)
					var idRol = document.acc2.seleccion2[i].value;
				else
					var idRol = idRol+'-'+document.acc2.seleccion2[i].value;
				j++;
		}
	}
	else
		idRol = document.getElementById('seleccion2').value;
	if(idRol!=null){
		parametros = parametros+"&idrol="+idRol
		EnvioPost(url,parametros,contenedor);
	}
	else
		alert('Debe seleccionar una opcion');
}