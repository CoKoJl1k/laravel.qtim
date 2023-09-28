@extends('home')

@section('content')
    <p>It is content</p>
    <script>

/*
        Echo.channel('chat')
            .listen('NewMessage', (e) => {
                console.log('Новое сообщение:', e.message);
            });
*/
    /*
        const echo = new Echo({
            broadcaster: 'socket.io',
            host: 'http://127.0.0.1:8000',
            // Other configuration options
        });

        echo.channel('chat').listen('NewMessage', function(e) {
            console.log('New message:', e.message);

            // Make an HTTP request using the Fetch API
            fetch('http://127.0.0.1:8000/messages')
                .then(function(response) {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('API error:', response.statusText);
                    }
                })
                .then(function(data) {
                    console.log('API response:', data);
                    // Do something with the response data
                })
                .catch(function(error) {
                    console.error('API error:', error);
                    // Handle the error
                });
        });*/
    /*
        const axios = require('axios');
        const Echo = require('laravel-echo');

        // Initialize Echo with your configuration
        const echo = new Echo({
            broadcaster: 'socket.io',
            host: 'http://127.0.0.1:8000',
            // Other configuration options
        });

        echo.channel('chat').listen('NewMessage', (e) => {
            console.log('New message:', e.message);

            // Make an HTTP request using Axios
            axios.get('http://127.0.0.1:8000/messages')
                .then(response => {
                    console.log('API response:', response.data);
                    // Do something with the response data
                })
                .catch(error => {
                    console.error('API error:', error);
                    // Handle the error
                });
        });
*/
        //import axios from 'axios';
        // const axios = require('axios');
        // Echo.channel('chat')
        //     .listen('NewMessage', (e) => {
        //         console.log('Новое сообщение:', e.message);
        //     });
    </script>
@endsection

