<?php

namespace App\Jobs;

use App\Notice;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $notice;
    /**
     * Create a new job instance.
     *构造函数
     * @return void
     */
    public function __construct(Notice $notice)
    {
        //
        $this->notice=$notice;
    }

    /**
     * Execute the job.
     *处理函数
     * @return void
     */
    public function handle()
    {
        //具体操作
        $users= User::all();
        foreach ($users as $user){
            $user->addNotice($this->notice);
        }
    }
}
