<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class InvoiceDetail extends Model
{
    use HasFactory;

    public static function setInvoiceDetail($invoiceId, Request  $request){
        foreach($request->quantity as $key=> $qty ){
            $detail = new InvoiceDetail();
            $detail->invoice_id = $invoiceId;
            $detail->item_id = $request->itemId[$key];
            $detail->quantity = $request->quantity[$key];
            $detail->amount = $request->rate[$key];
            $detail->save();
        }

    }
}
