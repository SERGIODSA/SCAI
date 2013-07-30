function Ajax(){
	var xmlhttp = false;
	try{
		xmlhttp = new ActiveXObject("Msxm12.XMLHTTP");
	}
	catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E){
			xmlhttp = false;
		}
	}
	if(!xmlhttp & typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
function addslashes(str) {
	str=str.replace(/\\/g,'\\\\');
	str=str.replace(/\'/g,'\\\'');
	str=str.replace(/\"/g,'\\"');
	str=str.replace(/\0/g,'\\0');
	return str;
}
function validarEntero(valor){
	valor = parseInt(valor);
	if (isNaN(valor)){
		return false;
	}
	else{
		return true;
	}
}
function cambio_pagina(url){
	window.location = url;
}
function Excel(){
	$(document).ready(function(){
		$(".botonExcel").click(function(event){
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
		});
	});
} 
function CompararFechas(fecha, fecha2){     // 'aaaa-mm-dd'
	var xMonth=fecha.substring(6, 8);  
	var xYear=fecha.substring(1, 5);  
	var xDay=fecha.substring(9,11);
	var yMonth=fecha2.substring(6, 8);  
	var yYear=fecha2.substring(1, 5);  
	var yDay=fecha2.substring(9,11);
	if (xYear> yYear){  
		return true;  
	}  
	else{  
		if (xYear == yYear){   
			if (xMonth> yMonth){  
				return true;  
			}  
			else{   
				if (xMonth == yMonth){  
					if (xDay>= yDay)  
						return true;  
					else
						return false;
				}
				else
					return false;
			}  
		} 
		else
			return false;
	}  
}
function ComparaFechas(fecha, fecha2){     // 'aaaa-mm-dd hh:mm 
    var xMonth=fecha.substring(6, 8);  
    var xYear=fecha.substring(1, 5);  
    var xDay=fecha.substring(9,11);
	var xHour=fecha.substring(12,14);
	var xMinute=fecha.substring(15,17);
    var yMonth=fecha2.substring(6, 8);  
    var yYear=fecha2.substring(1, 5);  
    var yDay=fecha2.substring(9,11);
	var yHour=fecha2.substring(12,14);
	var yMinute=fecha2.substring(15,17);
    if (xYear> yYear){  
        return true;  
    }  
    else{  
		if (xYear == yYear){   
			if (xMonth> yMonth){  
				return true;  
			}  
			else{   
				if (xMonth == yMonth){  
					if (xDay> yDay)  
						return true;  
					else{ 
						if(xDay == yDay){
							if(xHour> yHour){
								return true;
							}
							else{
								if(xHour == yHour){
									if(xMinute >= yMinute)
										return true;
									else
										return false;
								}
								else
									return false;
							}
						}
						else
							return false;
					} 
				}
				else
					return false;
			}  
		} 
		else
			return false;
	}  
} 
function EnvioGet(url,parametros,contenedor,foco=''){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	if(parametros=='')
		ajax.open("GET",url); 
	else
		ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			if(foco!='')
				setTimeout("try{document.getElementById('"+foco+"').focus();}catch(error){}",100);
		}
	}
	ajax.send(null);
}
function EnvioPost(url,parametros,contenedor){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("POST",url,true);
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4) {
			c.innerHTML = ajax.responseText
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	ajax.send(parametros);
}