<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewOrganizationRegistered;
use App\Events\SendWelcomeEmail;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeNewUserMail;
use App\Models\FormField;
use App\Models\Organization;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User();
        $this->organization = new Organization();
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'firstName'=>'required',
            'organizationName'=>'required',
            'phoneNumber'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
            'terms'=>'required'
        ],[
            'organizationName.required'=>"What's the name of your organization or company?",
            'firstName.required'=>'Enter first name in the field provided.',
            'phoneNumber.required'=>'What is your phone number?',
            'email.required'=>'Enter email address',
            'email.email'=>'Enter a valid email address',
            'email.unique'=>"There's an account with this email address. Try another one.",
            'password.required'=>'Enter your chosen password',
            'password.confirmed'=>'Password confirmation mis-matched. Try again.',
            'terms.required'=>'It is important you accept our terms & conditions to proceed'
        ]);
        //DB::transaction(function(Request $request){
            $org = $this->organization->registerOrganziationDuringRegistration($request->organizationName, $request->phoneNumber, $request->email);
            $user = $this->user->registerUser($request, $org->id);

            event(new NewOrganizationRegistered($org->id));
            event(new SendWelcomeEmail($user, $org) );
       // });

        session()->flash("success", "Congratulations! Your account was created successfully. Login to your account...");
        return redirect()->route('login');

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
