<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WebsitePage extends Model
{
    protected $fillable = [
        'page_title',
        'link',
        'show_in_menu',
        'content',
        'status',
        'org_id',
        'created_by'
    ];
    use HasFactory;
    public function addWebsitePage(Request $request){
        $page = new WebsitePage();
        $page->page_title = $request->pageTitle;
        $page->org_id = Auth::user()->org_id;
        $page->created_by = Auth::user()->id;
        $page->link = Str::slug($request->pageTitle).'-'.Str::random(5);
        $page->show_in_menu = isset($request->showInMenu) ? 1 : 0;
        $page->password_protected = isset($request->passwordProtected) ? 1 : 0;
        $page->password = isset($request->password) ? bcrypt($request->password) : null;
        $page->featured_image = $request->hasFile('featuredImage') ? $this->uploadFeaturedImage($request->featuredImage) : null ;
        $page->content = $request->pageDescription;
        $page->save();
        return $page;
    }

    public function getAllOrgPages(){
        return WebsitePage::where('org_id', Auth::user()->org_id)->get();
    }


    public function uploadFeaturedImage($featuredImageHandler){
        return $featuredImageHandler->store('featured_images', 'public');
    }

    public function getHomepage($orgId){
        return WebsitePage::where('page_title', 'Home')->where('org_id', $orgId)->first();
    }
}
