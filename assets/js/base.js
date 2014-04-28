var flisol = {
	controlLogin:false,
	toggleLogin:function(){
		if(this.controlLogin){
			$('#loginform').hide();
		}
		else { 
			$('#loginform').show();
		}
		this.controlLogin=!this.controlLogin;
	},
	replace:function(find,replace,str){
		return str.replace(new RegExp(find, 'g'),replace);
	}
};

/*
Se cargan las vistas y se tienen listas para presentación
*/
flisol.vistas={
	dashboard:$("#dashboard").remove(),
	formulario_equipo:$("#formulario_equipo").remove(),
	comentarios:$("#comentarios").remove()
};
flisol.setVista=function(vista){
	$("#contenedor").html(flisol.vistas[vista].html());
}

/*
Función de logueo del sistema
*/
flisol.loginFlisol = function(){	
	flisol.toggleLogin();
	$.ajax({
		url:"Login/usuario/"+$("#username").val()+"/clave/"+$.md5($("#password").val()),
		type: "GET",
		dataType: "json",
	})
	.done(function(data) {
		$("#username").val("");
		$("#password").val("");
		sessionStorage.nombre = data.nombre;
		sessionStorage.imagen = data.imagen;
		sessionStorage.api_key = data.api_key;
		sessionStorage.rol = data.rol;
		try{
			flisol['login_'+data.rol]();
		}catch(error){}		
	})
};

/*
Función que carga el menú del director de instalación
*/
flisol.login_DIRECTOR = function(){
	$("#menu_director").css({display:"block"});
	$('#menuLogged').show();
	$('#menuLogin').hide();	
	$('#menuLogged>a>span.nombre').html(sessionStorage.nombre);
};

/*
Función que carga el menú del recepcionista
*/
flisol.login_RECEPCIONISTA = function(){
	$("#menu_recepcionista").css({display:"block"});
	$('#menuLogged').show();
	$('#menuLogin').hide();	
	$('#menuLogged>a>span.nombre').html(sessionStorage.nombre);
};

/*
Función para cerrar sesión y resetear la vista.
*/
flisol.logoutFlisol = function(){
	sessionStorage.clear();
	$('#menuLogin').show();
	$('#menuLogged>a>span.nombre').html("");
	$('#menuLogged').hide();
	$('.menuFlisol').hide();
}

/*
WARNING: nombre excluyente, inicialmente fue sólo para buscar persona
pero después ya se añadió la funcionalidad como gestor dińamico de la vista
*/
flisol.buscarPersona = function(){
	var controlComentario=true;
	$("#comentario_registro").keydown(function(e){
		if(e.which===13){
			e.preventDefault();
			var comentario=flisol.vistas.comentarios.html();
			comentario=flisol.replace("{IMAGEN}",sessionStorage.imagen,comentario);
			comentario=flisol.replace("{NOMBRE}",sessionStorage.nombre,comentario);
			comentario=flisol.replace("{TIEMPO}","Ahora",comentario);			
			comentario=flisol.replace("{COMENTARIO}",$("#comentario_registro").val(),comentario);			
			if(controlComentario){
				comentario=flisol.replace("{POSICION}","left",comentario);
			}
			else{
				comentario=flisol.replace("{POSICION}","right",comentario);
			}
			controlComentario=!controlComentario;
			$("#comentarios_registro").append(comentario);
			$("#comentario_registro").val("");
		}
	});
	$.ajax({
		url:"Persona",
		type: "GET",
		dataType: "json",
	})
	.done(function(json) {
		$("#e10").select2({
			data:json.personas
		});
	})
}

/*
Función que obtiene el texto de los comentarios que se agruegan utilizando la plantilla
comentario, en este caso particular del formulario de registro de equipo.
*/
flisol.comentariosRegistro=function(){
	var comentarios=$("#comentarios_registro>li>div>.text");
	var texto="[";
	for(var i=0;i<comentarios.length;i++){
		if(i>0){
			texto+=",";
		}
		var c=comentarios[i];
		texto+='{"comentario":"'+c.innerText+'"}';
	}
	texto+="]";
	return texto;
}

/*
Función que registra equipo, serializa los datos del formulario y con 
comentariosRegistro() obtiene los comentarios del registro, que son JSON
*/
flisol.registrarEquipo = function(){
	$.ajax({
		type:"POST",
		beforeSend: function (request){
			request.setRequestHeader("API_KEY", sessionStorage.api_key);
		},
		url:'Equipo',
		data: $("#registrar_equipo_form").serialize()+"&comentarios="+flisol.comentariosRegistro(),
		success: function(msg) {
			//WARNING: mostrar mensaje u alerta cuando se registra el equipo.
		}
	});
}

/*
WARNING: cambiar nombre de la función pues más que enviar equipo, 
es la función que dinamiza el contenido de la vista enviar equipo del rol
RECEPCIONISTA
*/
flisol.enviarEquipo = function() {	
	$.ajax({
		url:"Equipo/tipo/REGISTRO",
		type: "GET",
		dataType: "json",
	})
	.done(function(json) {
		$("#e11").select2({
			data: json.equipos
		});
	});
	$.ajax({
		url:"Persona/tipo/TRANSPORTADOR",
		type: "GET",
		dataType: "json",
	})
	.done(function(json) {
		var arreglo=[];
		for(var i=0;i<json.participantes.length;i++){
			var p=json.participantes[i];
			arreglo[i]={id:p.id,text:p.nombre};
		}
		$("#e12").select2({
			data: arreglo
		});
	});
	$("#enviar_equipo").modal("show");
}

/*
Función que registra una nueva persona en el sistema
*/
flisol.registrarPersona = function(){	
	$.ajax({
		type:"POST",
		beforeSend: function (request){
			request.setRequestHeader("API_KEY", sessionStorage.api_key);
		},
		url:'Persona',
		data: $("#registrar_persona_form").serialize(),
		success: function(msg) {
			//WARNING: Mostrar alerta o algo para mayor comprensión.
		}
	});
};

/*
Usamos "data-flisol" para acceder a métodos presentes en el namespace flisol.
Ej: <a data-flisol="login">Acceder</a>	
Y también "data-vista" para cargar automáticamente una vista
*/
$(window).click(function(e){
	var button=e.srcElement||e.target;
	var dataView=button.getAttribute("data-vista");
	if(dataView!==null){
		try{
			flisol.setVista(dataView);
		}catch(error){}
	}
	var dataFlisol=button.getAttribute("data-flisol");
	if(dataFlisol!==null){
		try{
			flisol[dataFlisol]();
		}catch(error){}
	}
});

/*
Añadimos la url de la API por defecto.
*/
$.ajaxPrefilter(function(options) {
	options.url = "http://localhost/www/flisol_app/api/api.php/" +options.url;
});

/*
Comportamiento por defecto cuando ocurre un error.
*/
$(document).ajaxError(function( event, request, settings ) {
	var json=eval("("+request.responseText+")");
	//WARNING: aquí se debe mejorar la presentación del error.
	alert(json.descripcion);
});

/*
Onload document 
*/
$(function(){
	flisol.setVista("dashboard");
	if (typeof sessionStorage.rol !== "undefined") {
		try{
			flisol['login_'+sessionStorage.rol]();
		}catch(error){}   
	} else {
		$('#menu_Login').show();		
	}
});
