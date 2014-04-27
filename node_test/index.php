<button data-flisol="cambio_estado">Cambiar un estado</button><br>
<div id="datos">

</div>

<script src="jquery.js"></script>
<script src="http://localhost:1123/socket.io/socket.io.js"></script>
<script>
	window.soy="Sergio_"+parseInt(Math.random()*100);
	window.socket = io.connect('http://localhost:1123');
	socket.on('cambio_estado', function (data) {
		flisol.mostrar(data.info);
	});
	socket.on('login', function (data) {
		flisol.mostrar(data.info);
	});
	var flisol={
		mostrar:function(text){
			var div=document.getElementById("datos");
			div.innerHTML+=text+"<br>";
		},
		cambio_estado:function(){
			$.ajax({
				url:"cambiar_estado.php",
				data:{quien:soy},
				type:"POST"
			});
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

