const http = require('http').Server();


const io = require('socket.io')(http);

io.on('connection', function(socket){
//   console.log('a user connected');
//   socket.on('disconnect', function(){
//     console.log('user disconnected');
//   });

  socket.on('stream', data => {
      socket.broadcast.emit('retour', data);
      //console.log(data);
  });
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});