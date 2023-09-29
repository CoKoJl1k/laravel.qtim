<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Pusher;

class MessageController extends Controller
{

    public function index()
    {
        return view('channels.index');
    }

    public function send()
    {
        return  'do nothing';
    }

    public function sendMessage(Request $request)
    {
        $pusher = new Pusher\Pusher(env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );
        $data['message'] = 'Hello, Pusher!';
        $pusher->trigger('chat', 'NewMessage', $data);

        return 'Message sent to Pusher!';
    }


    public function sendMessage2(Request $request)
    {
        $message = $request->input('message');
        // Отправляем событие NewMessage через канал вещания
        event(new NewMessage($message));
        return response()->json(['message' => 'Сообщение отправлено '.$message]);
    }
}
