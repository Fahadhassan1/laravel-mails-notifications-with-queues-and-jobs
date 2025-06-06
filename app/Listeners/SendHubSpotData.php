<?php

namespace App\Listeners;

use App\Events\HubSpotRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendHubSpotData implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(HubSpotRegistered $event): void
    {
    
         Mail::to($event->user->email)->send(new \App\Mail\WelcomeMail($event->user));
    }
}
