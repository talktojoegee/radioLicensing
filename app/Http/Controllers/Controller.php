<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormProperty;
use App\Models\FormSubmission;
use App\Models\Homepage;
use App\Models\Organization;
use App\Models\State;
use App\Models\User;
use App\Models\WebsitePage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->state = new State();
        $this->organization = new Organization();
        $this->homepage = new Homepage();
        $this->webpage = new WebsitePage();
        $this->forms = new Form();
        $this->formproperty = new FormProperty();
        $this->formfield = new FormField();
        $this->formsubmission = new FormSubmission();
        $this->user = new User();

    }

    public function getStates(Request $request){
        $this->validate($request,[
            'countryId'=>'required'
        ]);
        $states = $this->state->getStatesByCountryId($request->countryId);
        return view('partials._states',['states'=>$states]);
    }

        public function homepage(Request $request)
        {
            $subDomain = strtolower(str_replace('.'. env('APP_URL'), '', request()->getHost()));
            $org = $this->organization->getOrganizationBySubdomain($subDomain);
            if(!empty($org)){
                $homepage = $this->webpage->getHomepage($org->id);
                $forms = $this->forms->getFormsByLocationId($homepage->id);
                return view('frontend.index',[
                    'account'=>$org,
                    'home'=>$this->homepage->getHomeSettingsByOrgId($org->id),
                    'forms'=>$forms,
                    'practitioners'=>$this->user->getAllOrgUsersByIsAdmin(2),
                ]);
            }else{
                return view('welcome');
            }

        }

        public function processFrontendForm(Request $request){
            $this->validate($request,[
                'formId'=>'required'
            ]);
            $form = $this->forms->getFormById($request->formId);
            $refCode = Str::random(8);
            foreach ($request->except(['_token', 'formId']) as $key => $value) {
                //$orgId, $formId, $fieldId = null, $label, $value
                $field = $this->formfield->getFormFieldByName($key, $form->org_id);

                $this->formsubmission->addFormSubmission($form->org_id, $form->id, $field->id, $field->label, $value, $refCode);
            }
            session()->flash("success", $form->thank_you_message ?? "Thank you!");
            return back();

        }

        public function contactUs(){
            $subDomain = strtolower(str_replace('.'. env('APP_URL'), '', request()->getHost()));
            $org = $this->organization->getOrganizationBySubdomain($subDomain);
        return view('frontend.contact',[
            'account'=>$org,
        ]);
        }


}
