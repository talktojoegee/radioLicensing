<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenceCategory extends Model
{
    use HasFactory;


    public function getLicenceCategories(){
        return LicenceCategory::orderBy('id', 'ASC')->get();
    }

    public function getParentCategory(){
        return $this->belongsTo(LicenseParentCategory::class, 'parent_cat');
    }

}
