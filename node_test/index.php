<button data-flisol="cambio_estado">Cambiar un estado</button><br>
<button data-flisol="nuevo_equipo">Crear nuevo equipo</button><br><br>
<div id="datos">

</div>

<script src="http://localhost:1123/socket.io/socket.io.js"></script>
<script>
	window.soy="Sergio_"+parseInt(Math.random()*100);
	window.socket = io.connect('http://localhost:1123');
	socket.on('notificacion', function (data) {
		flisol.mostrar(data.info);
	});
	var flisol={
		mostrar:function(text){
			var div=document.getElementById("datos");
			div.innerHTML+=text+"<br>";
		},
		cambio_estado:function(){
			socket.emit('cambio_estado',{quien:soy});
		},
		nuevo_equipo:function(){
			socket.emit('nuevo_equipo',{quien:soy});
		}
	};

	window.onclick=function(e){
		var button=e.srcElement||e.target;
		var dataFlisol=button.getAttribute("data-flisol");
		if(dataFlisol!==null){
			try{
				flisol[dataFlisol]();
			}catch(error){}
		}
	};
	flisol.mostrar("<h1>"+soy+"</h1>");
</script>

