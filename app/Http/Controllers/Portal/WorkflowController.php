<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AuthorizingPerson;
use App\Models\Currency;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkflowController extends Controller
{

    public function __construct()
    {
        $this->post = new Post();
        $this->currency = new Currency();
        $this->user = new User();
    }

    public function showWorkflowView(){
        return view('workflow.index',[
            'persons'=>$this->user->getAllBranchUsers(Auth::user()->branch),
            'currencies'=>$this->currency->getCurrencies(),
            'workflows'=>$this->post->getAllPersonalPosts(Auth::user()->id),
        ]);
    }


    public function storeWorkflowRequest(Request $request){
        $this->validate($request,[
           'subject'=>'required',
           'amount'=>'required',
           'authPerson'=>'required',
           'currency'=>'required',
           'description'=>'required',
           'type'=>'required',
        ],[
            "subject.required"=>"What's the subject of this request?",
            "amount.required"=>"What is the amount you intend to request for?",
            "currency.required"=>"Choose the currency associated to this amount",
            "authPerson.required"=>"Who is the first person that's expected to act on this request?",
            "description.required"=>"Briefly explain the purpose of this request.",
            "type.required"=>"What for of request is this?",
        ]);
        $branch = Auth::user()->branch;

        $post = Post::publishPost(Auth::user()->id, $branch, $request->subject, $request->description, $request->type,
            $request->amount, $request->currency, null, null, 1, 2);
        AuthorizingPerson::publishAuthorizingPerson($post->p_id, $request->authPerson);
        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $attachment){
                $extension = $attachment->getClientOriginalExtension();
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/cloud/';
                $attachment->move(public_path($dir), $filename);
                $file = new PostAttachment();
                $file->pa_post_id = $post->p_id;
                $file->pa_attachments = $filename;
                $file->save();
            }
        }
        session()->flash("success", "Success! Action successful.");
        return back();
    }

    public function viewWorkflowRequest($slug){
        $workflow = $this->post->getPostBySlug($slug);

        if(empty($workflow)){
            abort(404);
        }
        return view('workflow.view', ['workflow'=>$workflow]);
    }
}
