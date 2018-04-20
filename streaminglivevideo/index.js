const http = require('http').Server();
const io = require('socket.io')(http);

io.on('connection', function (socket) {
  socket.on('offerInitiator', data => {
    socket.broadcast.emit('offerForClient', data)
  });

  socket.on('answerClient', data => {
    socket.broadcast.emit('answerForInitiator', data)
  });
});

http.listen(3000, () => {
  console.log('listening on *:3000');
});