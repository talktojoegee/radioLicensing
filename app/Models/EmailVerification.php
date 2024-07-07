<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EmailVerification extends Model
{
    use HasFactory;


    public function addRegistration(Request $request){
        $current = new Carbon();
        $verify = new EmailVerification();
        $verify->email = $request->email;
        $verify->slug = sha1(time());
        $verify->valid_from = now();
        $verify->expires_at = $current->addMinutes(30); // valid for 30 minutes
        $verify->save();
        return $verify;
    }


    public static function storeFromRemoteRegistration($email, $slug){
        $current = new Carbon();
        $verify = new EmailVerification();
        $verify->email = $email;
        $verify->slug = $slug;
        $verify->valid_from = now();
        $verify->expires_at = $current->addMinutes(30); // valid for 30 minutes
        $verify->save();
        return $verify;
    }

    public function getRegistrationBySlug($slug){
        return EmailVerification::where('slug', $slug)->first();
    }

    public function findRequestBySlug($slug){
        return EmailVerification::where('slug', $slug)->first();
    }

    public function updateStatus($slug, $status){
        $update = $this->findRequestBySlug($slug);
        if(!empty($update)){
            $update->status = $status;
            $update->save();
            return true;
        }else{
            return false;
        }
    }
}
