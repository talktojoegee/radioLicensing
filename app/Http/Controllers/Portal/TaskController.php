<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Task;
use App\Models\TaskAssignment;
use App\Models\TaskClient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
        $this->user = new User();
        $this->task = new Task();
        $this->taskassignment = new TaskAssignment();
        $this->taskclient = new TaskClient();
    }

    public function showTasks(){
        return view('task.index',[
            'tasks'=>$this->task->getOrgTasks(Auth::user()->org_id)
        ]);
    }

    public function showCreateTaskForm(){
        return view('task.create',[
            'clients'=>$this->client->getAllOrgClients(Auth::user()->org_id),
            'users'=>$this->user->getAllOrganizationUsers()
        ]);
    }

    public function storeTask(Request $request){
        $this->validate($request,[
            "title"=>"required",
            "description"=>"required",
            "due_date"=>"required|date",
            //"clients"=>"required|array",
            //"clients.*"=>"required",
            "assigned_to"=>"required|array",
            "assigned_to.*"=>"required",
        ],[
            "due_date.required"=>"Enter when this task will be due for completion",
            "due_date.date"=>"Enter a valid date format",
            "subject.required"=>"What's the subject of your message?",
            //"clients.required"=>"Which client identifies with this task?",
            "assigned_to.required"=>"Who is responsible for this task? You can choose more than one person.",
            "description.required"=>"Enter a brief description for this task",
        ]);
        //return dd($request->all());
        $task = $this->task->addTask($request);
        session()->flash("success", "Your task was created!");
        return back();
    }

    public function markAs(Request $request){
        $this->validate($request,[
            'taskId'=>'required'
        ]);
        $this->task->toggleTaskStatus($request->taskId);
        return response()->json(['message'=>'Task status updated successfully!'], 200);
    }


}
