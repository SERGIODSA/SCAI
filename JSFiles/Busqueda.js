/************************************CAMPOS DE BUSQUEDA***************************************/
function PBCP(){
	parametros = 'v='+document.bus.busqueda2.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op2.php',parametros,'op2');	
}
function BNS(){
	parametros = 'v='+document.bus.busqueda3.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op3.php',parametros,'op3');	
}
function BSD(){
	parametros = 'v='+document.bus.busqueda4.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op4.php',parametros,'op4');	
}
function BFI(hoy){
	v = document.bus.busqueda6.checked; 
	c = document.getElementById('op6');
	temp = hoy.split('-');
	today = temp[2]+'-'+temp[1]+'-'+temp[0];
	ajax = Ajax();
	ajax.open("GET","../PHPs Compartidos/CamposBusquedas/Op6.php?v="+v); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			if(v==true){
				$(function(){
					$("#fecha1").datepicker({ 
						showOn: "button",
						buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
						buttonImageOnly: true,
						dateFormat: 'dd-mm-yy',
						maxDate: new Date(hoy)
					});
					$("#fecha1").datepicker("setDate",today);
				});
			}
		}
	}
	ajax.send(null);
}
function BFF(hoy){
	v = document.bus.busqueda7.checked; 
	c = document.getElementById('op7');
	temp = hoy.split('-');
	today = temp[2]+'-'+temp[1]+'-'+temp[0];
	ajax = Ajax();
	ajax.open("GET","../PHPs Compartidos/CamposBusquedas/Op7.php?v="+v); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			if(v==true){
				$(function(){
					$("#fecha2").datepicker({ 
						showOn: "button",
						buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
						buttonImageOnly: true,
						dateFormat: 'dd-mm-yy',
						maxDate: new Date(hoy)
					});
					$("#fecha2").datepicker("setDate",today);
				});
			}
		}
	}
	ajax.send(null);
}
function PBCJ(){
	parametros = 'v='+document.bus.busqueda1.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op1.php',parametros,'op1');
}
function BVD(){
	parametros = 'v='+document.bus.busqueda5.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op5.php',parametros,'op5');
}
function SSE(){
	parametros = 'v='+document.bus.busqueda8.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op8.php',parametros,'op8');
}
function DPO(){
	parametros = 'v='+document.bus.busqueda9.checked;
	EnvioGet('../PHPs Compartidos/CamposBusquedas/Op9.php',parametros,'op9');
}
function BPFD(hoy){
	v = document.bus.busqueda10.checked; 
	c = document.getElementById('op10');
	temp = hoy.split('-');
	today = temp[2]+'-'+temp[1]+'-'+temp[0];
	ajax = Ajax();
	ajax.open("GET","../PHPs Compartidos/CamposBusquedas/Op10.php?v="+v); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			if(v==true){
				$(function(){
					$("#fecha3").datepicker({ 
						showOn: "button",
						buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
						buttonImageOnly: true,
						dateFormat: 'dd-mm-yy',
						maxDate: new Date(hoy)
					});
					$("#fecha3").datepicker("setDate",today);
				});
			}
		}
	}
	ajax.send(null);
}