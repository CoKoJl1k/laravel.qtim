<?php
namespace App\Listeners;

use App\Events\NewMessage;

class NewMessageListener
{
    public function handle(NewMessage $event)
    {
        // Обработка события, отправка сообщения на канал 'chat'
        //event(new NewMessage($event->message));
    }
}
