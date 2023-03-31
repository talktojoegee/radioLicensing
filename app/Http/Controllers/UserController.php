<?php

namespace App\Http\Controllers;

use App\Models\ModuleManager;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->user = new User();
        $this->modulemanager = new ModuleManager();
    }

    public function customerDashboard(){
        return 'Customer';
    }

    public function reGenerateApiToken(){
        $this->user->apiTokenGenerator();
        session()->flash("success", "New API token re-generated.");
        return back();
    }

    public function showPractitioners(){
        return view('administration.practitioners.index',[
            'users'=>$this->user->getAllOrganizationUsers()
        ]);
    }

    public function showAdministrators(){
        return view('administration.administrators',[
            'users'=>$this->user->getAllOrganizationUsers()
        ]);
    }

    public function showUserProfile($slug){
        $user = $this->user->getUserBySlug($slug);
        if(!empty($user)){
            return view('administration.profile',[
                'user'=>$user,
                'modules'=>$this->modulemanager->getModules()
            ]);
        }else{
            return back();
        }
    }

    public function addNewUser(Request $request){
        $this->validate($request,[
            "firstName"=>"required",
            "lastName"=>"required",
            "email"=>"required|email|unique:users,email",
            "userType"=>'required',
            "mobileNo"=>'required',
        ],[
            "firstName.required"=>"What's the person's first name?",
            "lastName.required"=>"Last name is very much important. What's the person's last name?",
            "email.required"=>"Enter a valid email address",
            "email.email"=>"Enter a valid email address",
            "email.unique"=>"There's already an account with this email address. Try another one.",
            "mobileNo.required"=>"Enter mobile number.",
        ]);
        $this->user->createUser($request);
        $message = "You've successfully added a new  user to the system.";
        session()->flash("success", $message);
        return back();
    }

    public function deleteUser(Request $request){
        $this->validate($request,[
            "userId"=>"required"
        ]);
        $user = $this->user->getUserById($request->userId);
        if(!empty($user)){
            $this->user->archiveUser($request->userId);
            session()->flash("success", "User account deleted!");
            return back();
        }else{
            return back();
        }
    }

    public function grantPermission(Request $request){
        $this->validate($request,[
            'permission'=>'required|array',
            'permission.*'=>'required',
            'user'=>'required'
        ]);
        $user = $this->user->getUserById($request->user);
        if(!empty($user)){
            $user->syncPermissions($request->permission);
            session()->flash("success", "You've successfully granted permission(s) to $user->first_name");
            return back();
        }else{
            session()->flash("error", "Whoops! Something went wrong. Please try again.");
            return back();
        }

    }


    public function showAddNewPastorForm(){
        return view('administration.add-new-user');
    }
}
