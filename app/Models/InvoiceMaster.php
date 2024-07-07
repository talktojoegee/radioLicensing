<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceMaster extends Model
{
    use HasFactory;

    public function getInvoiceDetail(){
        return $this->hasMany(InvoiceDetail::class, 'invoice_id');
    }

    public function getAuthor(){
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function getCompany(){
        return $this->belongsTo(Organization::class, 'org_id');
    }


    public function getActionedBy(){
        return $this->belongsTo(User::class, 'actioned_by');
    }


    public function createNewInvoice(Request $request, Post $post){
        $invoice = new InvoiceMaster();
        $invoice->post_id = $request->postId;
        $invoice->generated_by = Auth::user()->id;
        $invoice->org_id = $post->p_org_id;
        $invoice->total = $this->getTotal($request);
        $invoice->ref_no = substr(sha1(time()),30,40);
        $invoice->save();
        return $invoice;
    }

    public function getTotal($request){
        $total = 0;
        foreach($request->quantity as $key => $quantity){
            $total += ($quantity * $request->rate[$key]);
        }
        return $total;
    }

    public function getInvoiceByRefNo($refNo){
        return InvoiceMaster::where('ref_no',$refNo)->first();
    }

    public function getAllInvoices($status){
        return InvoiceMaster::whereIn('status', $status)->orderBy('id', 'DESC')->get();
    }

    public function getAllCompanyInoices($orgId, $status){
        return InvoiceMaster::where('org_id', $orgId)->where('status', $status)->orderBy('id', 'DESC')->get();
    }

    public function getInoviceById($id){
        return InvoiceMaster::find($id);
    }


    public function getInvoiceTransactionsByDateRange($from, $to){
        return InvoiceMaster::whereBetween('created_at', [$from, $to])
            ->orderBy('id', 'ASC')
            ->get();
    }
}
