<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Mail\NewUserMail;
use App\Models\ActivityLog;
use App\Models\Country;
use App\Models\EmailQueue;
use App\Models\MaritalStatus;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PersonsController extends Controller
{
    public function __construct()
    {
        $this->user = new User();
        $this->country = new Country();
        $this->maritalstatus = new MaritalStatus();

    }

    public function showPersons(){
        return view('company.persons.index',[
            'users'=>$this->user->getAllOrganizationUsersByType(),
        ]);
    }
    public function showAddPersonForm(){
        return view('company.persons.add-new-person',[
            'countries'=>$this->country->getCountries(),
            'maritalstatus'=>$this->maritalstatus->getMaritalStatuses(),
        ]);
    }


    public function addNewPerson(Request $request){
        $this->validate($request,[
            "firstName"=>"required",
            "lastName"=>"required",
            "email"=>"required|email|unique:users,email",
            "userType"=>'required',
            "mobileNo"=>'required',
            "dob"=>'required|date',
            "occupation"=>'required',
            "nationality"=>'required',
            "maritalStatus"=>'required',
            "presentAddress"=>'required',
        ],[
            "firstName.required"=>"What's the person's first name?",
            "lastName.required"=>"Last name is very much important. What's the person's last name?",
            "email.required"=>"Enter a valid email address",
            "email.email"=>"Enter a valid email address",
            "email.unique"=>"There's already an account with this email address. Try another one.",
            "mobileNo.required"=>"Enter mobile number.",
            "dob.required"=>"Enter date of birth",
            "dob.date"=>"Invalid date format",
            "occupation.required"=>"What does this person do for a living?",
            "nationality.required"=>"What's the person's country or nationality?",
            "maritalStatus.required"=>"Choose marital status",
            "presentAddress.required"=>"Enter current or residential address",
        ]);
        try {
            $password = Str::random(8);
            $user = $this->user->createCompanyUser($request, $password);
            if(isset($request->avatar)){
                $this->user->uploadProfilePicture($request->avatar, $user->id);
            }

            $log = Auth::user()->first_name." ".Auth::user()->last_name." created $user->first_name $user->last_name 's account";
            ActivityLog::registerActivity(Auth::user()->org_id, null, Auth::user()->id, null, 'Account Creation', $log);
            $message = "You've successfully added a new  user to the system.";
            //try {
            Mail::to($user)->send(new NewUserMail($user, $password));
            EmailQueue::queueEmail($user->id, 'New Account', 'Your account was successfully registered.');

            session()->flash("success", $message);
            return back();
        }catch (\Exception $exception){
            session()->flash("error", 'Whoops! Something went wrong. Try again later.');
            return back();
        }

    }

    public function showPersonProfile($slug){
        $user = $this->user->getUserBySlug($slug);
        $branchId = $user->branch ?? 1;
        if(empty($branchId)){
            abort(404);
        }
        if(!empty($user)){

            if($user->id != Auth::user()->id){
                $authUser = Auth::user();
                $log = "You($authUser->email) viewed ".$user->first_name." ".$user->last_name."'s profile";
                ActivityLog::registerActivity($authUser->org_id, null, $authUser->id, null, 'Profile View', $log);
                //secondary person
                $log = "$authUser->first_name $authUser->last_name ($authUser->email) viewed your($user->first_name - $user->email) profile";
                ActivityLog::registerActivity($authUser->org_id, null, $user->id, null, 'Profile View', $log);
            }

            return view('company.persons.profile',[
                'user'=>$user,
                'countries'=>$this->country->getCountries(),
                'maritalstatus'=>$this->maritalstatus->getMaritalStatuses(),
            ]);
        }else{
            session()->flash("error", 'Whoops! No record found.');
            return back();
        }
    }

    public function updatePersonProfile(Request $request){
        $this->validate($request,[
            "firstName"=>"required",
            "lastName"=>"required",
            "mobileNo"=>'required',
            "occupation"=>'required',
            "nationality"=>'required',
            "maritalStatus"=>'required',
            "presentAddress"=>'required',
            "userId"=>'required',
        ],[
            "firstName.required"=>"What's the person's first name?",
            "lastName.required"=>"Last name is very much important. What's the person's last name?",
            "mobileNo.required"=>"Enter mobile number.",
            "occupation.required"=>"What does this person do for a living?",
            "nationality.required"=>"What's the person's country or nationality?",
            "maritalStatus.required"=>"Choose marital status",
            "presentAddress.required"=>"Enter current or residential address",
        ]);
        try {
            $authUser = Auth::user();
            $user = $this->user->updateUserAccount($request);
            if(isset($request->avatar)){
                $this->user->uploadProfilePicture($request->avatar, $user->id);
            }
            $log = $authUser->first_name." ".$authUser->last_name." updated $user->first_name $user->last_name 's profile";
            ActivityLog::registerActivity($authUser->org_id, null, $authUser->id, null, 'Account update', $log);
            //secondary
            $log = $authUser->first_name." ".$authUser->last_name." your profile";
            ActivityLog::registerActivity($authUser->org_id, null, $user->id, null, 'Account update', $log);
            $message = "Action successful!";
            session()->flash("success", $message);
            return back();
        }catch (\Exception $exception){
            session()->flash("error", 'Whoops! Something went wrong. Try again later.');
            return back();
        }

    }

}
