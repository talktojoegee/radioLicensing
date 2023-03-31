<?php

namespace App\Listeners;

use App\Models\Homepage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateDefaultHomepageContentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $field =
            [
                'slider_caption'=>'Welcome on board!',
                'slider_image'=>'slider.png',
                'slider_cta_btn'=>'Learn More',
                'slider_caption_detail'=>'Bind brought it harvest super unpack that secular accountability group special music. Theology seeing the fruit oceans outreach, treasure that very relational father',
                'appointment_cta_btn'=>'Book Appointment',
                'appointment_detail'=>'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum and vitae a purus primis ipsum magna ipsum',
                'emergency_cta_btn'=>'Give us a call',
                'emergency_detail'=>'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum and vitae a purus primis ipsum magna ipsum',
                'welcome_written_by'=>'Joseph Gbudu',
                'welcome_message'=>'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum and vitae a purus primis ipsum magna ipsum',
            ];
            $field['org_id'] = $event->org->id;
            Homepage::create($field);

    }
}
