
//console.log('js/scripts.js');

// import io from 'socket.io-client';
// import Echo from 'laravel-echo';

/*
window.Echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    host: 'http://127.0.0.1:6001',
    // host: window.location.hostname + '127.0.0.1:6001', // Используйте правильный хост и порт сервера сокетов
});

//window.Echo.connect();
console.log(6666666666);
console.log(window.Echo);


// window.Echo.connector.socket.on('connect', () => {
//     console.log('Успешное подключение к серверу сокетов');
// });
// Подключение к каналу 'chat'
window.Echo.channel('chat')
    .listen('NewMessage', (event) => {
        console.log('Новое сообщение:', event.message);
    });


/*
const host = '127.0.0.1';
const port = 6001;
const message = 'Hello Server';

console.log('Message To server: ' + message);

// Create WebSocket connection
const socket = new WebSocket('ws://' + host + ':' + port);

// Connection opened event
socket.onopen = function(event) {
    console.log('WebSocket connection established');

    // Send message to server
    socket.send(message);
};

// Message received event
socket.onmessage = function(event) {
    console.log('Reply From Server: ' + event.data);
};

// Error event
socket.onerror = function(error) {
    console.error('WebSocket error:', error);
};

// Connection closed event
socket.onclose = function(event) {
    console.log('WebSocket connection closed:', event.code, event.reason);
};

*/
