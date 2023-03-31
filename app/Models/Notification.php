<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    public static function setNewNotification($subject, $body, $route_name, $route_param, $route_type, $user_id, $orgId){
        $notify = new Notification();
        $notify->user_id = $user_id;
        $notify->org_id = $orgId;
        $notify->subject = $subject ?? '';
        $notify->body = $body ?? '';
        $notify->route_name = $route_name ?? '';
        $notify->route_param = $route_param ?? '';
        $notify->route_type = $route_type ?? "" ;
        $notify->is_read = 0; //not read
        $notify->save();
    }


    public function clearAll($userId){
        $notifications = Notification::where('user_id', $userId)->get();
        foreach($notifications as $notification){
            $notification->is_read = 1;
            $notification->read_at = now();
            $notification->save();
        }
    }
}
