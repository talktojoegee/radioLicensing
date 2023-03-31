<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserNotificationSetting extends Model
{
    use HasFactory;

    public function publishDefaultNotificationSettings($userId){
        $notify = new UserNotificationSetting();
        $notify->user_id = $userId;
        $notify->new_comment_posted = 1;
        $notify->new_journal_entry = 1;
        $notify->package_purchased = 1;
        $notify->intake_flow_started = 1;
        $notify->intake_flow_completed = 1;
        $notify->program_module_completed = 1;
        $notify->chat_message = 1;
        $notify->group_chat_message = 1;
        $notify->appointment_reminder = 1;
        $notify->client_books_appointment = 1;
        $notify->client_cancel_appointment = 1;
        $notify->shared_document = 1;
        $notify->shared_folder = 1;
        $notify->task_assigned = 1;
        $notify->task_status_updated = 1;
        $notify->save();
    }
    public function editDefaultUserNotificationSettings($userId, Request $request){
        $notify =  UserNotificationSetting::where('user_id', $userId)->first();
        $notify->user_id = $userId;
        $notify->new_comment_posted = $request->new_comment_posted == true ? 1 : 0;
        $notify->new_journal_entry =  $request->new_journal_entry == true ? 1 : 0;
        $notify->package_purchased =  $request->package_purchased == true ? 1 : 0;
        $notify->intake_flow_started =  $request->intake_flow_started == true ? 1 : 0;
        $notify->intake_flow_completed =  $request->intake_flow_completed == true ? 1 : 0;
        $notify->program_module_completed =  $request->program_module_completed == true ? 1 : 0;
        //$notify->chat_message =  $data['chat_message'] == true ? 1 : 0;
        //$notify->group_chat_message =  $data['group_chat_message'] == true ? 1 : 0;
        $notify->appointment_reminder =  $request->appointment_reminder == true ? 1 : 0;
        $notify->client_books_appointment =  $request->client_books_appointment == true ? 1 : 0;
        $notify->client_cancel_appointment =  $request->client_cancel_appointment == true ? 1 : 0;
        $notify->shared_document =  $request->shared_document == true ? 1 : 0;
        $notify->shared_folder =  $request->shared_folder == true ? 1 : 0;
        $notify->task_assigned =  $request->task_assigned == true ? 1 : 0;
        $notify->task_status_updated =  $request->task_status_updated == true ? 1 : 0;
        $notify->save();
    }
}
