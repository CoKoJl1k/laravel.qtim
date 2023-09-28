/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


import io from 'socket.io-client';
import Echo from 'laravel-echo';

// Подключение к серверу Socket.IO
const socket = io('http://127.0.0.1:6001'); // Замените на URL вашего сервера Socket.IO

console.log(socket);

// Подписка на канал
socket.on('connect', () => {
    // Подключение успешно
    console.log('Успешное подключение к серверу Socket.IO');

    // Подключение к каналу 'chat'
    socket.emit('subscribe', 'chat');
});

// Обработка событий канала
socket.on('chat', (message) => {
    console.log('Новое сообщение:', message);
});
/*

window.Echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    host: 'http://127.0.0.1:6001',
    // host: window.location.hostname + '127.0.0.1:6001', // Используйте правильный хост и порт сервера сокетов
});

window.Echo.channel('chat')
    .listen('NewMessage', (data) => {
        console.log('Received data:', data);
    });
*/
// window.Echo.channel('chat')
//     .whisper('NewMessage', {
//         message: 'Hello, Laravel Echo Server!',
//     });

//window.Echo.connect();
console.log(6666666666);
//console.log(window.Echo);


// window.Echo.connector.socket.on('connect', () => {
//     console.log('Успешное подключение к серверу сокетов');
// });
// Подключение к каналу 'chat'

/*
window.Echo.channel('chat')
    .listen('NewMessage', (event) => {
        console.log('Новое сообщение:', event.message);
    });
*/

/*
const echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    host: 'http://127.0.0.1:8000',
    // Other configuration options
});*/

/*
window.Echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    host: 'http://127.0.0.1:8000',
});
// Listen for the "chat" channel events
window.Echo.channel('chat')
    .listen('NewMessage', (event) => {
        console.log(event.message);
        // Handle the received event data
    });
*/
/*
const echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://127.0.0.1:8000',
    // Other configuration options
});*/

// Listen for an event
/*
echo.channel('chat')
    .listen('MessagePosted', (event) => {
        console.log('Received event:', event);
    });*/
/*
window.Echo.channel('chat')
    .listen('NewMessage', (event) => {
        console.log('Received new message:', event.message);
    });
*/
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
