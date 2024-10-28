<?php

namespace App\Console\Commands;

use App\Jobs\SendStatusEmail;
use Illuminate\Console\Command;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Log;

class SendStatusTaskEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-status-task-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'we will send email daily to all users where tasks status is pending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SendStatusEmail::dispatch();
        Log::info('تم تشغيل الجوب بنجاح');
    }
}
