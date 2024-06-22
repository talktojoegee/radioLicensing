<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChurchBranch extends Model
{
    use HasFactory;
    protected $primaryKey = 'cb_id';

    public function getCountry(){
        return $this->belongsTo(Country::class, 'cb_country');
    }

    public function getState(){
        return $this->belongsTo(State::class, 'cb_state');
    }

    public function getChurchAssignmentLog(){
        return $this->hasMany(ChurchBranchLog::class, 'cbl_branch_id');
    }
    public function getBranchMembers(){
        return $this->hasMany(User::class, 'branch');
    }

    public function getLeadPastor(){
        return $this->belongsTo(User::class, 'cb_head_pastor');
    }


    public function getAssistantPastor(){
        return $this->belongsTo(User::class, 'cb_assistant_pastor');
    }


    public function addBranch(Request $request){
        $branch = new ChurchBranch();
        $branch->cb_name = $request->branchName ?? null;
        $branch->cb_slug = Str::slug($request->branchName).'-'.Str::random(8) ?? null;
        $branch->cb_code = substr(sha1(time()),32,40) ?? null;
        $branch->cb_country = $request->country ?? null;
        $branch->cb_state = $request->state ?? null;
        $branch->cb_email = $request->email ?? null;
        $branch->cb_mobile_no = $request->mobileNo ?? null;
        $branch->cb_address = $request->address ?? null;
        $branch->cb_added_by = Auth::user()->id;
        $branch->cb_date_added = now();
        $branch->cb_region_id = $request->region ?? 1;
        $branch->save();
        return $branch;
    }



    public function editBranch(Request $request){
        $branch =  ChurchBranch::find($request->branchId);
        $branch->cb_name = $request->branchName ?? null;
        $branch->cb_slug = Str::slug($request->branchName).'-'.Str::random(8) ?? null;
        //$branch->cb_code = substr(sha1(time()),32,40) ?? null;
        $branch->cb_country = $request->country ?? null;
        $branch->cb_state = $request->state ?? null;
        $branch->cb_address = $request->address ?? null;
        $branch->cb_region_id = $request->region ?? 1;
        $branch->save();
        return $branch;
    }


    public function getAllChurchBranches(){
        return ChurchBranch::orderBy('cb_name', 'ASC')->get();
    }


    public function setNewSectionHead(Request $request){
        $head = ChurchBranch::find($request->department);
        if(!empty($head)){
            $head->cb_head_pastor = $request->supervisor ?? null;
            $head->save();
            //Update log
            $this->updateChurchBranchLog($head->cb_id, $head->cb_head_pastor);
        }

    }

    public function updateChurchBranchLog($branchId, $prevSupervisor){
        $log = new ChurchBranchLog();
        $log->cbl_branch_id = $branchId;
        $log->cbl_user_id = $prevSupervisor;
        $log->cbl_title = 'Section Head Changed';
        $log->cbl_activity = "A new section head was assigned.";
        $log->save();
    }



    public function getChurchBranchByBranchId($branchId){
        return ChurchBranch::find($branchId);
    }

    public function getChurchBranchByBranchIds($branchIds){
        return ChurchBranch::whereIn('cb_id', $branchIds)->get();
    }

    public function getChurchBranchBySlug($slug){
        return ChurchBranch::where('cb_slug', $slug)->first();
    }

    public function getAllStateBranchesByStateId($stateId){
        return ChurchBranch::where('cb_state', $stateId)->orderBy('cb_name', 'ASC')->get();
    }




    public function getActiveSupervisorByDepartmentId($department_id){
        return ChurchBranch::where('cb_id', $department_id)->first();
    }

}
