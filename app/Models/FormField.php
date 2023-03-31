<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FormField extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'label', 'required', 'type','enabled', 'org_id',
    ];


    public function getOrgFormFields(){
        return FormField::where('org_id', Auth::user()->org_id)->get();
    }


    public function getFormProperty(){
        return $this->belongsTo(FormProperty::class, 'form_field_id');
    }

    public function getFormPropertyByFieldId($id){
        return FormProperty::where('form_field_id',$id)->first();
    }

    public function getFormFieldsByIds($id){
        return FormField::whereIn('id', $id)->get();
    }

    public function getFormFieldByName($name, $orgId){
        return FormField::where('name', $name)->where('org_id', $orgId)->first();
    }
}
