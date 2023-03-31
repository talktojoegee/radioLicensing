<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppointmentType extends Model
{
    use HasFactory;

    public function getAppointmentTypes(){
        return AppointmentType::orderBy('name', 'ASC')->get();
    }

    public function addAppointmentType(Request $request){
        $appt = new AppointmentType();
        $appt->name = $request->name ?? '';
        $appt->length = $request->length ?? '';
        $appt->all_client_book = $request->allClientBook == true ? 1 : 2;
        $appt->client_can_book = $request->clientCanBook == true ? 1 : 0;
        $appt->group_appt = $request->groupAppointment == true ? 1 :0;
        $appt->phone_call = $request->phoneCall == true ? 1 : 0;
        $appt->telehealth = $request->telehealth == true ? 1 : 0;
        $appt->in_person = $request->inPerson == true ? 1 : 0;
        $appt->save();
    }
    public function updateAppointmentType(Request $request){
        $appt =  AppointmentType::find($request->apptId);
        $appt->name = $request->name ?? '';
        $appt->length = $request->length ?? '';
        $appt->all_client_book = $request->allClientBook == true ? 1 : 2;
        $appt->client_can_book = $request->clientCanBook == true ? 1 : 0;
        $appt->group_appt = $request->groupAppointment == true ? 1 :0;
        $appt->phone_call = $request->phoneCall == true ? 1 : 0;
        $appt->telehealth = $request->telehealth == true ? 1 : 0;
        $appt->in_person = $request->inPerson == true ? 1 : 0;
        $appt->save();
    }
}
