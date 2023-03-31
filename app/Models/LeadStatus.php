<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'status'
    ];


    public function getLeadStatuses(){
        return LeadStatus::all();
    }
}
