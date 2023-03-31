<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->notification = new Notification();
    }

    public function showMyNotification(){

        return view('reports.notifications');
    }
    public function clearAllNotifications(){
        $this->notification->clearAll(Auth::user()->id);
        return back();
    }
}
