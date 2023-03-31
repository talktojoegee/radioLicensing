<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingForm(){
        return view('frontend.appointment-booking');
    }
}
