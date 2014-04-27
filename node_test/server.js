var app = require('http').createServer(function(request,response){
  response.writeHead(200);
  response.end("Servidor de Notificaciones :)");
});
app.listen(1123);

io = require('socket.io').listen(app);

var clientes=[];
io.sockets.on('connection', function (socket) {
  clientes.push(socket);
  socket.on('cambio_estado', function (data) {
    for(i=0;i<clientes.length;i++){
      var cliente=clientes[i];
      cliente.emit('notificacion',{info:data.quien+' ha cambiado de estado'});
    }
  });
  socket.on('nuevo_equipo', function (data) {
    for(i=0;i<clientes.length;i++){
      var cliente=clientes[i];
      cliente.emit('notificacion',{info:data.quien+' ha agregado un equipo'});
    }
  });
});