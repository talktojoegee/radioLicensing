<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppSmsSetting extends Model
{
    use HasFactory;

    public function getDepartmentById($id){
        return ChurchBranch::find($id);
    }

    public function getAppSmsDefaultSettings(){
        return AppSmsSetting::first();
    }

    public function addAppSmsDefaultSetting(Request $request){
        $existing = $this->getAppSmsDefaultSettings();
        if(!empty($existing)){
            $existing->new_licence_sms = $request->new_licence_sms;
            $existing->licence_renewal_sms = $request->licence_renewal_sms_ack;
            $existing->licence_renewal_reminder_sms = $request->licence_renewal_sms;
            $existing->save();
        }else{
            $app = new AppSmsSetting();
            $app->new_licence_sms = $request->new_licence_sms;
            $app->licence_renewal_sms = $request->licence_renewal_sms_ack;
            $app->licence_renewal_reminder_sms = $request->licence_renewal_sms;
            $app->save();
        }
    }
}
