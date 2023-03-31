<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Location extends Model
{
    use HasFactory;

    public function addLocation(Request $request){
        $location = new Location();
        $location->org_id = Auth::user()->org_id;
        $location->location_name = $request->locationName;
        $location->has_rooms = $request->locationHasRoom == true ? 1 : 0;
        $location->booked_by_client = $request->bookedByClient == true ? 1 : 0;
        $location->save();
    }

    public function editLocation(Request $request){
        $location =  Location::find($request->locationId);
        $location->org_id = Auth::user()->org_id;
        $location->location_name = $request->locationName;
        $location->has_rooms = $request->locationHasRoom == true ? 1 : 0;
        $location->booked_by_client = $request->bookedByClient == true ? 1 : 0;
        $location->save();
    }

    public function getAllOrgLocations(){
        return Location::where('org_id', Auth::user()->org_id)->orderBy('location_name', 'ASC')->get();
    }
    public function getLocations(){
        return Location::orderBy('location_name', 'ASC')->get();
    }
}
