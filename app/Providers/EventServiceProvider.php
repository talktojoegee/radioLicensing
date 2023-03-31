<?php

namespace App\Providers;

use App\Events\NewOrganizationRegistered;
use App\Events\SendWelcomeEmail;
use App\Listeners\GenerateDefaultAppointmentTypes;
use App\Listeners\GenerateDefaultFormFields;
use App\Listeners\GenerateDefaultHomepageContentListener;
use App\Listeners\GenerateDefaultWebPages;
use App\Listeners\SendWelcomeEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewOrganizationRegistered::class=>[
            GenerateDefaultAppointmentTypes::class,
            GenerateDefaultFormFields::class,

        ],
        SendWelcomeEmail::class=>[
          SendWelcomeEmailListener::class,
          GenerateDefaultWebPages::class,
          GenerateDefaultHomepageContentListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
