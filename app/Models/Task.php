<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;


   /* public function getTaskAssignedPersons(){
        return $this->hasMany(TaskAssignment::class, 'task_id');
    }
    public function getTaskClients(){
        return $this->hasMany(TaskClient::class, 'task_id');
    }*/

    public function getCreatedBy(){
        return $this->belongsTo(User::class, 'created_by');
    }


    public function addTask(Request $request){

        $task = new Task();
        $task->title = $request->title ?? '';
        $task->description = $request->description ?? '';
        //$task->priority = $request->priority ?? '';
        $task->due_date = $request->due_date ?? '';
        $task->org_id = Auth::user()->org_id;
        $task->created_by = Auth::user()->id;
        $task->clients =  isset($request->clients) ? json_encode($this->getIntegerArray($request->clients)) :  json_encode([]);
        $task->assigned_to = json_encode($this->getIntegerArray($request->assigned_to));
        $task->save();
        return $task;
    }

    public function getOrgTasks($orgId){
        return Task::where('org_id', $orgId)->orderBy('id', 'DESC')->get();
    }
    public function getUserTasks($orgId, $userId){
        return Task::where('org_id', $orgId)->where('created_by', $userId)->orderBy('id', 'DESC')->get();
    }

    public function toggleTaskStatus($taskId){
        $task = Task::find($taskId);
        $task->complete = !$task->complete;
        $task->save();
    }

    public function getIntegerArray($arr){
        $values = [];
        for($i = 0; $i<count($arr); $i++){
            array_push($values, (int) $arr[$i]);
        }
        return $values;
    }


    public function getClients($clientIds){
        return Client::whereIn('id', $clientIds)->get();
    }

    public function getAssignedPersons($personsIds){
        return User::whereIn('id', $personsIds)->get();
    }
}
