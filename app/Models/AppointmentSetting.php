<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'org_id',
        'avail_by_appt_type',
        'avail_by_location',
        'avail_by_contact_type',
        'supported_contact_types',
        'init_phone_call_appt',
        'pre_same_day_appt',
        'appt_buffer',
        'only_allow_appt_spec_intervals',
        'min_time_advance',
        'max_time_advance',
        'calendar_start',
        'calendar_end',
        'send_init_notice_email',
        'client_email_reminder',
        'client_sms_reminder',
        'client_form_reminder',
        'client_can_cancel_appt',
        'client_can_reschedule_appt',
        'require_client_confirm_appt',
        'auto_confirm_appt',
        'client_can_cancel_appt_via_txt',
        'allow_book_without_credits',
        'restore_credit_when_appt_cancelled'
    ];


    public function editGeneralAvailability(Request $request){
       try{
           $avail = AppointmentSetting::where('user_id', Auth::user()->id)->first();
           $avail->avail_by_appt_type = $request->availByApptType == true ? 1 : 0;
           $avail->avail_by_location = $request->availByLocation == true ? 1 : 0;
           $avail->avail_by_contact_type = $request->availByContactType == true ? 1 : 0;
           $avail->save();
           return true;
       }catch (\Exception $ex){
          return false;
       }
    }
    public function editAppointmentTiming(Request $request){
       try{
           $avail = AppointmentSetting::where('user_id', Auth::user()->id)->first();
           $avail->pre_same_day_appt = $request->preSameDayAppt == true ? 1 : 0;
           $avail->appt_buffer = isset($request->apptBuffer) ? $request->apptBuffer : 0;
           $avail->only_allow_appt_spec_intervals = isset($request->onlyAllowApptSpecIntervals) ? $request->onlyAllowApptSpecIntervals : 0;
           $avail->min_time_advance = isset($request->minTimeAdvance) ? $request->minTimeAdvance : 1;
           $avail->max_time_advance = isset($request->maxTimeAdvance) ? $request->maxTimeAdvance : 1;
           $avail->calendar_start = isset($request->calendarStart) ? date('H:i:s',strtotime($request->calendarStart)) : null;
           $avail->calendar_end = isset($request->calendarEnd) ? date('H:i:s', strtotime($request->calendarEnd )) : null;
           $avail->save();
           return true;
       }catch (\Exception $ex){
          return false;
       }
    }

  public function editAppointmentAlerts(Request $request){
       try{
           $avail = AppointmentSetting::where('user_id', Auth::user()->id)->first();
           $avail->send_init_notice_email = $request->sendInitNoticeEmail == true ? 1 : 0;
           $avail->client_email_reminder = isset($request->clientEmailReminder) ? $request->clientEmailReminder : null;
           $avail->client_sms_reminder = isset($request->clientSmsReminder) ? $request->clientSmsReminder : null;
           $avail->client_form_reminder = $request->clientFormReminder == true ? 1 : 0;
           $avail->save();
           return true;
       }catch (\Exception $ex){
          return false;
       }
    }

 public function editConfirmationCancellation(Request $request){
       try{
           $avail = AppointmentSetting::where('user_id', Auth::user()->id)->first();
           $avail->client_can_cancel_appt = $request->clientCanCancelAppt == true ? 1 : 0;
           $avail->client_can_reschedule_appt = $request->clientCanRescheduleAppt == true ? 1 : 0;
           $avail->require_client_confirm_appt = $request->requireClientConfirmAppt == true ? 1 : 0;
           $avail->auto_confirm_appt = $request->autoConfirmAppt == true ? 1 : 0;
           $avail->client_can_cancel_appt_via_txt = $request->clientCanCancelApptViaTxt == true ? 1 : 0;
           $avail->save();
           return true;
       }catch (\Exception $ex){
          return false;
       }
    }

public function editCredits(Request $request){
       try{
           $avail = AppointmentSetting::where('user_id', Auth::user()->id)->first();
           $avail->allow_book_without_credits = $request->allowBookWithoutCredits == true ? 1 : 0;
           $avail->restore_credit_when_appt_cancelled = $request->restoreCreditWhenApptCancelled == true ? 1 : 0;
           $avail->save();
           return true;
       }catch (\Exception $ex){
          return false;
       }
    }



    public function getUserAppointmentSettings(){
        return AppointmentSetting::where('user_id', Auth::user()->id)->first();
    }
}
