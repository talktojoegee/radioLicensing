<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedFile extends Model
{
    use HasFactory;
    public function addSharedFiles($sharedBy, $clientId, $fileId){
        $shared = new SharedFile();
        $shared->shared_by = $sharedBy;
        $shared->client_id = $clientId;
        $shared->file_id = $fileId;
        $shared->save();
    }
}
