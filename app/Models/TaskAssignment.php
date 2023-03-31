<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignment extends Model
{
    use HasFactory;

    /*
     * This model is NOT in use
     */

    public function addAssignment($taskId, $personId){
        $assignment = new TaskAssignment();
        $assignment->task_id = $taskId;
        $assignment->assigned_to = $personId;
        $assignment->save();
    }
}
