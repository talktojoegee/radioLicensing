<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Workstation extends Model
{
    use HasFactory;


    public function getLocation(){
        return $this->belongsTo(State::class,'transmitter_location');
    }

    public function getCreatedBy(){
        return $this->belongsTo(User::class,'created_by');
    }


    public function newWorkstation(Request $request){
        $station = new Workstation();
        $station->company_id = Auth::user()->org_id;
        $station->created_by = Auth::user()->id;
        $station->state_id = $request->location ?? null;
        $station->name = $request->stationName ?? null;
        $station->address = $request->address ?? null;
        $station->mobile_no = $request->mobileNo ?? null;
        $station->capacity = 0;
        $station->transmitter_location = $request->location ?? null;
        $station->operation_schedule = $request->dayTime ?? null;
        $station->status = $request->status ?? 0;
        $station->long = $request->long ?? null;
        $station->lat = $request->lat ?? null;
        $station->slug = Str::slug($request->stationName).'-'.substr(sha1(time()),25,40);
        $station->save();
        return $station;
    }
    public function editWorkstation(Request $request){
        $station =  Workstation::find($request->stationId);
        $station->state_id = $request->location ?? null;
        $station->name = $request->stationName ?? null;
        $station->address = $request->address ?? null;
        $station->mobile_no = $request->mobileNo ?? null;
        $station->transmitter_location = $request->location ?? null;
        $station->operation_schedule = $request->dayTime ?? null;
        $station->capacity = 0;
        $station->status = $request->status ?? 0;
        $station->long = $request->long ?? null;
        $station->lat = $request->lat ?? null;
        $station->save();
        return $station;
    }

    public function getWorkstationsByCompanyId($companyId){
        return Workstation::where('company_id', $companyId)->orderBy('id', 'DESC')->get();
    }

    public function getWorkstationBySlug($slug){
        return Workstation::where('slug', $slug)->first();
    }
}
