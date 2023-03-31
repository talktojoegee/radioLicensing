<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Service extends Model
{
    use HasFactory;
    /*
     *  $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('added_by')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
     */
    public function addService(Request $request){
        $service = new Service();
        $service->title = $request->title ?? null;
        $service->added_by = Auth::user()->id ?? null;
        $service->org_id = Auth::user()->org_id ?? null;
        $service->icon = $request->icon ?? null;
        $service->description = $request->description ?? null;
        $service->save();
        return $service;
    }
    public function editService(Request $request){
        $service =  Service::find($request->serviceId);
        $service->title = $request->title ?? null;
        $service->added_by = Auth::user()->id ?? null;
        $service->org_id = Auth::user()->org_id ?? null;
        $service->icon = $request->icon ?? null;
        $service->description = $request->description ?? null;
        $service->save();
        return $service;
    }


}
