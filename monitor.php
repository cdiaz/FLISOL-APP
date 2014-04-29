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
		
	};

</script>