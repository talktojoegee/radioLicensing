<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSetting;
use App\Models\AppointmentType;
use App\Models\ChurchBranch;
use App\Models\Country;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Region;
use App\Models\State;
use App\Models\User;
use App\Models\UserNotificationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = new User();
        $this->usernotificationsettings = new UserNotificationSetting();
        $this->appointmentsettings = new AppointmentSetting();
        $this->appointmenttype = new AppointmentType();
        $this->location = new Location();
        $this->country = new Country();
        $this->organization = new Organization();
        $this->churchbranch = new ChurchBranch();
        $this->region = new Region();
        $this->state = new State();
    }

    public function showSettingsView(){
        return view('settings.settings',[
            'countries'=>$this->country->getCountries()
        ]);
    }


    public function saveAccountSettings(Request $request){
        $this->validate($request,[
            "firstName"=>"required",
            "lastName"=>"required",
            "cellphoneNumber"=>"required",
            "email"=>"required|email",
            "country"=>"required",
            //"state"=>"required",
        ],[
            "firstName.required"=>"Enter your first name",
            "lastName.required"=>"Enter your last name",
            "cellphoneNumber.required"=>"Enter your cellphone number",
            "email.required"=>"Enter your email address",
            "email.email"=>"Enter a valid email address",
            "country.required"=>"Select your country",
            //"state.required"=>"Which state/province are you located in?",
        ]);
        $this->user->updateUserAccount($request);
        if(isset($request->profilePicture)){
            $this->user->uploadProfilePicture($request->profilePicture);
        }
        session()->flash('success', 'Your changes were save!');
        return back();
    }

    public function showNotificationSettings(){
        return view('settings.notification',[
            'notification'=>$this->user->getUserNotificationSettings(Auth::user()->id)
        ]);
    }

    public function saveNotificationSettings(Request $request){
        $this->usernotificationsettings->editDefaultUserNotificationSettings(Auth::user()->id, $request);
        session()->flash("success", "Your notification settings were updated!");
        return back();
    }

    public function showAppointmentSettings(){
        return view('settings.appointments', ['settings'=>$this->appointmentsettings->getUserAppointmentSettings()]);
    }

    public function showChangePasswordForm(){
        return view('settings.change-password');
    }

    public function changePassword(Request $request){
        $this->validate($request,[
            "currentPassword"=>"required",
            "password"=>"required|confirmed|min:6",
        ],[
            "currentPassword.required"=>"Enter your current password",
            "password.required"=>"Choose a new password",
            "password.confirmed"=>"Your re-type password does not match chosen password.",
        ]);
        $user = $this->user->getUserById(Auth::user()->id);
        if (Hash::check($request->currentPassword, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            session()->flash("success", "Your password was successfully changed.");
            return back();
        }else{
            session()->flash("error", "Current password does not match our record. Try again.");
            return back();
        }
    }

    public function updateAppointmentSettings(Request $request){
        switch ($request->type){
            case 'general-availability':
                $result = $this->appointmentsettings->editGeneralAvailability($request);
                if($result){
                    return response()->json(['message'=>"Your general availability changes were saved!"],200);
                }else{
                    return response()->json(['error'=>"Something went wrong. Try again later"],400);
                }
            case 'appointment-timing':
                $result = $this->appointmentsettings->editAppointmentTiming($request);
                if($result){
                    return response()->json(['message'=>"Your appointment timing changes were saved!"],200);
                }else{
                    return response()->json(['error'=>"Something went wrong. Try again later"]);
                }
            case 'appointment-alerts':
                $result = $this->appointmentsettings->editAppointmentAlerts($request);
                if($result){
                    return response()->json(['message'=>"Your appointment alert changes were saved!"],200);
                }else{
                    return response()->json(['error'=>"Something went wrong. Try again later"]);
                }
            case 'confirmation-cancellation':
                $result = $this->appointmentsettings->editConfirmationCancellation($request);
                if($result){
                    return response()->json(['message'=>"Your confirmation & cancellation changes were saved!"],200);
                }else{
                    return response()->json(['error'=>"Something went wrong. Try again later"]);
                }
            case 'credits':
                $result = $this->appointmentsettings->editCredits($request);
                if($result){
                    return response()->json(['message'=>"Your credits changes were saved!"],200);
                }else{
                    return response()->json(['error'=>"Something went wrong. Try again later"]);
                }
        }


    }


    public function showAppointmentTypeSettings(){
        return view('settings.appointment-types',[
            'appointmentTypes'=>$this->appointmenttype->getAppointmentTypes()
        ]);
    }

    public function storeAppointmentType(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "length"=>"required",
            "allClientBook"=>"required"
        ]);
        $this->appointmenttype->addAppointmentType($request);
        session()->flash("success", "New appointment type registered!");
        return back();
    }


    public function editAppointmentType(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "length"=>"required",
            "allClientBook"=>"required",
            "apptId"=>"required"
        ]);
        $this->appointmenttype->updateAppointmentType($request);
        session()->flash("success", "Your changes were saved!");
        return back();
    }

    public function showApptLocations(){
        return view('settings.appt-locations',[
            'locations'=>$this->location->getAllOrgLocations()
        ]);
    }

    public function storeApptLocations(Request $request){
        $this->validate($request,[
           "locationName"=>"required"
        ],[
            "locationName.required"=>"Enter location name"
        ]);
        $this->location->addLocation($request);
        session()->flash("success", "You've successfully added a new location");
        return back();

    }
  public function editApptLocations(Request $request){
        $this->validate($request,[
           "locationName"=>"required",
            "locationId"=>"required"
        ],[
            "locationName.required"=>"Enter location name"
        ]);
        $this->location->editLocation($request);
        session()->flash("success", "Your changes were saved!");
        return back();

    }

    public function updateOrganizationSettings(Request $request){
        $this->validate($request,[
           "subDomain"=>"required|unique:organizations,sub_domain,".Auth::user()->id,
            "organizationName"=>"required",
            "organizationPhoneNumber"=>"required",
            "organizationEmail"=>"required",
            "addressLine"=>"required",
            "city"=>"required",
            "zipCode"=>"required",
            "orgId"=>"required",
        ],[
            "organizationName.required"=>"What's the name of your organization?",
            "subDomain.required"=>"A custom sub-domain is required",
            "subDomain.unique"=>"This sub-domain is already taken.",
            "organizationPhoneNumber.required"=>"What's the organization's phone number?",
            "organizationEmail.required"=>"What's the organization's email address?",
            "addressLine.required"=>"An address is required",
            "city.required"=>"In which city are you situated?",
            "zipCode.required"=>"What's the region zip code?",
            "orgId.required"=>""
        ]);
        $this->organization->updateOrganizationSettings($request);
        if($request->hasFile('logo')){
            $this->organization->uploadLogo($request->logo);
        }
        if($request->hasFile('favicon')){
            $this->organization->uploadFavicon($request->favicon);
        }
        session()->flash("success", "Your changes were saved!");
        return back();

    }




    public function showCellsSettingsView(){
        return view('settings.settings-cells',[
            'countries'=>$this->country->getCountries()
        ]);
    }

    public function showBranchesSettingsView(){
        $countryId = env('COUNTRY_ID') ?? 1;
        return view('settings.settings-branches',[
            'countries'=>$this->country->getCountries(),
            'branches'=>$this->churchbranch->getAllChurchBranches(),
            'regions'=>$this->region->getRegions(),
            'states'=>$this->state->getStatesByCountryId($countryId)
        ]);
    }

    public function storeChurchBranch(Request $request){
        $this->validate($request,[
            "branchName"=>"required",
            "country"=>"required",
            "state"=>"required",
            "address"=>"required",
            "region"=>"required",
        ],[
            "branchName.required"=>"What will you call this branch?",
            "country.required"=>"Which country is this branch situated?",
            "state.required"=>"Select the state",
            "address.required"=>"Enter address",
            "region.required"=>"Select region",
        ]);
        try{
            $this->churchbranch->addBranch($request);
            session()->flash("success", "You've successfully added a new church branch");
            return back();
        }catch (\Exception $exception){
            session()->flash("error", "Whoops! Something went wrong. Try again later or contact admin.");
            return back();
        }


    }

    public function editChurchBranch(Request $request){
        $this->validate($request,[
            "branchName"=>"required",
            "country"=>"required",
            "state"=>"required",
            "address"=>"required",
            "branchId"=>'required',
            "region"=>'required',
        ],[
            "branchName.required"=>"What will you call this branch?",
            "country.required"=>"Which country is this branch situated?",
            "state.required"=>"Select the state",
            "address.required"=>"Enter address",
            "region.required"=>"Select region",
        ]);
        try{
            $this->churchbranch->editBranch($request);
            session()->flash("success", "Your changes were saved.");
            return back();
        }catch (\Exception $exception){
            session()->flash("error", "Whoops! Something went wrong. Try again later or contact admin.");
            return back();
        }


    }

}
