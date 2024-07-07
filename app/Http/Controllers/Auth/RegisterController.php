<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewOrganizationRegistered;
use App\Events\SendWelcomeEmail;
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Mail\WelcomeNewUserMail;
use App\Models\EmailVerification;
use App\Models\FormField;
use App\Models\Organization;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $this->emailverification = new EmailVerification();
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
        $verify = $this->emailverification->findRequestBySlug($request->token);
        if(!empty($verify)){
            $statusUpdate = $this->emailverification->updateStatus($request->token, 1);
            if($statusUpdate){
                session()->flash("success", "Congratulations ".$request->company_name."! Your account was registered successfully.");
                return redirect()->route('login');
            }else{
                session()->flash("error", "Whoops! Something went wrong. Try again.");
                return back();
            }

        }
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

    /*public function register(Request $request){
        $this->validate($request,[
            'email'=>'required|email|unique:companies,email',
            'password'=>'required|confirmed',
            'company_name'=>'required',
            'token'=>'required'
        ],[
            'email.email'=>'Enter a valid email address',
            'email.required'=>'Enter email address in the box provided',
            'company_name.required'=>'Enter company name in the box provided',
            'password.required'=>'Choose a strong password to secure your account',
            'password.confirmed'=>'Password mis-match. Check and try again.',
            'email.unique'=>"There's already an account with this email address"
        ]);
        $verify = $this->emailverification->findRequestBySlug($request->token);
        if(!empty($verify)){
            $statusUpdate = $this->emailverification->updateStatus($request->token, 1);
            if($statusUpdate){
                $this->company->basicSetup($request);
                session()->flash("success", "Congratulations ".$request->company_name."! Your account was registered successfully.");
                return redirect()->route('login');
            }else{
                session()->flash("error", "Whoops! Something went wrong. Try again.");
                return back();
            }

        }

    }*/

    public function eRegistration(Request $request){
        $this->validate($request,[
            'security_code'=>'required',
            'email'=>'email|required|unique:organizations,email',
            'validScode'=>'required'
        ],[
            'security_code.required'=>'Enter security code in the box provided.',
            'email.email'=>'Enter a valid email address',
            'email.required'=>'Enter email address in the box provided',
            'email.unique'=>"There's already an account with this email address"
        ]);

        if($request->validScode !== $request->security_code){
            session()->flash("error", "Whoops! Incorrect security code. Try again.");
            return back();
        }else{
            $subscriber = $this->emailverification->addRegistration($request);
            try{
                #Send mail

                $email = $request->email;
                $slug = $request->slug;
                //return response()->json(['email'=>$email, 'slug'=>$slug]);
                //$subscriber = EmailVerification::storeFromRemoteRegistration($email, $slug);
                try{
                    Mail::to($subscriber)->send(new VerificationMail($subscriber));
                    //return response()->json($subscriber);
                    session()->flash("success", "Success! A verification link was sent to your email account. Please click on the link
            provided to finish up the registration.");
                    return back();
                }catch (\Exception $exception){
                    session()->flash("error", "<strong>Whoops!</strong> We had troubled sending a mail to this email address"."(".$request->email.")$exception
                    ");
                    return back();
                    //return abort(404);
                    //return response()->json(['error'=>"Something went wrong. {$exception->getMessage()}"],500);
                }
                /*
                $url = "https://digitale.ojivenetworksolutions.com.ng/api/mailer/send/{$subscriber->slug}/{$subscriber->email}";
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($curl);
                curl_close($curl);

                $data = json_decode($response, true);*/
                /* if(!empty($data)){
                     session()->flash("success", "Success! A verification link was sent to your email account. Please click on the link
             provided to continue with the registration process.");
                     return back();
                 }else{
                     session()->flash("error", "<strong>Whoops!</strong> We had troubled sending a mail to this email address"."(".$request->email.")");
                     return back();
                 }*/



            }catch (\Exception $exception){
                session()->flash("error", "<strong>Whoops!</strong> We had troubled sending a mail to this email address"."(".$request->email.") {$exception->getMessage()}");
                return back();
            }

        }

    }

    public function verifyERegistration(Request $request){
        $token = $request->token;
        $verifyToken = $this->emailverification->getRegistrationBySlug($token);
        if(!empty($verifyToken)){
            //session()->flash("success", "Welcome back! Let's quickly get this out of the way.");
            return view('auth.verify', ['token'=>$verifyToken]);
        }else{
            session()->flash("error", "The token has expired or is no longer in use.");
            return view('auth.register');
        }
    }

    protected function handleCompanyRegistration($organizationName, $phoneNumber, $email){
        $org = $this->organization->registerOrganziationDuringRegistration($organizationName, $phoneNumber, $email);
        //$user = $this->user->registerUser($request, $org->id);

        event(new NewOrganizationRegistered($org->id));
        //event(new SendWelcomeEmail($user, $org) );
    }
}
