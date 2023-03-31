<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\User;
use http\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $baseUrl; //external source
    public function __construct(){
        $this->user = new User();
        $this->baseUrl = 'https://app.smartsmssolutions.com/io/api/client/v1/sms/';
        //$this->services = new ServicesController();
    }

    public function createSms(Request $request){
        $apiToken = $this->user->getToken($request->token);
        $from = $request->from;
        $to = $request->to;
        $body = $request->body;
        $dnd = $request->dnd;
        $filteredPhoneNumbers = $this->services->getPhoneInfo($to);
        if(!empty($apiToken)){
            return response()->json([
                'api_token'=>$apiToken->api_token,
                'status'=>'success',
                'message'=>'Valid API token.',
                'request'=>$request->all(),
                'filteredNumbers'=>$filteredPhoneNumbers
            ]);
        }else{
            return response()->json(['status'=>'error','message'=>'Invalid API Token']);
        }
    }

    public function calendarEvents(){
        $reminder = Calendar::select('note as title', 'event_date as start', 'color as color')
            ->get();
        return response($reminder);
    }
}
