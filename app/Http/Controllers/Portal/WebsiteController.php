<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormProperty;
use App\Models\FormSubmission;
use App\Models\Homepage;
use App\Models\Service;
use App\Models\WebsitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->formfield = new FormField();
        $this->form = new Form();
        $this->formproperty = new FormProperty();
        $this->websitepage = new WebsitePage();
        $this->homepage = new Homepage();
        $this->service = new Service();
        $this->formsubmission = new FormSubmission();
    }


    public function showWebsiteSettings(){
        return view('website.settings');
    }


    public function showWebsiteHomepage(){
        return view('website.homepage');
    }


    public function showWebsiteForms(){
        return view('website.forms',[
            'forms'=>$this->form->getAllOrgForms()
        ]);
    }


    public function showCreateWebsiteForm(){
        return view('website.create-form', [
            'formFields'=>$this->formfield->getOrgFormFields(),
            'pages'=>$this->websitepage->getAllOrgPages()
        ]);
    }

    public function showEditWebsiteForm(Request $request){
        $form = $this->form->getFormBySlug($request->slug);
        if(!empty($form)){
            return view('website.edit-form', [
                'formFields'=>$this->formfield->getOrgFormFields(),
                'form'=>$form,
                'pages'=>$this->websitepage->getAllOrgPages()
            ]);
        }
       return back();
    }
    public function viewWebsiteForm(Request $request){
        $form = $this->form->getFormBySlug($request->slug);
        if(!empty($form)){
            return view('website.view-form', [
                'form'=>$form,
                'records'=>$this->formsubmission->getAllFormSubmissionsByFormId($form->id)
            ]);
        }
       return back();
    }

    public function CreateWebsiteForm(Request $request){
        $this->validate($request,[
            'formTitle'=>'required',
            'buttonText'=>'required',
            'thankYouMessage'=>'required',
            'enabledChoice'=>'required|array',
            'enabledChoice.*'=>'required',
            'enabledFields'=>'required|array',
            'enabledFields.*'=>'required',
            'formLocation'=>'required'
        ],[
            "formTitle.required"=>"Why not give your form a unique name? One that better represents its purpose.",
            "buttonText.required"=>"How would like to title your Call To Action(CTA) button? Get in Touch? Contact us? or...",
            "thankYouMessage.required"=>"What about leaving a nice thank you message?",
            "enabledChoice.required"=>"At least one of these form fields needs to be enabled",
            "enabledFields.required"=>"At least one of these form fields needs to be enabled",
            "formLocation.required"=>"Choose where to use this form"
        ]);
        $form = $this->form->addForm($request);
        $this->formproperty->addProperty($form->id, $request);
        session()->flash("success", "You've successfully created a new lead form.");
        return back();
    }


    public function showOrgWebpages(){
        return view('website.pages.index',[
            'pages'=>$this->websitepage->getAllOrgPages()
        ]);
    }

    public function showCreateWebPageForm(){
        return view('website.pages.create');
    }

    public function CreateWebPage(Request $request){
        $this->validate($request,[
            'pageTitle'=>'required',
            'pageDescription'=>'required',
        ],[
            "pageTitle.required"=>"Why not give your page a unique name? One that better represents its purpose.",
            "pageDescription.required"=>"Enter a brief description of the page",
        ]);
       $this->websitepage->addWebsitePage($request);
        session()->flash("success", "You've successfully created a new webpage.");
        return back();
    }

    public function updateHomepageSettings(Request $request){
        $this->validate($request,[
            "sliderCaption"=>"required",
            "BtnText"=>"required",
            "captionDetails"=>"required",
            "appointmentBtnText"=>"required",
            "briefDescription"=>"required",
            "emergencyBtnText"=>"required",
            "emergencyDescription"=>"required",
            "writtenBy"=>"required",
            "homepageId"=>"required",
            "welcomeMessage"=>"required",
        ],[
            "sliderCaption.required"=>"Give your slider a descriptive caption",
            "BtnText.required"=>"A good CTA like Get in Touch or Contact us, etc will be very helpful",
            "captionDetails.required"=>"Write a brief note for this caption",
            "appointmentBtnText.required"=>"What of Book Appointment? Or Schedule Appointment?",
            "briefDescription.required"=>"Leave a brief note",
            "emergencyBtnText.required"=>"What text should be on your emergency contact button?",
            "writtenBy.required"=>"This field is required",
            "homepageId.required"=>"",
            "welcomeMessage.required"=>"Help customers or client understand what your organization is all about."
        ]);
        $this->homepage->updateHomepageSettings($request);
        session()->flash("success", "Your homepage changes were saved!");
        return back();

    }

     public function addService(Request $request){
        $this->validate($request,[
            "title"=>"required",
            "icon"=>"required",
            "description"=>"required",
        ],[
            "title.required"=>"Enter a title for this service",
            "description.required"=>"Write a brief description of what this service is all about",
            "icon.required"=>"Choose an icon to rep this service",
        ]);
        $this->service->addService($request);
        session()->flash("success", "Your service was added!");
        return back();

    }
     public function editService(Request $request){
        $this->validate($request,[
            "title"=>"required",
            "icon"=>"required",
            "description"=>"required",
            "serviceId"=>"required",
        ],[
            "title.required"=>"Enter a title for this service",
            "description.required"=>"Write a brief description of what this service is all about",
            "icon.required"=>"Choose an icon to rep this service",
        ]);
        $this->service->editService($request);
        session()->flash("success", "Your changes were saved!");
        return back();

    }




}
