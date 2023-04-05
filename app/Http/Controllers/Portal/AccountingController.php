<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->coa = new Coa();
    }


    public function showChartOfAccounts(){
        return view('accounting.chart-of-accounts',[
            'accounts'=>$this->coa->getAllChartOfAccounts()
        ]);
    }


    public function showCreateChartOfAccountForm(){
        return view('accounting.create-account');
    }

    public function getParentAccount(Request $request){
        $request->validate([
            'account_type'=>'required',
            'type'=>'required'
        ]);
        $accounts = $this->coa->getChartOfAccountByAccountType($request->type, $request->account_type);
        return view('accounting.partials._accounts', ['accounts'=>$accounts]);
    }

    public function saveAccount(Request $request){
        $request->validate([
            "glcode"=>"required|unique:coas,glcode",
            "account_type"=>"required",
            "type"=>"required",
            "bank"=>"required",
            "parent_account"=>"required"
        ],[
            'glcode.required'=>'Enter GL code',
            'glcode.uniqure'=>'An account already exist with that GL code',
            'account_type.required'=>'Choose an account type',
            'type.required'=>'Indicate whether the account is detail or general account type',
            'bank.required'=>'Is this account associated to your bank?',
            'parent_account.required'=>'Choose main account',

        ]);
        try{
            $this->coa->addAccount($request);
            session()->flash("success", "Your account was created.");
            return back();
        }catch (\Exception $exception){
            session()->flash("error", "Whoops! Something went wrong.");
            return back();
        }

    }

    public function showJournalVoucherForm(){
        return view('accounting.journal-voucher',[
            'accounts'=>$this->coa->getAllDetailChartOfAccounts()
        ]);
    }
}
