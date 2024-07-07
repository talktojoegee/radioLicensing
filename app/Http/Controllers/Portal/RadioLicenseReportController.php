<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\AssignFrequency;
use App\Models\InvoiceMaster;
use App\Models\Organization;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RadioLicenseReportController extends Controller
{
    public function __construct()
    {
        $this->invoicemaster = new InvoiceMaster();
        $this->post = new Post();
        $this->organization = new Organization();
        $this->assignfrequency = new AssignFrequency();

    }



    public function showReportByType($slug){


        $from = date('Y-m-d', strtotime("-30 days"));
        $to = date('Y-m-d');

        switch ($slug){
            case 'application':
                return view('reports.cashbook.index',[
                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,
                    //'accounts'=>$accounts,

                ]);
            case 'license':
                return view('reports.income.index',[
                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,
                    //'accounts'=>$accounts,

                ]);
            case 'inflow':

                return view('company.reports.inflow.index',[
                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,

                ]);
            case 'payment':
                return view('reports.expense.index',[

                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,
                    //'accounts'=>$accounts,

                ]);
            case 'certificate':
                return view('reports.expense.index',[

                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,
                    //'accounts'=>$accounts,

                ]);
            case 'company':
                return view('reports.expense.index',[

                    'search'=>0,
                    'from'=>$from,
                    'to'=>$to,
                    //'accounts'=>$accounts,

                ]);
            default:
                abort(404);
        }

    }

    public function generateSystemReport(Request $request){
        $this->validate($request,[
            'from'=>'required|date',
            'to'=>'required|date',
            'type'=>'required',
        ],[
            'from.required'=>'Choose start date',
            'from.date'=>'Enter a valid date',
            'to.date'=>'Enter a valid date',
            'to.required'=>'Choose end date',
            'type.required'=>'Something is missing. Contact admin',
        ]);
        $from = $request->from;
        $to = $request->to;
        switch ($request->type){
            case 'inflow':
                return view('company.reports.inflow.index',[
                    'records'=>$this->invoicemaster->getInvoiceTransactionsByDateRange($from, $to),
                    'search'=>1,
                    'from'=>$from,
                    'to'=>$to,

                ]);
            case 'income':
                return view('reports.income.index',[

                    'search'=>1,
                    'from'=>$from,
                    'to'=>$to,


                ]);
            case 'expense':
                return view('reports.expense.index',[
                    'search'=>1,
                    'from'=>$from,
                    'to'=>$to,


                ]);
            default:
                abort(404);
        }

    }
}
