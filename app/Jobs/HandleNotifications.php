<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $subject, $body, $route_name, $route_param, $route_type, $user_id, $org_id;
    public function __construct($subject, $body, $route_name, $route_param, $route_type, $user_id, $org_id)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->route_name = $route_name;
        $this->route_param = $route_param;
        $this->route_type = $route_type;
        $this->user_id = $user_id;
        $this->org_id = $org_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            Notification::setNewNotification($this->subject, $this->body, $this->route_name,
                $this->route_param, $this->route_type, $this->user_id, $this->org_id);
        }catch (\Exception $exception){

        }

    }
}
