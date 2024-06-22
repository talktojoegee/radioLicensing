<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostRadioDetail extends Model
{
    use HasFactory;


    public function getWorkstation(){
        return $this->belongsTo(Workstation::class, 'workstation_id');
    }


    public function getLicenseCategory(){
        return $this->belongsTo(LicenceCategory::class, 'cat_id');
    }


    public function getInvoiceDetail(){
        return $this->belongsTo(InvoiceDetail::class, 'id');
    }


    public function setRadioLicenseApplicationDetails(Request  $request, $appId){
        for($i = 0; $i < count($request->workstation); $i++){
            $details = new PostRadioDetail();
            $details->workstation_id = $request->workstation[$i];
            $details->cat_id = $request->licence_category[$i];
            $details->type_of_device = $request->type_of_device[$i];
            $details->no_of_device = $request->no_of_devices[$i];
            $details->post_id = $appId;
            $details->operation_mode = $request->operation_mode[$i] ?? '';
            $details->frequency_band = $request->frequency_band[$i] ?? '';
            $details->call_sign = $request->callSign[$i] ?? '';
            $details->make = $request->make[$i] ?? '';
            $details->others = $request->others[$i] ?? '';
            //$details->form_no = $request->other_category[$i] ?? '';
            $details->save();
        }
    }

    public function getRadioDetailById($id){
        return PostRadioDetail::find($id);
    }
}
