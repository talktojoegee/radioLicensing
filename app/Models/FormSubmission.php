<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FormSubmission extends Model
{
    use HasFactory;
    public function addFormSubmission($orgId, $formId, $fieldId = null, $label, $value, $refCode){

        $submit = new FormSubmission();
        $submit->form_id = $formId;
        $submit->org_id = $orgId;
        $submit->label = $label;
        $submit->value = $value;
        $submit->field_id = $fieldId;
        $submit->ref_code = $refCode;
        $submit->save();
    }

    public function getFormSubmissionByFormId($formId){
        return FormSubmission::where('org_id', Auth::user()->org_id)->where('form_id')->first();
    }
    public function getAllFormSubmissionsByFormId($formId){
        return FormSubmission::where('org_id', Auth::user()->org_id)->where('form_id', $formId)
            ->orderBy('id', 'DESC')->groupBy('ref_code')->get();
    }
    public function getAllFormSubmissionsByRefCode($refCode){
        return FormSubmission::where('org_id', Auth::user()->org_id)->where('ref_code', $refCode)->get();
    }
}
