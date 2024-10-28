<?php

namespace App\Jobs;

use App\Mail\StatusEmail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendStatusEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('يتم الآن بدء أرسال الرسائل');
        $allTasks = Task::where('status','pending')->get();
        $allEmails = User::select('email')->get();
        foreach($allEmails as $email){
            Mail::to($email)->send(new StatusEmail($allTasks));
            Log::info(' تم إرسال الرسالة إلى البريد الإلكتروني'.$email);
        }
    }
}
