<?php

namespace App\Listeners;

use App\Events\Eventmail;
use App\Mail\Senduserotp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
// implements ShouldQueue
class SendEmail 
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
       

    }

    /**
     * Handle the event.
     */
    public function handle(Eventmail $event): void
    {
       
        $user=$event->user;
        $otp=$event->otp;
        Mail::to($user->email)->queue(new Senduserotp($user,$otp));
    }
}
