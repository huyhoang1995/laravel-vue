<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use  App\Listeners\SendWelcomeEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array('name' => 'huyhoang', 'email' => 'concuru@gmail.com', 'body' => 'Welcome to our website. Hope you will enjoy our articles');

        Mail::send('emails.mail', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Welcome to our Website');
            $message->from('noreply@artisansweb.net');
        });
    }
}
