<?php
namespace App\Listeners;

use App\Events\NewMessage;

class NewMessageListener
{
    public function handle(NewMessage $event)
    {
         var_dump($event->message);
        // Обработка события, отправка сообщения на канал 'chat'

        // event(new NewMessage($event->message));
    }
}
