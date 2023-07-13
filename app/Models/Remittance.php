<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Remittance extends Model
{
    use HasFactory;


    public function storeRemittance($branch,$amount, $rate, $paid, $refCode, $category,$type, $narration, $from, $to){
        $remit = new Remittance();
        $remit->r_branch_id = $branch;
        $remit->r_transaction_date = now();
        $remit->r_month = date('m');
        $remit->r_year = date('Y');
        $remit->r_amount =  round($amount * $rate/100,2); //amount remitted
        $remit->r_actual_amount = $amount; //actual amount
        $remit->r_rate = $rate;
        $remit->r_paid = $paid;
        $remit->r_ref_code = $refCode;
        $remit->r_remitted_by = Auth::user()->id;
        $remit->r_category_id = $category;
        $remit->r_type = $type;
        $remit->r_narration = $narration;
        $remit->r_from = $from;
        $remit->r_to = $to;
        $remit->save();
        return $remit;
    }


}
