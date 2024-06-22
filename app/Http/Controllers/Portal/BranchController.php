<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ChurchBranch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->churchbranch = new ChurchBranch();
        $this->user = new User();
    }

    public function showChurchBranches(){
        return view('settings.settings-section-heads',[
            'branches'=>$this->churchbranch->getAllChurchBranches(),
            'users'=>$this->user->getAllAdminUsers()
        ]);
    }

    public function assignSectionHead(Request $request){
        $this->validate($request, [
            'department'=>'required',
            'supervisor'=>'required'
        ],[
            'department.required'=>'Select department',
            'supervisor.required'=>'Select supervisor'
        ]);
        $this->churchbranch->setNewSectionHead($request);
        session()->flash("success", "New section head assigned successfully!");
        return back();
    }

    public function showChurchBranchDetails($slug){
        try{
            $branch = $this->churchbranch->getChurchBranchBySlug($slug);
            if(!empty($branch)){
                return view('common.church-branch-details',[
                    'branch'=>$branch,
                    'branches'=>$this->churchbranch->getAllChurchBranches(),
                    'users'=>$this->user->getAllUsers()
                ]);
            }else{
                session()->flash("error", "No record found.");
                return back();
            }
        }catch (\Exception $exception){
            session()->flash("error", "Something went wrong. Try again later.");
            return back();
        }

    }
}
