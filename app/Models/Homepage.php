<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Homepage extends Model
{
    use HasFactory;
    protected $fillable = [
        'org_id',
        'slider_caption',
        'slider_image',
        'slider_cta_btn',
        'slider_caption_detail',
        'appointment_cta_btn',
        'appointment_detail',
        'emergency_cta_btn',
        'emergency_detail',
        'welcome_written_by',
        'welcome_message',
    ];

    public function updateHomepageSettings(Request $request){
        $home = Homepage::find($request->homepageId);
        $home->slider_caption = $request->sliderCaption ?? '';
        $home->slider_image = $request->hasFile('sliderImage') ? $this->uploadHomepageImage($request->sliderImage)  : 'slider.png';
        $home->slider_cta_btn = $request->BtnText ?? '';
        $home->slider_caption_detail = $request->captionDetails ?? '';
        $home->appointment_cta_btn = $request->appointmentBtnText ?? '';
        $home->appointment_detail = $request->briefDescription ?? '';
        $home->emergency_cta_btn = $request->emergencyBtnText ?? '';
        $home->emergency_detail = $request->emergencyDescription ?? '';
        $home->welcome_written_by = $request->writtenBy ?? '';
        $home->welcome_message = $request->welcomeMessage ?? '';
        $home->welcome_featured_img = $request->hasFile('featuredImage') ? $this->uploadHomepageImage($request->featuredImage)  : null;
        $home->save();
    }

    public function uploadHomepageImage($imageHandler){
        return $imageHandler->store('homepage', 'public');
    }

    public function getHomeSettingsByOrgId($orgId){
        return Homepage::where('org_id', $orgId)->first();
    }


}
