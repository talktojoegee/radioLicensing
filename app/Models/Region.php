<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $primaryKey = 'r_id';
    protected $fillable = ['r_id', 'r_name', 'r_slug'];


    public function getRegions(){
        return Region::all();
    }
}
