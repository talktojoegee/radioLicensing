<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientGroup extends Model
{
    use HasFactory;
    /*
     *  $table->string('group_name')->nullable();
            $table->string('slug')->nullable();
     */
    public function addClientGroup(Request $request){
        $group = new ClientGroup();
        $group->group_name = $request->groupName;
        $group->slug = Str::slug($request->groupName);
        $group->save();
    }
    public function editClientGroup(Request $request){
        $group =  ClientGroup::find($request->groupId);
        $group->group_name = $request->groupName;
        $group->slug = Str::slug($request->groupName);
        $group->save();
    }

    public function getClientGroups(){
        return ClientGroup::orderBy('group_name', 'ASC')->get();
    }


}
