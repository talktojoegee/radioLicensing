<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormProperty extends Model
{
    use HasFactory;


    public function getFormField(){
        return $this->belongsTo(FormField::class, 'form_field_id');
    }

    public function addProperty($formId, Request $request){
        for ($i = 0; $i<count($request->enabledChoice); $i++){
            $property = new FormProperty();
            $property->form_id = $formId;
            $property->form_field_id = $request->enabledFields[$i];
            $property->form_field_enabled = isset($request->enabledFields[$i]) ? 1 : 0 ;
            $property->form_field_required = isset($request->requiredFields[$i]) ? 1 : 0;
            $property->save();
        }
    }

    public function getFormProperties($formId){
        return FormProperty::where('form_id', $formId)->get();
    }



}
