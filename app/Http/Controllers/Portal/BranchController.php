<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\ChurchBranch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->churchbranch = new ChurchBranch();
    }

    public function showChurchBranches(){
        return view('common.church-branches',[
            'branches'=>$this->churchbranch->getAllChurchBranches()
        ]);
    }
    public function showChurchBranchDetails($slug){
        try{
            $branch = $this->churchbranch->getChurchBranchBySlug($slug);
            if(!empty($branch)){
                return view('common.church-branch-details',[
                    'branch'=>$branch
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
