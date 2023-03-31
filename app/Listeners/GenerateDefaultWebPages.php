<?php

namespace App\Listeners;

use App\Models\WebsitePage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateDefaultWebPages
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
        $fields = [
            [
                'page_title'=>'Home',
                'link'=>'/',
                'show_in_menu'=>1,
                'content'=>'Welcome to our platform',
                'status'=>1
            ],
            [
                'page_title'=>'Schedule',
                'link'=>'/schedule',
                'show_in_menu'=>1,
                'content'=>'Schedule an event',
                'status'=>1
            ],
            [
                'page_title'=>'Gallery',
                'link'=>'/gallery',
                'show_in_menu'=>1,
                'content'=>'Share your moment',
                'status'=>1
            ],
            [
                'page_title'=>'Contact us',
                'link'=>'/contact-us',
                'show_in_menu'=>1,
                'content'=>"We'll love to hear from you",
                'status'=>1
            ],

        ];
        foreach ($fields as $field){
            $field['org_id'] = $event->org->id;
            $field['created_by'] = $event->user->id;
            WebsitePage::create($field);
        }
    }
}
