<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->organization = new Organization();
    }



    public function showOrganizationPageDetails(Request $request){
        return dd('$request->account');
        $subDomain = $this->organization->getSubDomain($request);
        $organization = $this->organization->getOrganizationBySubdomain($subDomain);
        return dd($organization);
    }
}
