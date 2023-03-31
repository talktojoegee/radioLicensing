<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    public function getItems(){
        return $this->hasMany(SaleItem::class, 'sales_id');
    }

    public function getClient(){
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function addSales(Request $request){
        $itemTotal = $this->getItemTotal($request);
        $taxVal = isset($request->taxRate) ? ($request->taxRate/100) * $itemTotal : 0;
        $sales = new Sale();
        $sales->org_id = Auth::user()->org_id;
        $sales->sold_by = Auth::user()->id;
        $sales->client_id = $request->client;
        $sales->transaction_date = $request->date;
        $sales->transaction_ref = $request->transactionReference ?? null;
        $sales->payment_method = $request->paymentMethod;
        $sales->tax_rate = $request->taxRate ?? 0;
        $sales->tax_value = isset($request->taxRate) ? $taxVal : 0;
        $sales->sub_total = isset($request->taxRate) ? $itemTotal - $taxVal : $itemTotal;
        $sales->total = isset($request->taxRate) ? $itemTotal + $taxVal : $itemTotal;
        $sales->save();
        return $sales;
    }

    public function getItemTotal(Request $request)
    {
        $sum = 0;
        for ($i = 0; $i < count($request->itemName); $i++) {
            $sum += $request->quantity[$i] * $request->unitCost[$i];
        }
        return $sum;
    }

    public function getAllOrgSales(){
        return Sale::where('org_id', Auth::user()->org_id)->orderBy('id', 'DESC')->get();
    }
    public function getAllOrgSalesByPractitioner($practitionerId){
        return Sale::where('org_id', Auth::user()->org_id)->where('sold_by', $practitionerId)->orderBy('id', 'DESC')->get();
    }

  public function getAllOrgSalesByPractitionerDateRange($practitionerId, $from, $to){
        return Sale::where('org_id', Auth::user()->org_id)->where('sold_by', $practitionerId)->whereBetween('transaction_date', [$from, $to])->orderBy('id', 'DESC')->get();
    }

    public function getRangeOrgSalesReport($from, $to){
        return Sale::where('org_id', Auth::user()->org_id)->whereBetween('transaction_date', [$from, $to])->get();
    }

    public function getOrgYesterdaysSales($orgId){
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        return Sale::where('org_id', $orgId)->whereDate('transaction_date', $yesterday)->orderBy('id', 'DESC')->get();
    }

    public function getOrgTodaysSales($orgId){
        return Sale::where('org_id', $orgId)->whereDate('transaction_date', now())->orderBy('id', 'DESC')->get();
    }
    public function getOrgMonthsSales($orgId){
        return Sale::where('org_id', $orgId)->whereMonth('transaction_date', date('m'))->whereYear('transaction_date', date('Y'))->orderBy('id', 'DESC')->get();
    }
    public function getOrgThisWeekSales($orgId){
        return Sale::where('org_id', $orgId)
            ->whereBetween('transaction_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek() ])->orderBy('id', 'DESC')->get();
    }

    public function getThisYearSalesStat(){
        return Sale::select(
            DB::raw("DATE_FORMAT(transaction_date, '%m-%Y') monthYear"),
            DB::raw("YEAR(transaction_date) year, MONTH(transaction_date) month"),
            DB::raw("SUM(total) amount"),
            'transaction_date',
        )->whereYear('transaction_date', date('Y'))
            ->where('org_id', Auth::user()->org_id)
            ->orderBy('month', 'ASC')
            ->groupby('year','month')
            ->get();
    }
    public function getSalesStatRange($from, $to){
        return Sale::select(
            DB::raw("DATE_FORMAT(transaction_date, '%m-%Y') monthYear"),
            DB::raw("YEAR(transaction_date) year, MONTH(transaction_date) month"),
            DB::raw("SUM(total) amount"),
            'transaction_date',
        )->whereBetween('transaction_date', [$from, $to])
            ->where('org_id', Auth::user()->org_id)
            ->orderBy('month', 'ASC')
            ->groupby('year','month')
            ->get();
    }
}
