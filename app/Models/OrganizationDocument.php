<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationDocument extends Model
{
    use HasFactory;


    public function uploadFile(Request $request)
    {
        if ($request->hasFile('attachment')) {
            //foreach($request->attachments as $attachment){
                $extension = $request->attachment->getClientOriginalExtension();
                $size = $request->attachment->getSize();
                $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
                $dir = 'assets/drive/cloud/';
                $request->attachment->move(public_path($dir), $filename);
                $file = new OrganizationDocument();
                $file->filename = $filename;
                $file->type = $request->type;
                $file->status = 0;//pending
                $file->expires_at = $request->type == 1 ? null : $request->validTill;
                $file->uploaded_by = Auth::user()->id;
                $file->org_id = Auth::user()->org_id;
                $file->save();
            //}
        }

    }

    public function getCompanyDocuments($companyId){
        return OrganizationDocument::where('org_id', $companyId)->orderBy('id', 'DESC')->get();
    }
}
