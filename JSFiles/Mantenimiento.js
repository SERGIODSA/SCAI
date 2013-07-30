/*******************************************************************************************************************/
/*                                                    Mantenimiento                                                */
/*******************************************************************************************************************/

/***************************************************** Parametros **************************************************/
function GuardarParametro(url,contenedor){
	val = document.getElementById('valor').value;
	band = validarEntero(val);
	if(band==true){
		c = confirm('\xbfEsta seguro que desea guardar el registro?');
		if(c){
			desc = document.getElementById('descripcion').value;
			parametros = 'desc='+desc+'&val='+val;
			EnvioGet(url,parametros,contenedor);
		}
		else
			return false;
	}
	else
		alert('El campo "Valor" debe ser un numero entero');
}
function ModificarParametro(url,idp,contenedor){
	var val = document.getElementById('valor').value;
	band = validarEntero(val);
	if(band==true){
		c = confirm('\xbfEsta seguro que desea modificar el registro?');
		if(c){
			var desc = document.getElementById('descripcion').value;
			var parametros = 'idp='+idp+'&desc='+desc+'&val='+val;
			EnvioGet(url,parametros,contenedor);
		}
		else
			return false;
	}
	else
		alert('El campo "Valor" debe ser un numero entero');
}
/*************************************************** Departamento **************************************************/
function VerDependencias(url,iddpto,contenedor){
	$.ajax({
		data: "iddpto="+iddpto,	
		type: "GET",
		dataType: "json",
		url: "ComprobarDepe.php",												
		success: function(data){			
			if(data!=0){
				var parametros = 'iddpto='+iddpto;
				EnvioGet(url,parametros,contenedor);
			}
			else{
				alert('No existen dependencias asociadas a este departamento');
			}
		},
		error: function(data){
			alert('Error de ajax');
		}
	}) 
}
function EliminarDepartamento(url,parametros,contenedor){
	c = confirm('Esta accion tambien eliminara las dependencias asociadas. \n\t  \xbfEsta seguro que desea eliminar el registro?');
	if(c)
		EnvioGet(url,parametros,contenedor);
	else
		return false;
}
function CrearDependencia(url,parametros,contenedor,foco){
	if(parametros==''){
		desc = document.getElementById('descripcion').value;
		iddpto = null;
		if(desc=='')
			window.alert('Debe rellenar todos los campos');
		else{
			parametros = 'iddpto='+iddpto+'&desc='+desc;

			EnvioGet(url,parametros,contenedor,foco);
		}
	}
	else
		EnvioGet(url,parametros,contenedor,foco);
}
function GuardarDepaDepe(url,parametros,contenedor){
	desc2 = document.getElementById('descripcion').value;
	if(desc2=='')
		window.alert('Debe rellenar todos los campos');
	else{
		c = confirm('\xbfEsta seguro que desea guardar el registro?');
		if(c){
			parametros = parametros+"&desc2="+desc2;	
			EnvioGet(url,parametros,contenedor);
		}
		else
			return false;	
	}
}
function ModificarDepartamento(url,iddpto,contenedor,foco){
	desc = document.getElementById('descripcion').value;
	if(desc=='')
		window.alert('Debe rellenar todos los campos');
	else{
		c = confirm('\xbfEsta seguro que desea modificar el registro?');
		if(c){
			parametros = 'iddpto='+iddpto+'&desc='+desc;
			EnvioGet(url,parametros,contenedor,foco);
		}
		else{
			return false;
		}
	}
}
function ModificarDependencia(url,parametros,contenedor){
	desc = document.getElementById('descripcion').value;
	if(desc=='')
		window.alert('Debe rellenar todos los campos');
	else{
		c = confirm('\xbfEsta seguro que desea modificar el registro?');
		if(c){
			parametros = parametros+'&desc='+desc;
			EnvioGet(url,parametros,contenedor);
		}
		else{
			return false;
		}
	}
}
function EliminarDependencia(url,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea eliminar el registro?');
	if(c){
		EnvioGet(url,parametros,contenedor);
	}
	else{
		return false;
	}
}
/************************************************** Localizaciones *************************************************/
function GuardarUbicacion(url1,url2,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea agregar una nueva ubicacion?');
	if(c){
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url1,												
			success: function(data){	
				if(data.Valor>data.Maximo)
					EnvioPost(url2,parametros,contenedor);
				else
					alert('Se ha alcanzado el numero maximo de localizaciones por fila');
			},
			error: function(data){
				alert('Error de ajax');
			}
		})
	}
	else
		return false;
}
function EliminarLocalizacion(url,parametros,contenedor){
	c = confirm('Esta accion tambien eliminara las ubicaciones asociadas. \n\t  \xbfEsta seguro que desea eliminar el registro?');
	if(c)
		EnvioPost(url,parametros,contenedor);
	else
		return false;
}
function GuardarNuevaLoca(url1,url2,contenedor){
	estante = document.getElementById('estante').value;
	j = document.forms[0].fila.selectedIndex;
	fila = document.forms[0].fila[j].text; 
	if(estante=='')
		window.alert('Debe rellenar todos los campos');
	else{
		var parametros = "fila="+fila+"&estante="+estante;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url1,												
			success: function(data){			
				if(data.num=='0'){
					c = confirm('\xbfEsta seguro que desea guardar el registro?');
					if(c){
						if(data.valor>data.filas)
							EnvioPost(url2,parametros,contenedor);
						else
							alert('Se ha alcanzado el numero maximo de filas por estante');
					}
					else
						return false;
				}
				else
					alert('Ya existe esa localizacion');
			},
			error: function(data){
				alert('Error de ajax');
			}
		}) 
	}
}
function ModificarLocalizacion(url1,url2,contenedor){
	idloca = document.getElementById('idloca').value;
	fila = document.getElementById('fila').value;
	estante = document.getElementById('estante').value;
	dpto = document.getElementById('dpto').value;
	if(fila==''){
		window.alert('Debe rellenar todos los campos');
	}
	else{
		var parametros = "idloca="+idloca+"&fila="+fila+"&estante="+estante;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url1,												
			success: function(data){
				if(data.num=='0'){
					c = confirm('\xbfEsta seguro que desea modificar el registro?');
					if(c){
						parametros = parametros+'&dpto='+dpto;
						EnvioPost(url2,parametros,contenedor);
					}
					else
						return false;
				}
				else
					alert('Ya existe esa localizacion');
			},
			error: function(data){
				alert('Error de ajax');
			}
		}) 
	}
}
function ModificarUbicaciones(url,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea modificar el registro?');
	if(c){
		j = document.forms[0].disponibilidad.selectedIndex;
		disp = document.forms[0].disponibilidad[j].text; 
		parametros = parametros+'&disp='+disp;
		EnvioPost(url,parametros,contenedor);
	}
	else{
		return false;
	}
}
/*************************************************Valor Documental**************************************************/
function GuardarValor(url,contenedor){
	desc = document.getElementById('descripcion').value;
	ret = document.getElementById('retencion').value;
	band = validarEntero(ret);
	if(band==true){
		if(desc=='')
			window.alert('Debe llenar todos los campos');
		else{
			c = confirm('\xbfEsta seguro que desea guardar el registro?');
			if(c){
				var parametros = 'desc='+desc+'&ret='+ret;
				EnvioPost(url,parametros,contenedor);
			}
			else
				return false;
		}
	}
	else
		alert('El campo "Tiempo de retencion" debe ser un numero entero');
}
function ModificarValor(url,idvalor,contenedor){
	desc = document.getElementById('descripcion').value;
	ret = document.getElementById('retencion').value;
	band = validarEntero(ret);
	if(band==true){
		if(desc==''){
			window.alert('Debe llenar todos los campos');
		}
		else{
			c = confirm('\xbfEsta seguro que desea modificar el registro?');
			if(c){
				var parametros = 'desc='+desc+'&ret='+ret+'&idvalor='+idvalor;
				EnvioPost(url,parametros,contenedor);
			}
			else{
				return false;
			}
		}
	}
	else{
		alert('El campo "Tiempo de retencion" debe ser un numero entero');
	}
}
function EliminarValor(url,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea eliminar el registro?');
	if(c){
		EnvioPost(url,parametros,contenedor);
	}
	else{
		return false;
	}
}
/*************************************************Tipo de carpetas**************************************************/
function GuardarTipo(url,contenedor){
	desc = document.getElementById('descripcion').value;
	if(desc=='')
		alert('Debe llenar todos los campos');
	else{
		c = confirm('\xbfEsta seguro que desea guardar el registro?');
		if(c){
			var parametros = 'desc='+desc;
			EnvioPost(url,parametros,contenedor);
		}
		else
			return false;
	}
}
function EliminarTipo(url,parametros,contenedor){
	c = confirm('\xbfEsta seguro que desea eliminar el registro?');
	if(c)
		EnvioPost(url,parametros,contenedor);
	else
		return false;
}
function ModificarTipo(url,parametros,contenedor){
	desc = document.getElementById('descripcion').value;
	if(desc=='')
		window.alert('Debe llenar todos los campos');
	else{
		c = confirm('\xbfEsta seguro que desea modificar el registro?');
		if(c){
			parametros = parametros+'&desc='+desc;
			EnvioPost(url,parametros,contenedor);
		}
		else
			return false;
	}
}