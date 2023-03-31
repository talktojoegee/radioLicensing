<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Form extends Model
{
    use HasFactory;

    protected $casts = [
        'structure' => 'array'
    ];

    public function getFormProperties(){
        return $this->hasMany(FormProperty::class, 'form_id');
    }

    public function getFormLocation(){
        return $this->belongsTo(WebsitePage::class, 'form_location');
    }
    public function getLeadSource(){
        return $this->hasMany(Lead::class, 'source_id');
    }



    public function addForm(Request $request):Form{
        $form = new Form();
        $form->org_id = Auth::user()->org_id;
        $form->created_by = Auth::user()->id;
        $form->title = $request->formTitle;
        $form->show_title = isset($request->showTitle) ? 1 : 0;
        $form->description = $request->formDescription ?? null;
        $form->button_text = $request->buttonText ?? null;
        $form->thank_you_message = $request->thankYouMessage ?? null;
        $form->form_location = $request->formLocation ?? null;
        $form->embed_code = Str::random(11);
        $form->slug = Str::slug($request->formTitle).'-'.Str::random(8);
        $form->save();
        return $form;
    }
    /* public function addForm(Request $request):Form{
        $form = new Form();
        $form->organization_id = 1;
        $form->created_by = Auth::user()->id;
        $form->form_name = $request->formName;
        $form->structure = $request->structure;
        $form->slug = Str::slug($request->formName).'-'.Str::random(8);
        $form->save();
        return $form;
    }*/

    public function editForm(Request $request):Form{
        $form =  Form::find($request->formId);
        $form->organization_id = 1;
        $form->created_by = Auth::user()->id;
        $form->form_name = $request->formName;
        $form->structure = $request->structure;
        $form->slug = Str::slug($request->formName).'-'.Str::random(8);
        $form->save();
        return $form;
    }

    public function getAllOrgForms(){
        return Form::where('org_id', Auth::user()->org_id)->get();
    }

    public function getFormBySlug($slug){
        return Form::where('slug', $slug)->first();
    }
    public function getFormById($formId){
        return Form::where('id', $formId)->first();
    }
    public function getFormsByLocationId($locationId){
        return Form::where('form_location', $locationId)->get();
    }

    public function getFormSubmission($formId){
        return FormSubmission::where('form_id', $formId)->groupBy('ref_code')->get();
    }



}
