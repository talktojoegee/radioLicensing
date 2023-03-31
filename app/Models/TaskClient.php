<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskClient extends Model
{
    use HasFactory;

    /*
     * This model is NOT in use
     */

    public function addAssignment($taskId, $personId){
        $tClient = new TaskClient();
        $tClient->task_id = $taskId;
        $tClient->client_id = $personId;
        $tClient->save();
    }
}
