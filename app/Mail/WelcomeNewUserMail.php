<?php

namespace App\Mail;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $organization;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Organization $organization)
    {
        $this->user = $user;
        $this->organization = $organization;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@healthdesk.com')
            ->subject('Congratulations! '.config('app.name'))
            //->bcc(env('MAIL_BCC', env('MAIL_BCC_NAME')))
            ->markdown('mails.welcome-new-user-mail');
    }
}
