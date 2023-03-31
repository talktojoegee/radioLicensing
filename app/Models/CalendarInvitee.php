<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarInvitee extends Model
{
    use HasFactory;

    public function getClient(){
        return $this->belongsTo(Client::class, 'invitee_id');
    }

    public function getCalendar(){
        return $this->belongsTo(Calendar::class, 'calendar_id');
    }

    public function addInvitee($calendarId, $inviteeId){
        $invite = new CalendarInvitee();
        $invite->calendar_id = $calendarId;
        $invite->invitee_id = $inviteeId;
        $invite->save();
    }

    public function pluckAppointmentIdsByInviteeId($inviteeId){
        return CalendarInvitee::whereIn('invitee_id', $inviteeId)->pluck('calendar_id');
    }
}


