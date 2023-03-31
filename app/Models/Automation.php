<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Automation extends Model
{
    use HasFactory;

    public function getOrgAutomations(){
        return Automation::where('org_id', Auth::user()->org_id)->orderBy('title', 'ASC')->get();
    }
    public function addAutomation(Request $request){
        $auto = new Automation();
        $auto->org_id = Auth::user()->org_id;
        $auto->title = $request->automationTitle ?? null;
        $auto->subject = $request->subject ?? null;
        $auto->message = $request->message ?? null;
        $auto->trigger_action = $request->triggerAction ?? 1;
        $auto->lead_source_id = $request->leadSource ?? null;
        $auto->membership_type_id = $request->membershipType ?? null;
        $auto->program_id = $request->program ?? null;
        $auto->absence_value = $request->absenceValue ?? null;
        $auto->send_after = $request->sendAfter ?? 0;
        $auto->time = $request->time ?? 0;
        $auto->type = $request->type ?? 1;
        $auto->slug = Str::slug($request->automationTitle).'-'.Str::random(8);
        $auto->save();
        return $auto;
    }
    public function editAutomation(Request $request){
        $auto =  Automation::find($request->automateId);
        $auto->org_id = Auth::user()->org_id;
        $auto->title = $request->automationTitle ?? null;
        $auto->subject = $request->subject ?? null;
        $auto->message = $request->message ?? null;
        $auto->trigger_action = $request->triggerAction ?? 1;
        $auto->lead_source_id = $request->leadSource ?? null;
        $auto->membership_type_id = $request->membershipType ?? null;
        $auto->program_id = $request->program ?? null;
        $auto->absence_value = $request->absenceValue ?? null;
        $auto->send_after = $request->sendAfter ?? 0;
        $auto->time = $request->time ?? 0;
        $auto->type = $request->type ?? 1;
        $auto->save();
        return $auto;
    }

    public function getAutomationBySlug($slug){
        return Automation::where('slug', $slug)->first();
    }
}
