<?php

namespace App\Listeners;

use App\Mail\WelcomeNewUserMail;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd('something here');
        \Mail::to($event->user)->send(new WelcomeNewUserMail($event->user, $event->org) );

    }
}
