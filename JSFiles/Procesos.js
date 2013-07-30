/*******************************************************************************************************************/
/*                                                     Procesos                                                    */
/*******************************************************************************************************************/

/****************************************************Registro TRD***************************************************/
function CrearTRD(url,parametros,contenedor,hoy){
	var temp = hoy.split('-');
	var max = temp[2]+'-'+temp[1]+'-'+temp[0];
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				for(i=1;i<=3;i++){
					$("#fecha"+i).datepicker({ 
						showOn: "button",
						buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
						buttonImageOnly: true,
						maxDate: new Date(max),
						dateFormat: 'dd-mm-yy'
					});
					$("#fecha"+i).datepicker("setDate",hoy);
				}
			});
		}
	}
	ajax.send(null);
}
function InsertarEnCaja(url,contenedor){
	c = document.getElementById(contenedor);
	var nserieinf = document.getElementById('nserieinf').value;
	var nseriesup = document.getElementById('nseriesup').value;
	var serie = document.getElementById('serie').value;
	var subserie = document.getElementById('subserie').value;
	var tipo = document.getElementById('tipo').value; 
	var idvalor = document.getElementById('valores').value; 
	var finicial = document.getElementById('fecha1').value;
	var ffinal = document.getElementById('fecha2').value;
	var ftrans = document.getElementById('fecha3').value;
	var horat = document.getElementById('hora1').value;
	var minutot = document.getElementById('minuto1').value;
	var fechatran = ftrans+" "+horat+":"+minutot+":00";
	f1 = ffinal.split('-');
	fecha1 = "'"+f1[2]+'-'+f1[1]+'-'+f1[0]+"'";
	f2 = finicial.split('-');
	fecha2 = "'"+f2[2]+'-'+f2[1]+'-'+f2[0]+"'";
	f3 = ftrans.split('-');
	fecha3 = "'"+f3[2]+'-'+f3[1]+'-'+f3[0]+"'";
	band1 = CompararFechas(fecha1,fecha2);   // fecha final contra fecha inicial
	band2 = CompararFechas(fecha3,fecha1);   // fecha de transferencia contra fecha final
	// Validacion
	if((nserieinf=='')||(nseriesup=='')||(serie=='')||(subserie=='')||(tipo=='0')||(idvalor=='0')){
	   window.alert('Debe rellenar todos los campos');
	}
	else{
		var nsi = validarEntero(nserieinf);
		var nss = validarEntero(nseriesup);
		if((nsi==true)&&(nss==true)){
			if(parseInt(nserieinf)<=parseInt(nseriesup)){
				if(band1==true){
					if(band2==true){
						var fdestruc = document.getElementById('dest').value;
						var parametros = 'fechatran='+fechatran+'&nserieinf='+nserieinf+'&nseriesup='+nseriesup+'&serie='+serie+'&subserie='+subserie+'&tipo='+tipo+'&finicial='+finicial+'&ffinal='+ffinal+'&fdestruc='+fdestruc+'&idvalor='+idvalor;
						EnvioPost(url,parametros,contenedor);
					}
					else{
						window.alert('La fecha de transferencia debe ser mayor que la fecha final');
					}
				}
				else{
					window.alert('La fecha final debe ser mayor que la fecha inicial');
				}
			}
			else{
				window.alert('La serie sup. debe ser mayor que la serie inf.');
			}
		}
		else{
			window.alert('Los num. de serie deben ser enteros');
		}
	}
}
// CREA CAJAS PARA NUEVA TRD, MODIFICAR TRD Y CONSERVAR TRD
function CrearCaja(url,parametros,contenedor){
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "../PHPs Compartidos/Ubicacion/ComprobarVacantes.php",												
		success: function(data){	
			if(data.num>0)
				EnvioPost(url,parametros,contenedor);
			else
				alert('No hay ubicaciones disponibles');
		},
		error: function(data){
			alert('Error de ajax');
		}
	})	
}
// CAMPO FECHA EN CREAR TRD, CONSERVAR CARPETA, BUSQUEDA POR VALOR
function AnosRet(url,contenedor){
	var ffinal = document.getElementById('fecha2').value;
	var valores = document.getElementById('valores').value;
	if (valores!=0){
		var parametros = "valores="+valores+"&ffinal="+ffinal;
		EnvioGet(url,parametros,contenedor);
	}
	else{
		document.getElementById(contenedor).innerHTML='<input type="text" name="dest" maxlength="10" size="8" class="dereditform" style="{background-color: #E6E6E6;}" readonly/>';
	}
}
// CREAR CAJA
function Fila(url,cont1,cont2){
	c = document.getElementById('filas');
	estante = document.getElementById('estante').value;
	if (estante!=0){
		var parametros = 'estante='+estante;
		EnvioGet(url,parametros,cont1);
	}
	else{
		document.getElementById(cont1).innerHTML="";
		document.getElementById(cont2).innerHTML="";
	}
}
function Ubicacion(url,contenedor){
	idloca = document.getElementById('fila').value;
	var parametros = 'idloca='+idloca;
	EnvioGet(url,parametros,contenedor);
}
// FIN CREAR CAJA
// INSERTAR CARPETA PARA REGISTRAR, MODIFICAR Y DESINCORPORAR
function InsertarCarpeta(url,parametros,pdfurl,pdfpar){
	c = confirm('\xbfEsta seguro que desea guardar el registro?');
	if(c){
		c = confirm('Presione ACEPTAR si la caja esta LLENA \nPresione CANCELAR si la caja aun tiene ESPACIO DISPONIBLE');
		if(c)
			var capacidad = 1;
		else
			var capacidad = 0;
		parametros = parametros+"&capacidad="+capacidad;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url,												
			success: function(data){	
				if(data!="0"){
					window.location.href = pdfurl+'?'+pdfpar;
				}
				else{
					alert('Fallo el registro');
				}
			},
			error: function(data){
				alert('Error de ajax');
			}
		})	
	}
	else{
		return false;
	}
}
// GUARDA LA CAJA
function GuardarCaja(url,parametros,contenedor){
	estante = document.getElementById('estante').value;
	if(estante!='0'){
		idloca = document.getElementById('fila').value;
		if(idloca!='0'){
			idubi = document.getElementById('ubicaciones').value;
			if(idubi!='0'){
				c = confirm('\xbfEsta seguro que desea guardar el registro?');
				if(c){
					parametros = parametros+"&idubi="+idubi;
					EnvioPost(url,parametros,contenedor);
				}
				else{
					return false;
				}		
			}
			else{
				window.alert('Debe rellenar todos los campos');
			}
		}
		else{
			window.alert('Debe rellenar todos los campos');
		}
	}
	else{
		window.alert('Debe rellenar todos los campos');
	}
}
/*****************************************************Modificar TRD*************************************************/
function EditarTRD(url,parametros,contenedor,finicial,ffinal,hoy){
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				for(i=3;i<=4;i++){
					$("#fecha"+i).datepicker({ 
						showOn: "button",
						buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
						buttonImageOnly: true,
						dateFormat: 'dd-mm-yy',
						maxDate: new Date(hoy)
					});
					if(i==3)
						$("#fecha"+i).datepicker("setDate",finicial);
					if(i==4)
						$("#fecha"+i).datepicker("setDate",ffinal);
				}
			});
		}
	}
	ajax.send(null);
}
function EditarUbicacion(url,parametros,contenedor,hoy,min){
	var temp = hoy.split("-");
	var max = temp[2]+'-'+temp[1]+'-'+temp[0];
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "ComprobarEspacio.php",												
		success: function(data){	
			if(data!="0"){
				c = document.getElementById(contenedor);
				ajax = Ajax();
				ajax.open("GET",url+"?"+parametros); 
				ajax.onreadystatechange=function(){
					if (ajax.readyState == 4){
						c.innerHTML = ajax.responseText;
						$(function(){
							$("#fecha5").datepicker({ 
								showOn: "button",
								buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
								buttonImageOnly: true,
								dateFormat: 'dd-mm-yy',
								minDate: new Date(min),
								maxDate: new Date(max)
							});
						});
						$("#fecha5").datepicker("setDate",max);
					}
				}
				ajax.send(null);
			}
			else{
				alert('No se puede realizar un cambio de ubicacion porque no existen ubicaciones disponibles');
			}
		},
		error: function(data){
			alert('Error de ajax');
		}
	})	
}
function ModificarTRD(idcarpeta,idcaja,idvalordoc,fechatran,idcaja,url1,url2,contenedor,pdfurl){    
	var nserieinf = document.getElementById('nserieinf').value;
	var nseriesup = document.getElementById('nseriesup').value;
	var serie = document.getElementById('doc').value;
	var subserie = document.getElementById('subserie').value;
	var tipo = document.getElementById('tipo').value; 
	// FECHA DE RETENCION
	var idvalor = document.getElementById('anosret').value; 
	var temp = idvalor.split("-");
	idv = temp[0];
	ARet = temp[1];
	// FECHA INICIAL
	var finicial = document.getElementById('fecha3').value;
	temp = finicial.split('-');
	finicial = temp[2]+'-'+temp[1]+'-'+temp[0];
	aux1 = "'"+finicial+"'";
	// FECHA FINAL
	var ffinal = document.getElementById('fecha4').value;
	temp = ffinal.split('-');
	ffinal = temp[2]+'-'+temp[1]+'-'+temp[0];
	aux2 = "'"+ffinal+"'";
	// COMPARACION
	band = CompararFechas(aux2,aux1);
	// VALIDACION
	if((nserieinf=='')||(nseriesup=='')||(serie=='')||(subserie=='')||(tipo=='0')||(idvalor=='0')){
	   window.alert('Debe rellenar todos los campos');
	}
	else{
		var nsi = validarEntero(nserieinf);
		var nss = validarEntero(nseriesup);
		if((nsi==true)&&(nss==true)){
			if(parseInt(nserieinf)<=parseInt(nseriesup)){
				if(band==true){
					// Fecha de destruccion
					var fdestruc = document.getElementById('dest').value;
					if(idvalordoc==idv){    
						// si son igual lo guardo en la misma caja
						a = confirm('\xbfEsta seguro que desea guardar el registro?');
						if(a){
							var parametros = "idcarpeta="+idcarpeta+"&nserieinf="+nserieinf+"&nseriesup="+nseriesup+"&serie="+serie+"&subserie="+subserie+"&tipo="+tipo+"&finicial="+finicial+"&ffinal="+ffinal+"&fdestruc="+fdestruc+"&fechatran="+fechatran;
							$.ajax({
								data: parametros,
								type: "POST",
								dataType: "json",
								url: url1,												
								success: function(data){	
									temp = fechatran.split("-");
									temp2 = temp[2].split(":");
									temp3 = temp2[0].split(' ');
									ftran = temp3[0]+'-'+temp[1]+'-'+temp[0]+' '+temp3[1]+':'+temp2[1]+':'+temp2[2];
									if(data!="0"){
										alert('La TRD se ha registrado correctamente');
										window.location.href = pdfurl+"?fechatran="+ftran+"&idcaja="+idcaja;
									}
									else{
										alert('Fallo el registro');
									}
								},
								error: function(data){
									alert('Error de ajax');
								}
							})
						}
					}
					else{     
						// sino hay que guardarlo en otra caja
						parametros = "idcaja="+idcaja+"&idcarpeta="+idcarpeta+"&nserieinf="+nserieinf+"&nseriesup="+nseriesup+"&serie="+serie+"&subserie="+subserie+"&tipo="+tipo+"&finicial="+finicial+"&ffinal="+ffinal+"&fdestruc="+fdestruc+"&idvalor="+idv+"&fechatran="+fechatran+"&idvalordoc="+idvalordoc;
						EnvioPost(url2,parametros,contenedor);
					}
				}
				else{
					window.alert('La fecha de la carpeta no puede ser mayor que la fecha actual');
				}
			}
			else{
				window.alert('La serie sup. debe ser mayor que la serie inf.');
			}
		}
		else{
			window.alert('Los num. de serie deben ser enteros');
		}
	}
}
// Calcula fecha maxima de retencion
function AnosRet2(url,contenedor,idValor,Fmr){
	c = document.getElementById(contenedor);
	fmryar = document.getElementById('anosret').value;
	var parametros = "idvalor="+idValor+"&fmr="+Fmr+"&fmryar="+fmryar;
	EnvioGet(url,parametros,contenedor);
}
function ModificarCaja(url,pdfurl,pdfpar,idCaja,FTraslado,AnosRet){
	capacidad = document.getElementById('capacidad').checked;
	iddptodep = document.getElementById('dep').value
	iddpto = document.getElementById('dpto').value
	valor = document.getElementById('valor').value
	parametros = "idCaja="+idCaja+"&capacidad="+capacidad+"&iddptodep="+iddptodep+"&iddpto="+iddpto+"&valor="+valor+"&aret="+AnosRet;
	c = confirm('\xbfEsta seguro que desea modificar el registro?');
	if(c){
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url,												
			success: function(data){	
				if(data!="0"){
					alert('La TRD se ha modificado correctamente');
					url = pdfurl+'?'+pdfpar;
					window.location.href = url;
				}
				else{
					alert('Error de modificacion');
				}
			},
			error: function(data){
				alert('Error de ajax');
			}
		})	
	}
	else{
		return false;
	}
}
function ModificarUbicacion(url,pdfurl,idCaja,Ffinal){
	ftrans = document.getElementById('fecha5').value;
	htrans = document.getElementById('hora1').value;
	mtrans = document.getElementById('minuto1').value;
	ubiactual = document.getElementById('ubiactual').value;
	estante = document.getElementById('estante').value;
	temp = ftrans.split('-');
	ft = temp[2]+'-'+temp[1]+'-'+temp[0];
	fechatran = ft+" "+htrans+":"+mtrans+":00";
	ftranspdf = ftrans+" "+htrans+":"+mtrans+":00";
	band = ComparaFechas("'"+ft+"'","'"+Ffinal+"'");
	if((estante!=null)&&(estante!='0')){
		fila = document.getElementById('fila').value;
		if((fila!=null)&&(fila!='0')){
			idubicacion = document.getElementById('ubicaciones').value;
			if((idubicacion!=null)&&(idubicacion!='0')){
				if(band==true){
					c = confirm('\xbfEsta seguro que desea modificar el registro?');
					if(c){
						parametros = "idCaja="+idCaja+"&idubicacion="+idubicacion+"&ubiactual="+ubiactual+"&fechatran="+fechatran;
						pdfpar = "idcaja="+idCaja+"&fechatran="+ftranspdf;
						$.ajax({
							data: parametros,
							type: "POST",
							dataType: "json",
							url: url,												
							success: function(data){	
								if(data!="0"){
									alert('La TRD se ha modificado correctamente');
									url = pdfurl+'?'+pdfpar;
									window.location.href = url;
								}
								else{
									alert('Error de modificacion');
								}
							},
							error: function(data){
								alert('Error de ajax');
							}
						})	
					}
					else{
						return false;
					}
				}
				else{
					alert('La fecha de transferencia debe mayor que la fecha final');
				}
			}
			else{
				alert('Existe uno o mas campos vacios');
			}
		}
		else{
			alert('Existe uno o mas campos vacios');
		}
	}
	else{
		alert('Existe uno o mas campos vacios');
	}
}
function Dependencia(url,contenedor){
	iddpto = document.getElementById('dpto').value;
	parametros = 'iddpto='+iddpto;
	if (iddpto!=0){
		EnvioGet(url,parametros,contenedor);
	}
	else{
		document.getElementById('dependencia').innerHTML="";
	}
}
/**************************************************** Desincorporar ************************************************/
function BuscarDes(url1,url2,cont1,cont2){
	var atributo = document.getElementById('atributo').value;
	if(atributo=='2'){
		document.getElementById(cont1).innerHTML = "";
		document.getElementById(cont2).innerHTML = "";
		parametros = "expirar="+atributo;
		EnvioGet(url1,parametros,cont2);
	}
	else{
		if((atributo=='1')||(atributo=='3')){
			parametros = "expirar="+atributo;
			document.getElementById(cont2).innerHTML = "";
			EnvioGet(url2,parametros,cont1);
		}
		else{
			document.getElementById(cont1).innerHTML = "";
			document.getElementById(cont2).innerHTML = "";
		}
	}
}
function Desincorporar(url,contenedor,tiempo=null){
	if(tiempo==null)
		tiempo = document.getElementById('tiempo').value;
	if(tiempo!='0'){
		parametros = "expirar="+tiempo;
		EnvioGet(url,parametros,contenedor);
	}
	else{
		document.getElementById(contenedor).innerHTML = "";
	}
}
function Conservar(url,parametros,contenedor,hoy){
	var temp = hoy.split('-');
	var max = temp[2]+'-'+temp[1]+'-'+temp[0];
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				$("#fecha3").datepicker({ 
					showOn: "button",
					buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
					buttonImageOnly: true,
					maxDate: new Date(max+"1d"),
					dateFormat: 'dd-mm-yy'
				});
				$("#fecha3").datepicker("setDate",hoy);
			});
		}
	}
	ajax.send(null);
}
function ConservarTRD(url1,url2,pdfurl,contenedor,idvalorprevio,idcarpeta,idCaja,Expirar){
	// fecha de transferencia
	var fechat = document.getElementById('fecha3').value;
	var horat = document.getElementById('hora1').value;
	var minutot = document.getElementById('minuto1').value;
	var Fechatran = fechat+" "+horat+":"+minutot+":00";
	var temp = fechat.split('-');
	var Ftran = temp[2]+'-'+temp[1]+'-'+temp[0]+" "+horat+":"+minutot+":00";
	// otras variables
	var idValor = document.getElementById('valores').value;
	var temp = idValor.split("-");
	idv = temp[0];
	ARet = temp[1];
	if(idv!=0){
		var Fdestruc = document.getElementById('dest').value;
		if(idvalorprevio==idv){    // si tiene el mismo valor se queda en la misma caja
			a = confirm('\xbfEsta seguro que desea guardar el registro?');
			if(a){
				var parametros = "fdestruc="+Fdestruc+"&idcarpeta="+idcarpeta+"&Fechatran="+Ftran;
				$.ajax({
					data: parametros,
					type: "POST",
					dataType: "json",
					url: url1,												
					success: function(data){	
						if(data!="0"){
							var pdfpar = "idcaja="+idCaja+"&fechatran="+Fechatran;
							alert('La TRD se ha registrado correctamente');
							window.location.href = pdfurl+'?'+pdfpar;
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
		}
		else{ 
			var parametros = "idcarpeta="+idcarpeta+"&Fechatran="+Ftran+"&idvalor="+idv+"&Fdestruc="+Fdestruc+"&idcaja="+idCaja+"&expirar="+Expirar;
			EnvioPost(url2,parametros,contenedor);
		}
	}
	else{
		alert('Existe uno o mas campos vacios');
	}
}
function Destruir(url,parametros,contenedor,hoy){
	var temp = hoy.split('-');
	var max = temp[2]+'-'+temp[1]+'-'+temp[0];
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				$("#fecha4").datepicker({ 
					showOn: "button",
					buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
					buttonImageOnly: true,
					maxDate: new Date(max+"1d"),
					dateFormat: 'dd-mm-yy'
				});
				$("#fecha4").datepicker("setDate",hoy);
			});
		}
	}
	ajax.send(null);
}
function RegistrarDestruccion(Url,DesUrl,DesPar,DigUrl,DigPar,DigCont){
	var fechad = document.getElementById('fecha4').value;
	var horad = document.getElementById('hora3').value;
	var minutod = document.getElementById('minuto3').value;
	var Fechades = fechad+" "+horad+":"+minutod+":00"; 
	var temp = fechad.split('-');
	var FDes = temp[2]+'-'+temp[1]+'-'+temp[0]+" "+horad+":"+minutod+":00"; 
	c = confirm('\xbfEsta seguro que desea realizar esta accion?');
	if(c){
		$.ajax({
			data: DesPar+"&fechades="+FDes,
			type: "POST",
			dataType: "json",
			url: DesUrl,												
			success: function(data){	
				if(data!="0"){
					d = confirm('Presione ACEPTAR si desea digitalizar la carpeta. \nPresione CANCELAR si desea salir');
					if(d){
						window.location.href = DigUrl+"?"+DigPar	
					}
					else{
						window.location.href = Url;
					}
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
		return false;
	}
}
/************************************************** Registro Prestamo **********************************************/
function NuevoPrestamo(url,parametros,contenedor,hoy){
	var temp = hoy.split('-');
	var max = temp[2]+'-'+temp[1]+'-'+temp[0];
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				$("#fecha3").datepicker({ 
					showOn: "button",
					buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
					buttonImageOnly: true,
					minDate: new Date(max),
					dateFormat: 'dd-mm-yy'
				});
				$("#fecha3").datepicker("setDate",hoy);
			});
		}
	}
	ajax.send(null);
}
function GuardarPrestamo(url,parametros,fecha2){
	observacion = document.getElementById('observacion').value;
	responsable = document.getElementById('responsable').value;
	// FECHA DE ENTREGA
	fecha3 = document.getElementById('fecha3').value;
	hora3 = document.getElementById('hora3').value;
	minuto3 = document.getElementById('minuto3').value;
	var temp = fecha3.split("-");
	fecha3 = temp[2]+"-"+temp[1]+"-"+temp[0]+" "+hora3+":"+minuto3+":00";
	festimada = "'"+fecha3+"'";
	fprestamo = "'"+fecha2+"'";
	c = confirm('\xbfEsta seguro que desea guardar el registro?');
	if(c){
		parametros = parametros+"&responsable="+responsable+"&fecha2="+fprestamo+"&fecha3="+festimada+"&observacion="+observacion;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url,												
			success: function(data){	
				if(data!=null){
					alert('La CAJA '+data.idcaja+' esta localizada en el ESTANTE '+data.estante+', FILA '+data.fila+', UBICACION '+data.ubic);
					var pdfurl = "../PHPs Compartidos/TRD/GenerarPDFPrestamo.php";
					var pdfpar = "idcaja="+data.idcaja+"&estante="+data.estante+"&fila="+data.fila+"&ubicacion="+data.ubic+"&fprestamo="+fecha2+"&festimada="+fecha3+"&observacion="+observacion+"&responsable="+responsable;
					location.href = pdfurl+"?"+pdfpar; 
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
	else
		return false;
}
/************************************************** Devolver Prestamo **********************************************/
function DevolverPrestamo(url,contenedor,hoy){
	var temp = hoy.split('-');
	var min = temp[2]+'-'+temp[1]+'-'+temp[0];
	idcaja = document.getElementById('idcaja').value;
	parametros = "idcaja="+idcaja;
	c = document.getElementById(contenedor);
	ajax = Ajax();
	ajax.open("GET",url+"?"+parametros); 
	ajax.onreadystatechange=function(){
		if (ajax.readyState == 4){
			c.innerHTML = ajax.responseText;
			$(function(){
				$("#fecha1").datepicker({ 
					showOn: "button",
					buttonImage: "../../JSFiles/jquery-ui-1.10.3.custom/css/custom-theme/images/calendar.gif",
					buttonImageOnly: true,
					minDate: new Date(min),
					dateFormat: 'dd-mm-yy'
				});
				$("#fecha1").datepicker("setDate",hoy);
			});
		}
	}
	ajax.send(null);
}
function GuardarDevolucion(url,idcaja){
	fecha1 = document.getElementById('fecha1').value;
	var temp = fecha1.split('-');
	hora1 = document.getElementById('hora1').value;
	minuto1 = document.getElementById('minuto1').value;
	fecha1 = "'"+temp[2]+'-'+temp[1]+'-'+temp[0]+" "+hora1+":"+minuto1+":00'";
	c = confirm('\xbfEsta seguro que desea guardar el registro?');
	if(c){
		parametros = "idcaja="+idcaja+"&fecha1="+fecha1;
		$.ajax({
			data: parametros,
			type: "POST",
			dataType: "json",
			url: url,												
			success: function(data){	
				if(data=='1'){
					c = confirm('Registro de devolucion completado. \xbfDesea registrar otra devolucion?');
					if(c){
						location.href = "DevolucionPrestamo.php"; 
					}
					else{
						location.href = "../Menu.php";
					}
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
}
/********RECUADRO BUSQUEDA: MODIFICAR TRD, PRESTAMO Y CONSULTAS DISPONIBLE, DESTRUIR O DIGITALIZAR**************/
function BusquedaTRD(accion){
	// inicializando variables que iran por url
	var idcaja=null;
	var idcarpeta=null;
	var serieinf=null;
	var seriesup=null;
	var serie=null;
	var valor=null;
	var fechai=null;
	var fechaf=null;
	var fechad=null;
	var disponibilidad=null;
	var subserie=null;
	var iddpto=null;
	// fin
	var bandera = 0;
	var parametros;
	b2 = document.bus.busqueda2.checked;
	if(b2==true){
		idcarpeta = document.getElementById('idcarpeta').value;
		if(idcarpeta!=''){
			if(validarEntero(idcarpeta)==true){
				parametros = "idcarpeta="+idcarpeta;
			}
			else{
				alert('El campo ID Carpeta debe ser un numero entero');
				bandera = 1;
				document.getElementById('resultados').innerHTML="";
			}
		}
		else{
			bandera = 1;
		}
	}
	else{
		parametros = "idcarpeta="+idcarpeta;
	}	
	b3 = document.bus.busqueda3.checked; 
	if(b3==true){
		serieinf = document.getElementById('serieinf').value;
		seriesup = document.getElementById('seriesup').value;
		if((serieinf!='')&&(seriesup!='')){
			if((validarEntero(serieinf)==true)&&(validarEntero(seriesup)==true)){
				if(serieinf<=seriesup){
					parametros = parametros+"&serieinf="+serieinf+"&seriesup="+seriesup;
				}
				else{
					alert('La serie superior debe ser mayor o igual que la serie inferior');
					bandera = 1;
					document.getElementById('resultados').innerHTML="";
				}
			}
			else{
				alert('Los campos Nº Serie deben ser numeros enteros');
				bandera = 1;
				document.getElementById('resultados').innerHTML="";
			}
		}
		else{
			bandera = 1;
		}
	}
	else{
		parametros = parametros+"&serieinf="+serieinf+"&seriesup="+seriesup;
	}
	b4 = document.bus.busqueda4.checked;	
	if(b4==true){
		serie = document.getElementById('serie').value;
		if(serie!=''){
			parametros = parametros+"&serie="+serie;
		}
		else{
			bandera = 1;
		}
	}
	else{
		parametros = parametros+"&serie="+serie;
	}	
	b6 = document.bus.busqueda6.checked; 
	if(b6==true){
		fecha = document.getElementById('fecha1').value.split('-');
		fechai = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
		parametros = parametros+"&fechai="+fechai;
	}
	else{
		parametros = parametros+"&fechai="+fechai;
	}
	b7 = document.bus.busqueda7.checked; 
	if(b7==true){
		fecha = document.getElementById('fecha2').value.split('-');
		fechaf = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
		parametros = parametros+"&fechaf="+fechaf;
	}
	else{
		parametros = parametros+"&fechaf="+fechaf;
	}
	if((accion!='CajaDest')&&(accion!='CajaDig')){
		b5 = document.bus.busqueda5.checked; 
		if(b5==true){
			j = document.forms[0].valores.selectedIndex;
			valor = document.forms[0].valores[j].text; 
			if(valor!='...'){
				parametros = parametros+"&valor="+valor;
			}
			else{
				bandera = 1;
			}
		}
		else{
			parametros = parametros+"&valor="+valor;
		}
		b1 = document.bus.busqueda1.checked;
		if(b1==true){
			idcaja = document.getElementById('idcaja').value;
			if(idcaja!=''){
				if(validarEntero(idcaja)==true){
					parametros = parametros+"&idcaja="+idcaja;
				}
				else{
					alert('El campo ID Caja debe ser un numero entero');
					bandera = 1;
					document.getElementById('resultados').innerHTML="";
				}
			}
			else{
				bandera = 1;
			}
		}
		else{
			parametros = parametros+"&idcaja="+idcaja;
		}
	}
	if((accion=='CajaDest')||(accion=='CajaDisp')||(accion=='CajaDig')){
		b8 = document.bus.busqueda8.checked; 
		if(b8==true){
			subserie = document.getElementById('subserie').value;
			if(subserie!=''){
				if(parametros==null)
					parametros = "subserie="+subserie;
				else
					parametros = parametros+"&subserie="+subserie;
			}
			else
				bandera = 1;
		}
		else{
			if(parametros==null)
				parametros = "subserie="+subserie;
			else
				parametros = parametros+"&subserie="+subserie;
		}
		b9 = document.bus.busqueda9.checked; 
		if(accion=='CajaDisp'){
			if(b9==true){
				iddpto = document.getElementById('departamento').value;
				if(iddpto>0){
					if(parametros==null)
						parametros = "iddpto="+iddpto;
					else
						parametros = parametros+"&iddpto="+iddpto;
				}
				else{
					alert('Debe seleccionar un departamento');
					bandera = 1;
					document.getElementById('resultados').innerHTML="";
				}
			}
			else{
				if(parametros==null)
					parametros = "iddpto="+iddpto;
				else
					parametros = parametros+"&iddpto="+iddpto;
			}
		}
		else{
			b10 = document.bus.busqueda10.checked; 
			if(b9==true){
				j = document.forms[0].departamento.selectedIndex;
				iddpto = document.forms[0].departamento[j].text; 
				if(j>0){
					if(parametros==null)
						parametros = "iddpto="+iddpto;
					else
						parametros = parametros+"&iddpto="+iddpto;
				}
				else{
					alert('Debe seleccionar un departamento');
					bandera = 1;
					document.getElementById('resultados').innerHTML="";
				}
			}
			else{
				if(parametros==null)
					parametros = "iddpto="+iddpto;
				else
					parametros = parametros+"&iddpto="+iddpto;
			}
			if(b10==true){
				fecha = document.getElementById('fecha3').value.split('-');
				fechad = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
				parametros = parametros+"&fechad="+fechad;
			}
			else{
				parametros = parametros+"&fechad="+fechad;
			}
		}
	}
	if((fechai!=null)&&(fechaf!=null)){
		fechaf = "'"+fechaf+"'";
		fechai = "'"+fechai+"'";
		band = ComparaFechas(fechaf,fechai);
		if(band!=true){
			alert('La fecha final debe ser mayor que la fecha inicial');
			bandera = 1;
		}
	}
	if(bandera==0){
		c = document.getElementById('resultados');
		ajax = Ajax();
		if(accion=='Prestamo')
			ajax.open("GET","BusquedaPrestamo.php?"+parametros); 
		if(accion=='Modificar')
			ajax.open("GET","BusquedaModificarTRD.php?"+parametros); 
		if(accion=='CajaDisp'){
			disp = document.getElementById('disp').value;
			ajax.open("GET","CarpetasDisponibles.php?"+parametros+"&disp="+disp); 
		}
		if(accion=='CajaDest')
			ajax.open("GET","CarpetasDestruidas.php?"+parametros);
		if(accion=='CajaDig')
			ajax.open("GET","CarpetasDigitalizado.php?"+parametros);
		ajax.onreadystatechange=function(){
			if (ajax.readyState == 4){
				c.innerHTML = ajax.responseText;
			}
		}
		ajax.send(null);
	}
	else{
		alert('Existe uno o mas campos vacios');
		document.getElementById('resultados').innerHTML="";
	}
}