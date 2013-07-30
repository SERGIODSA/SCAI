/*******************************************************************************************************************/
/*                                                    Consultas                                                    */
/*******************************************************************************************************************/

/**************************************************Consulta Prestamo************************************************/
function BusquedaPrestamo(url,cont1,cont2,hoy){
	document.getElementById(cont2).innerHTML = "";
	atributo = document.getElementById('atributo').value;
	if(atributo>0){
		parametros = "atributo="+atributo;
		if((atributo==2)||(atributo==6)){
			var temp = hoy.split('-');
			var max = temp[2]+'-'+temp[1]+'-'+temp[0];
			c = document.getElementById(cont1);
			ajax = Ajax();
			ajax.open("GET",url+"?"+parametros); 
			ajax.onreadystatechange=function(){
				if (ajax.readyState == 4){
					c.innerHTML = ajax.responseText;
					$(function(){
						for(i=1;i<3;i++){
							$("#fecha"+i).datepicker({ 
								showOn: "button",
								buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
								buttonImageOnly: true,
								dateFormat: 'dd-mm-yy',
								maxDate: new Date(max+"1d")
							});
							$("#fecha"+i).datepicker("setDate",hoy);
						}
					});
				}
			}
			ajax.send(null);
		}
		else
			EnvioGet(url,parametros,cont1);
	}
	else
		document.getElementById(cont1).innerHTML = "";
}
function ConsultaPrestamo(url,contenedor,atributo){	
	switch(atributo){
		case 1:
			campo = document.getElementById('buscar').value;
			break;
		case 2:
			// FECHA INICIAL
			fecha1 = document.getElementById('fecha1').value;
			temp = fecha1.split('-');
			fecha1 = temp[2]+'-'+temp[1]+'-'+temp[0];
			// FECHA FINAL
			fecha2 = document.getElementById('fecha2').value;
			temp = fecha2.split('-');
			fecha2 = temp[2]+'-'+temp[1]+'-'+temp[0];
			// ------------
			campo = fecha1+' '+fecha2;
			break;
		case 3:
			campo = document.getElementById('departamento').value;
			break;
		case 4:
			campo = document.getElementById('buscar').value;
			break;
		case 5:
			campo = document.getElementById('estante').value;
			break;
		case 6:
			// FECHA INICIAL
			fecha1 = document.getElementById('fecha1').value;
			temp = fecha1.split('-');
			fecha1 = temp[2]+'-'+temp[1]+'-'+temp[0];
			// FECHA FINAL
			fecha2 = document.getElementById('fecha2').value;
			temp = fecha2.split('-');
			fecha2 = temp[2]+'-'+temp[1]+'-'+temp[0];
			// ------------
			campo = fecha1+' '+fecha2;
			break;
	}
	var parametros = "atributo="+atributo+"&campo="+campo;
	EnvioGet(url,parametros,contenedor);
}
/*************************************************Consulta Carpetas************************************************/
function BusquedaCarpetas(url,cont1,cont2,hoy){
	document.getElementById(cont2).innerHTML = "";
	disp = document.getElementById('disp').value;
	parametros = 'disp='+disp;
	if(disp!=0)
		EnvioGet(url,parametros,cont1);
	else
		document.getElementById(cont1).innerHTML = "";
}
function CarpetasUsuario(url,contenedor){
	document.getElementById(contenedor).innerHTML = "";
	idusuario = document.getElementById('usuario').value;
	var parametros = "idusuario="+idusuario;
	EnvioGet(url,parametros,contenedor);
}