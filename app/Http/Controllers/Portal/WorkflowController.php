<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AuthorizingPerson;
use App\Models\Currency;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Models\PostComment;
use App\Models\TransactionCategory;
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
        $this->transactioncategory = new TransactionCategory();

    }

    public function showWorkflowView(){
        return view('workflow.index',[
            'persons'=>$this->user->getAllBranchUsers(Auth::user()->branch),
            'currencies'=>$this->currency->getCurrencies(),
            'workflows'=>$this->post->getAllPersonalPosts(Auth::user()->id),
            'categories'=>$this->transactioncategory->getBranchCategoriesByType(Auth::user()->branch, 2),
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
           'category'=>'required',
        ],[
            "subject.required"=>"What's the subject of this request?",
            "amount.required"=>"What is the amount you intend to request for?",
            "currency.required"=>"Choose the currency associated to this amount",
            "authPerson.required"=>"Who is the first person that's expected to act on this request?",
            "description.required"=>"Briefly explain the purpose of this request.",
            "type.required"=>"What for of request is this?",
            "category.required"=>"Select category",
        ]);
        $branch = Auth::user()->branch;

        $post = Post::publishPost(Auth::user()->id, $branch, $request->subject, $request->description, $request->type,
            $request->amount, $request->currency, null, null, 1, 2, $request->category);
        AuthorizingPerson::publishAuthorizingPerson($post->p_id, $request->authPerson);
        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $attachment){
                $extension = $attachment->getClientOriginalExtension();
                $size = $attachment->getSize();
                $name = $attachment->getClientOriginalName();
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/cloud/';
                $attachment->move(public_path($dir), $filename);
                $file = new PostAttachment();
                $file->pa_post_id = $post->p_id;
                $file->pa_attachments = $filename;
                $file->pa_size = $size ?? 'N/A';
                $file->pa_name = $name ?? 'N/A';
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

    public function commentOnPost(Request $request){
        $this->validate($request,[
            'postId'=>'required',
            'comment'=>'required',
        ],[
            'postId.required'=>'',
            'comment.required'=>'Type your comment in the field provided'
        ]);
        $userId = Auth::user()->id;
        $comment = $request->comment;
        //return response()->json(['userId'=>$userId, 'postId'=>$request->postId, 'comment'=>$comment]);
        PostComment::leaveComment($request->postId, $userId, $comment);
        $comments = PostComment::getCommentsByPostId($request->postId);
        return view('workflow.partials._comments',[
            'comments'=>$comments
        ]);

    }
}
