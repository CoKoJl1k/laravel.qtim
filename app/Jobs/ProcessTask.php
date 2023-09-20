<?php
namespace App\Jobs;

use App\Mail\ReplyEmail;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        // var_dump($this->data);
        $replyEmail = new ReplyEmail('name', 1,'Ответ по заявке', 'emails.replyOrderEmail', 'comment');
        Mail::to('test@gmail.com')->send($replyEmail);
    }
}
