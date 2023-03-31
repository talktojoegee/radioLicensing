<?php

namespace App\Listeners;

use App\Events\NewOrganizationRegistered;
use App\Models\FormField;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateDefaultFormFields
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
    public function handle(NewOrganizationRegistered $event)
    {
        $fields = [
            [
                'name'=>'name',
                'label'=>'Full Name',
                'required'=>1,
                'type'=>'text',
                'enabled'=>1
            ],
            [
                'name'=>'email',
                'label'=>'Email Address',
                'required'=>1,
                'type'=>'email',
                'enabled'=>1
            ],
            [
                'name'=>'phoneNo',
                'label'=>'Phone No.',
                'required'=>1,
                'type'=>'text',
                'enabled'=>1
            ],
            [
                'name'=>'address',
                'label'=>'Address',
                'required'=>0,
                'type'=>'textarea',
                'enabled'=>0
            ],
            [
                'name'=>'birthDate',
                'label'=>'Date of Birth',
                'required'=>0,
                'type'=>'date',
                'enabled'=>0
            ],
            [
                'name'=>'comment',
                'label'=>'Leave a comment',
                'required'=>0,
                'type'=>'textarea',
                'enabled'=>0
            ],
        ];
        foreach ($fields as $field){
            $field['org_id'] = $event->orgId;
            FormField::create($field);
        }
    }
}
