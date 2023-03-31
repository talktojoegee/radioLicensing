<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->form = new Form();
    }

    public function showForms(){
        return view('forms.index',[
            'forms'=>$this->form->getForms()
        ]);
    }
    public function showAddNewForm(){
        return view('forms.add-new-form');
    }

    public function processFormData(Request $request){
        $this->validate($request,[
            'formName'=>'required',
            'structure'=>'required'
        ],[
            "formName.required"=>"Enter form name",
            "structure.required"=>"Take a moment to create your form"
        ]);
        switch ($request->type){
            case 'create':
                $this->form->addForm($request);
                break;
            case 'update':
                $this->form->editForm($request);
                break;
        }
        return response()->json(['message'=>"Form created!"], 201);
    }

    public function showFormDetails($slug){
        $form = $this->form->getFormBySlug($slug);
        if(!empty($form)){
            return view("forms.view",[
                'form'=>$form
            ]);
        }else{
            return back();
        }

    }
}
