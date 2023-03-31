<?php

namespace App\Http\Livewire\Portal\Settings;

use App\Models\Location;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserNotificationSetting;
use App\Models\ModuleManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Account extends Component
{
    use WithFileUploads;

    public $firstName, $email, $cellphoneNumber, $timezone, $password, $password_confirmation, $profilePicture;
    public $lastName;
    public $locationName, $address, $locations, $locationId;
    public $notification;
    public $new_comment_posted, $new_journal_entry,$package_purchased,$intake_flow_started,$intake_flow_completed,
            $appointment_reminder, $client_books_appointment, $client_cancel_appointment, $shared_document,
            $shared_folder, $task_assigned, $task_status_updated, $program_module_completed;
    public $modules, $module;
    public $permissions, $permissionId, $permissionName;
    public $currentPassword;

    public function __construct()
    {
        $this->user = new User();
        $this->location = new Location();
        $this->usernotificationsettings = new UserNotificationSetting();
        $this->modulemanager = new ModuleManager();
        $this->permission = new Permission();
    }

    public function saveAccountChanges(){
        $validatedData = $this->validate([
            "firstName"=>"required",
            "lastName"=>"required",
            "cellphoneNumber"=>"required",
            "email"=>"required|email",
        ],[
            "firstName.required"=>"Enter your first name",
            "lastName.required"=>"Enter your last name",
            "cellphoneNumber.required"=>"Enter your cellphone number",
            "email.required"=>"Enter your email address",
            "email.email"=>"Enter a valid email address",
        ]);
        $this->user->updateUserAccount($validatedData);
        if(isset($this->profilePicture)){
            $this->user->uploadProfilePicture($this->profilePicture);
        }
        $this->reset();
        session()->flash('success', 'Your changes were save!');
    }

    public function saveUserNotificationChanges(){
        $validatedData = $this->validate([
            'new_comment_posted'=>'required', 'new_journal_entry'=>'required','package_purchased'=>'required','intake_flow_started'=>'required','intake_flow_completed'=>'required',
            'appointment_reminder'=>'required', 'client_books_appointment'=>'required', 'client_cancel_appointment'=>'required', 'shared_document'=>'required',
            'shared_folder'=>'required', 'task_assigned'=>'required', 'task_status_updated'=>'required', 'program_module_completed'=>'required'
        ]);
        $this->usernotificationsettings->editDefaultUserNotificationSettings(Auth::user()->id, $validatedData);
        $this->reset();
        session()->flash("success", "Your notification settings were updated!");
    }


    public function saveLocation(){
        $validatedData = $this->validate([
            "locationName"=>"required",
            "address"=>"required"
        ],[
            "locationName.required"=>"Enter location name",
            "address.required"=>"Enter address in the box provided",
        ]);
        $this->location->addLocation($validatedData);
        session()->flash("success", "The new location was added!");
        $this->reset();
    }
    public function editLocation(){
        $validatedData = $this->validate([
            "locationName"=>"required",
            "address"=>"required",
            "locationId"=>"required"
        ],[
            "locationName.required"=>"Enter location name",
            "address.required"=>"Enter address in the box provided",
        ]);
        $this->location->editLocation($validatedData);
        session()->flash("success", "Your location changes were saved!");
        $this->reset();
    }

    public function savePermission(){
        $validatedData = $this->validate([
            'permissionName'=>'required',
            'module'=>'required'
        ],[
            "permissionName.required"=>"Enter permission name",
            "module.required"=>"Select module related to this permission"
        ]);
        $this->permission->addPermission($validatedData);
        $this->reset();
        session()->flash("success", "Your permission was published!");
    }

    public function changePassword(){
        $this->validate([
            "currentPassword"=>"required",
            "password"=>"required|confirmed|min:6",
        ],[
            "currentPassword.required"=>"Enter your current password",
            "password.required"=>"Choose a new password",
            "password.confirmed"=>"Your re-type password does not match chosen password.",
        ]);
        $user = $this->user->getUserById(Auth::user()->id);
        if (Hash::check($this->currentPassword, $user->password)) {
            $user->password = bcrypt($this->password);
            $user->save();
            $this->reset();
            session()->flash("success", "Your password was successfully changed.");
        }else{
            session()->flash("error", "Current password does not match our record. Try again.");
            $this->reset();
        }
    }

    public function mounted(){

    }
    public function render()
    {
        $user = Auth::user();
        $this->notification = $this->user->getUserNotificationSettings(Auth::user()->id);
        $this->modules = $this->modulemanager->getModules();
        $this->permissions = $this->permission->getPermissions();
        $this->fill([
            'firstName'=>$user->first_name,
            'lastName'=>$user->last_name,
            'email'=>$user->email,
            'cellphoneNumber'=>$user->cellphone_no,
            'new_comment_posted'=>$this->notification->new_comment_posted,
            'new_journal_entry'=>$this->notification->new_journal_entry,
            'package_purchased'=>$this->notification->package_purchased,
            'intake_flow_started'=>$this->notification->intake_flow_started,
            'intake_flow_completed'=>$this->notification->intake_flow_completed,
            'program_module_completed'=>$this->notification->program_module_completed,
            'appointment_reminder'=>$this->notification->appointment_reminder,
            'client_books_appointment'=>$this->notification->client_books_appointment,
            'client_cancel_appointment'=>$this->notification->client_cancel_appointment,
            'shared_document'=>$this->notification->shared_document,
            'shared_folder'=>$this->notification->shared_folder,
            'task_assigned'=>$this->notification->task_assigned,
            'task_status_updated'=>$this->notification->task_status_updated,

        ]);
        $this->locations = $this->location->getLocations();
        return view('livewire.portal.settings.account')
            ->extends('layouts.master-layout')
            ->section('main-content');
    }
}
