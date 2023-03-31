<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SaleItem extends Model
{
    use HasFactory;

    public function getItem(){
        return $this->belongsTo(Product::class, 'item_id');
    }

    public function addItems(Request $request, $salesId)
    {
        for($n = 0; $n<count($request->itemName); $n++){
            $item = new SaleItem();
            $item->sales_id = $salesId;
            $item->item_id = $request->itemName[$n];
            $item->quantity = $request->quantity[$n];
            $item->unit_cost = $request->unitCost[$n];
            $item->total = $request->unitCost[$n] * $request->quantity[$n];
            $item->save();
        }

    }
}
