<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{

    public function index()
    {
        return view('channels.index');
    }

    public function send()
    {
        $host    = "127.0.0.1";
        $port    = 6001;
        $message = " Hello Server ";
        echo "Message To server :".$message;
        // create socket
        $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
        var_dump($socket);
        // connect to server
        $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
        // send string to server
        var_dump($result);
        $send=   socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
        // get server response
        var_dump($send);
        $result = socket_read ($socket, 1024) or die("Could not read server response\n");
        // var_dump($result);
        // echo "Reply From Server  :".$result;
        // close socket
        socket_close($socket);

/*
      // var_dump('method send');
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// Устанавливаем параметры сокета
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
        socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
// Подключаемся к серверу сокетов
        $result = socket_connect($socket, '127.0.0.1', 6001);
// Проверяем успешность подключения
        if ($result === false) {
            echo "Ошибка подключения к серверу сокетов: " . socket_strerror(socket_last_error());
        } else {
            echo "Успешное подключение к серверу сокетов";

            // Отправляем данные на сокет
            $data = "Hello, server!";
            socket_write($socket, $data, strlen($data));
            // Получаем ответ от сервера
            $response = socket_read($socket, 1024);
            echo "Ответ от сервера: " . $response;
            // Закрываем сокет
            socket_close($socket);
        }*/
     /*
        $response = Http::post('http://127.0.0.1:8000/send-message', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'message'=> 'Hello i am here'
        ]);
        if ($response->successful()) {
            // Request was successful
            $data = $response->json(); // Get the response data as JSON
            return response()->json(['message' => 'Сообщение отправлено', 'data' => $data]);
            // Do something with the data
        } else {
            // Request failed
            $statusCode = $response->status(); // Get the HTTP status code
            $error = $response->body(); // Get the response body
            return response()->json(['error' => $error]);
        }*/
    }

    public function sendMessage(Request $request)
    {
        //  dd($request);
        $message = $request->input('message');
        // Отправляем событие NewMessage через канал вещания
       // var_dump($message);
        event(new NewMessage($message));
        return response()->json(['message' => 'Сообщение отправлено '.$message]);
    }
}
