<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Automation;
use App\Models\Client;
use App\Models\Lead;
use App\Models\LeadNote;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesnMarketingController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->productcategory = new ProductCategory();
        $this->product = new Product();
        $this->client = new Client();
        $this->sale = new Sale();
        $this->saleitem = new SaleItem();
        $this->lead = new Lead();
        $this->leadsource = new LeadSource();
        $this->leadstatus = new LeadStatus();
        $this->leadnote = new LeadNote();
        $this->message = new Message();
        $this->automation = new Automation();
    }

    public function showAllProducts()
    {
        return view('products.index',[
            'categories'=>$this->productcategory->getAllOrgProductCategories(),
            'products'=>$this->product->getAllOrgProducts()
        ]);
    }

    public function addProductCategory(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            "name.required"=>"What's the name for this product?"
        ]);
        $this->productcategory->addProductCategory($request);
        session()->flash("success", "Your product category saved!");
        return back();
    }
    public function editProductCategory(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'categoryId'=>'required',
        ],[
            "name.required"=>"What's the name for this product?"
        ]);
        $this->productcategory->editProductCategory($request);
        session()->flash("success", "Your changes were saved!");
        return back();
    }

    public function addProduct(Request $request){
        $this->validate($request,[
            'productName'=>'required',
            'productCategory'=>'required',
            'cost'=>'required',
            'price'=>'required',
            'photo'=>'required|image|mimes:jpeg,png,gif|max:2048',
        ],[
            "productName.required"=>"Enter product name",
            "productCategory.required"=>"Select product category",
            "cost.required"=>"What's the cost of this product?",
            "price.required"=>"How much do you intend selling this product?",
            "photo.required"=>"Upload a product photo",
            "photo.mimes"=>"Unsupported file format.",
            "photo.max"=>"File size exceeds 2MB",
        ]);
        $this->product->addProduct($request);
        session()->flash("success", "Your product was added!");
        return back();
    }
    public function editProduct(Request $request){
        $this->validate($request,[
            'productName'=>'required',
            'productCategory'=>'required',
            'cost'=>'required',
            'price'=>'required',
            'productId'=>'required',
        ],[
            "productName.required"=>"Enter product name",
            "productCategory.required"=>"Select product category",
            "cost.required"=>"What's the cost of this product?",
            "price.required"=>"How much do you intend selling this product?",
        ]);
        $this->product->editProduct($request);
        session()->flash("success", "Your changes were saved!");
        return back();
    }

    public function showSales(){
        $orgId = Auth::user()->org_id;
        return view('sales.index',[
            'products'=>$this->product->getAllOrgProducts(),
            'clients'=>$this->client->getAllOrgClients($orgId),
            'sales'=>$this->sale->getAllOrgSales(),
            'yesterdays'=>$this->sale->getOrgYesterdaysSales($orgId),
            'todays'=>$this->sale->getOrgTodaysSales($orgId),
            'thisWeek'=>$this->sale->getOrgThisWeekSales($orgId),
        ]);
    }

    public function createSales(Request $request){
        $this->validate($request,[
            "client"=>"required",
            "date"=>"required|date",
            "paymentMethod"=>"required",
            "unitCost"=>"required|array",
            "unitCost.*"=>"required",
            "quantity"=>"required|array",
            "quantity.*"=>"required",
            "itemName"=>"required|array",
            "itemName.*"=>"required",
        ],[
            "client.required"=>"Select client",
            "date.required"=>"Enter transaction date",
            "date.date"=>"Enter a valid date format",
            "paymentMethod.required"=>"Select payment method",
        ]);
        try{
            $sales = $this->sale->addSales($request);
            $this->saleitem->addItems($request, $sales->id);
            //setNewNotification($subject, $body, $route_name, $route_param, $route_type, $user_id, $orgId)
            Notification::setNewNotification('New invoice generated', 'A new invoice was raised for a client.',
                'view-client-profile', $sales->slug, 1, Auth::user()->id, Auth::user()->org_id);
            session()->flash("success", "Sales recorded!");
            return back();
        }catch (\Exception $exception){
            session()->flash("error", "Whoops! Something went wrong.");
            return back();
        }

    }

    public function marketing(){
        return view('sales.marketing',[
            'search'=>0,
            'from'=>now(),
            'to'=>now(),
            'sales'=>$this->sale->getAllOrgSales(),
        ]);
    }
    public function filterSalesRevenueReportDashboard(Request $request){
        $this->validate($request, [
            'filterType'=>'required'
        ]);
        if($request->filterType == 2){
            $this->validate($request,[
                'from'=>'required|date',
                'to'=>'required|date'
            ],[
                'from.required'=>'Choose start period',
                'from.date'=>'Enter a valid date format',
                'to.required'=>'Choose end period',
                'to.date'=>'Enter a valid date format',
            ]);
        }
        if($request->filterType == 1){
            $income = $this->sale->getAllOrgSales();
            return view('sales.marketing',[
                'income'=>$income,
                'search'=>1,
                'from'=>now(),
                'to'=>now(),
                'filterType'=>$request->filterType
            ]);
        }else if($request->filterType == 2){
            $income = $this->sale->getRangeOrgSalesReport($request->from, $request->to);
            $this->income = $this->sale->getSalesStatRange($request->from, $request->to);
            return view('sales.marketing',[
                'income'=>$income,
                'search'=>1,
                'from'=>$request->from,
                'to'=>$request->to,
                'filterType'=>$request->filterType
            ]);
        }
    }
    public function showLeads(){
        return view('sales.leads',[
            'sources'=>$this->leadsource->getLeadSources(),
            'statuses'=>$this->leadstatus->getLeadStatuses(),
            'leads'=>$this->lead->getAllOrgLeads(),
        ]);
    }

    public function createLead(Request $request){
        $this->validate($request,[
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required|email',
            'mobileNo'=>'required',
            'source'=>'required',
            'status'=>'required',
            'gender'=>'required',
        ],[
            "firstName.required"=>"Enter client first name",
            "lastName.required"=>"Enter client last name",
            "email.required"=>"Enter client email address",
            "email.email"=>"Enter a valid email address",
            "mobileNo.required"=>"Enter client mobile phone number",
            "source.required"=>"How did this person get to hear about us? Select one of the options below",
            "status.required"=>"On what stage is this person? Kindly select...",
        ]);
        $this->lead->addLead($request);
        session()->flash("success", "Your lead was added to the system!");
        return back();
    }

    public function leadProfile($slug){
        $lead = $this->lead->getLeadBySlug($slug);
        if(!empty($lead)){
            return view('sales.lead-profile',[
                'client'=>$lead
            ]);
        }else{
            return back();
        }
    }

    public function leaveLeadNote(Request $request){
        $this->validate($request,[
            'addNote'=>'required',
            'leadId'=>'required',
        ],[
            'addNote.required'=>'Type note in the box provided'
        ]);
        $this->leadnote->addNote($request);
        $log = Auth::user()->first_name.' '.Auth::user()->last_name.' left a note';
        ActivityLog::registerActivity(Auth::user()->org_id,null,null, $request->leadId, 'New Note', $log);
        session()->flash("success", "Your note was added to the system!");
        return back();
    }
    public function editLeadNote(Request $request){
        $this->validate($request,[
            'addNote'=>'required',
            'noteId'=>'required',
            'leadId'=>'required',
        ],[
            'addNote.required'=>'Type note in the box provided'
        ]);
        $this->leadnote->editNote($request);
        $log = Auth::user()->first_name.' '.Auth::user()->last_name.' made changes to note';
        ActivityLog::registerActivity(Auth::user()->org_id,null,null, $request->leadId, 'Note changes', $log);
        session()->flash("success", "Your changes were saved!");
        return back();
    }
    public function deleteLeadNote(Request $request){
        $this->validate($request,[
            'noteId'=>'required',
            'leadId'=>'required',
        ]);
        $this->leadnote->deleteNote($request->noteId);
        $log = Auth::user()->first_name.' '.Auth::user()->last_name.' deleted note';
        ActivityLog::registerActivity(Auth::user()->org_id,null,null, $request->leadId, 'Note deleted', $log);
        session()->flash("success", "Note deleted!");
        return back();
    }

    public function showMessaging(){
        return view('sales.messaging',[
            'messages'=>$this->message->getAllOrgMessages()
        ]);
    }
    public function showComposeMessaging(){
        return view('sales.compose-message',[
            'clients'=>$this->client->getAllOrgClients(Auth::user()->org_id),
        ]);
    }

    public function storeMessage(Request $request){
        $this->validate($request,[
            "subject"=>"required",
            "to"=>"required|array",
            "to.*"=>"required",
            "message"=>"required",
        ],[
            "subject.required"=>"What's the subject of your message?",
            "to.required"=>"Who do you intend sending this message to?",
            "message.required"=>"Let's have the content of your message",
        ]);
        $this->message->saveMessage($request);
        session()->flash("success", "Your message will be sent shortly.");
        return back();
    }


    public function showAutomations(){
        return view('sales.automations',[
            'automations'=>$this->automation->getOrgAutomations()
        ]);
    }

    public function showCreateAutomation(){
        return view('sales.create-automation');
    }
    public function showEditAutomationForm(Request $request){
        $automation = $this->automation->getAutomationBySlug($request->slug);
        if(!empty($automation)){
            return view('sales.edit-automation',[
                "automation"=>$automation
            ]);
        }else{
            return back();
        }

    }

    public function storeAutomation(Request $request){
        $this->validate($request,[
           "automationTitle"=>"required",
           "triggerAction"=>"required",
           "sendAfter"=>"required",
           "time"=>"required",
           "subject"=>"required",
           "message"=>"required",
        ],[
            "automationTitle.required"=>"What's the title of this automation?",
            "triggerAction.required"=>"What action triggers this automation?",
            "sendAfter.required"=>"Send after how many days?",
            "time.required"=>"Any time allocation?",
            "subject.required"=>"What's the subject of your message?",
            "message.required"=>"Let's get the content of your message",
        ]);
        $this->automation->addAutomation($request);
        session()->flash("success", "You've successfully created new automation");
        return back();
    }
    public function editAutomation(Request $request){
        $this->validate($request,[
           "automationTitle"=>"required",
           "triggerAction"=>"required",
           "sendAfter"=>"required",
           "time"=>"required",
           "subject"=>"required",
           "message"=>"required",
            "automateId"=>"required"
        ],[
            "automationTitle.required"=>"What's the title of this automation?",
            "triggerAction.required"=>"What action triggers this automation?",
            "sendAfter.required"=>"Send after how many days?",
            "time.required"=>"Any time allocation?",
            "subject.required"=>"What's the subject of your message?",
            "message.required"=>"Let's get the content of your message",
        ]);
        $this->automation->editAutomation($request);
        session()->flash("success", "Your changes were save!");
        return back();
    }
}
