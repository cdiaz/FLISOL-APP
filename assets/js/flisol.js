window.flisol={
	json:{
		encode:function(objeto){
			return JSON.stringify(objeto);
		},
		decode:function(texto){
			return eval("("+texto+")");
		}
	},
	controlLogin:false,
	toggleLogin:function(){
		if(this.controlLogin){
			$('#loginform').hide();
		}
		else { 
			$('#loginform').show();
		}
		this.controlLogin=!this.controlLogin;
	}

};

flisol.login=function(){
	$.ajax({
		url:"Login/usuario/"+$("#username").val()+"/clave/"+$.md5($("#password").val()),
		type:"GET",
		success:function(datos){
			console.log(datos);
		}
	});	
}

/*
Usamos "data-flisol" para acceder a métodos presentes en el namespace flisol.
Ej: <a data-flisol="login">Acceder</a>	
*/
$(window).click(function(e){
    var button=e.srcElement||e.target;
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
	var json=flisol.json.decode(request.responseText);
	//WARNING: aquí se debe mejorar la presentación del error.
	alert(json.descripcion);
});



