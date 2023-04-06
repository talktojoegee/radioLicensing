<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/book-appointment', [App\Http\Controllers\Portal\BookingController::class, 'showBookingForm'])->name('book-appointment');



Route::prefix('/settings')->group(function(){
   // Route::get('/locations', [App\Http\Controllers\Admin\SettingsController::class, 'locationSetup'])->name('location-setup');
});

Auth::routes();
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
//Route::get('/process/payment',[App\Http\Controllers\OnlinePaymentController::class, 'processOnlinePayment']);

Route::get('/home', function(){
    return redirect()->route('settings');
})->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', [App\Http\Controllers\Portal\DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/church-branches', [App\Http\Controllers\Portal\BranchController::class, 'showChurchBranches'])->name('church-branches');
    Route::get('/church-branches/{slug}', [App\Http\Controllers\Portal\BranchController::class, 'showChurchBranchDetails'])->name('church-branch-details');
});

Route::get('/attendance-medication-chart', [App\Http\Controllers\Portal\DashboardController::class, 'getAttendanceMedicationChart'])->name('attendance-medication-chart');
Route::group(['prefix'=>'/settings', 'middleware'=>'auth'], function(){
    Route::get('/', [App\Http\Controllers\Portal\SettingsController::class, 'showSettingsView'])->name('settings');
    Route::get('/cells', [App\Http\Controllers\Portal\SettingsController::class, 'showCellsSettingsView'])->name('cells-settings');
    Route::get('/branches', [App\Http\Controllers\Portal\SettingsController::class, 'showBranchesSettingsView'])->name('branches-settings');
    Route::post('/branches', [App\Http\Controllers\Portal\SettingsController::class, 'storeChurchBranch']);
    Route::post('/edit-branches', [App\Http\Controllers\Portal\SettingsController::class, 'editChurchBranch'])->name('edit-branch-settings');
    Route::get('/form', [App\Http\Controllers\Portal\SettingsController::class, 'editApptLocations'])->name('edit-appt-locations');
    Route::post('/save-account-settings', [App\Http\Controllers\Portal\SettingsController::class, 'saveAccountSettings'])->name('save-account-settings');
    Route::post('/save-notification-settings', [App\Http\Controllers\Portal\SettingsController::class, 'saveNotificationSettings'])->name('save-notification-settings');
    Route::get('/notifications', [App\Http\Controllers\Portal\SettingsController::class, 'showNotificationSettings'])->name('notification-settings');
    Route::get('/appointments', [App\Http\Controllers\Portal\SettingsController::class, 'showAppointmentSettings'])->name('appointment-settings');
    Route::get('/change-password', [App\Http\Controllers\Portal\SettingsController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\Portal\SettingsController::class, 'changePassword']);
    Route::get('/appointment-types', [App\Http\Controllers\Portal\SettingsController::class, 'showAppointmentTypeSettings'])->name('appointment-types-settings');
    Route::post('/appointment-types', [App\Http\Controllers\Portal\SettingsController::class, 'storeAppointmentType']);
    Route::post('/edit-appointment-types', [App\Http\Controllers\Portal\SettingsController::class, 'editAppointmentType'])->name('edit-appointment-types');
    Route::post('/update-appointment-settings', [App\Http\Controllers\Portal\SettingsController::class, 'updateAppointmentSettings'])->name('update-appointment-settings');
    Route::get('/appt-locations', [App\Http\Controllers\Portal\SettingsController::class, 'showApptLocations'])->name('appt-locations');
    Route::post('/appt-locations', [App\Http\Controllers\Portal\SettingsController::class, 'storeApptLocations']);
    Route::post('/edit-appt-locations', [App\Http\Controllers\Portal\SettingsController::class, 'editApptLocations'])->name('edit-appt-locations');
    Route::post('/update-organization-settings', [App\Http\Controllers\Portal\SettingsController::class, 'updateOrganizationSettings'])->name('update-organization-settings');
});

Route::post('/get-states', [App\Http\Controllers\Controller::class, 'getStates'])->name('get-states');

Route::group(['prefix'=>'/forms', 'middleware'=>'auth'], function(){
    Route::get('/', [App\Http\Controllers\Portal\FormController::class, 'showForms'])->name('forms');
    Route::get('/form/{slug}', [App\Http\Controllers\Portal\FormController::class, 'showFormDetails'])->name('form-details');
    Route::get('/add-form', [App\Http\Controllers\Portal\FormController::class, 'showAddNewForm'])->name('add-new-form');
    Route::post('/process-form', [App\Http\Controllers\Portal\FormController::class, 'processFormData'])->name('process-form');
});

Route::group(['prefix'=>'/calendar', 'middleware'=>'auth'], function(){
    Route::get('/', [App\Http\Controllers\Portal\CalendarController::class, 'showCalendar'])->name('calendar');
    Route::post('/add-calendar-event', [App\Http\Controllers\Portal\CalendarController::class, 'addCalendarEvent'])->name('add-calendar-event');
    Route::post('/add-group-calendar-event', [App\Http\Controllers\Portal\CalendarController::class, 'addGroupCalendarEvent'])->name('add-group-calendar-event');
    Route::post('/add-calendar-block-event', [App\Http\Controllers\Portal\CalendarController::class, 'addBlockCalendarEvent'])->name('add-calendar-block-event');
    Route::prefix('/appointments')->group(function(){
       Route::get('/', [App\Http\Controllers\Portal\CalendarController::class, 'showAppointments'])->name('show-appointments');
       Route::get('/{slug}', [App\Http\Controllers\Portal\CalendarController::class, 'showAppointmentDetails'])->name('show-appointment-details');
        Route::post('/change-status', [App\Http\Controllers\Portal\CalendarController::class, 'changeStatus'])->name('change-status');
       Route::post('/leave-a-note', [App\Http\Controllers\Portal\CalendarController::class, 'leaveANote'])->name('leave-a-note');
       Route::post('/filter-appointment', [App\Http\Controllers\Portal\CalendarController::class, 'filterAppointment'])->name('filter-appointment');
    });
});

Route::get('/my-notifications', [App\Http\Controllers\Portal\NotificationController::class, 'showMyNotification'])->name('my-notifications')->middleware('auth');
Route::get('/clear-all-notifications', [App\Http\Controllers\Portal\NotificationController::class, 'clearAllNotifications'])->name('clear-all-notifications')->middleware('auth');

Route::prefix('/cloud-storage')->group(function(){
    Route::get('/', [App\Http\Controllers\Portal\CloudStorageController::class, 'showCloudStorage'])->name('cloud-storage');
    Route::post('/manage-files', [App\Http\Controllers\Portal\CloudStorageController::class, 'storeFiles'] )->name('upload-files');
    Route::post('/create-folder', [App\Http\Controllers\Portal\CloudStorageController::class, 'createFolder'] )->name('create-folder');
    Route::get('/folder/{slug}', [App\Http\Controllers\Portal\CloudStorageController::class, 'openFolder'] )->name('open-folder');
    Route::get('/download/{slug}', [App\Http\Controllers\Portal\CloudStorageController::class, 'downloadAttachment'] )->name('download-attachment');
    Route::post('/delete-file', [App\Http\Controllers\Portal\CloudStorageController::class, 'deleteAttachment'])->name('delete-file');
    Route::post('/rename-file', [App\Http\Controllers\Portal\CloudStorageController::class, 'renameAttachment'])->name('rename-file');
    Route::post('/move-file', [App\Http\Controllers\Portal\CloudStorageController::class, 'moveAttachment'])->name('move-file');
    Route::post('/delete-folder', [App\Http\Controllers\Portal\CloudStorageController::class, 'deleteFolder'])->name('delete-folder');
});

Route::group(['prefix'=>'/clients', 'middleware'=>'auth'], function(){
    Route::get('/', [App\Http\Controllers\Portal\ClientController::class, 'showClients'])->name('clients');
    Route::post('/client-group', [App\Http\Controllers\Portal\ClientController::class, 'addClientGroup'])->name('client-group');
    Route::post('/edit-client-group', [App\Http\Controllers\Portal\ClientController::class, 'changeClientGroup'])->name('edit-client-group');
    Route::post('/add-client', [App\Http\Controllers\Portal\ClientController::class, 'addClient'])->name('add-client');
    Route::post('/assign-client-to', [App\Http\Controllers\Portal\ClientController::class, 'assignClientTo'])->name('assign-client-to');
    Route::post('/archive-unarchive-client', [App\Http\Controllers\Portal\ClientController::class, 'archiveUnarchiveClient'])->name('archive-unarchive-client');
    Route::post('/edit-client-profile', [App\Http\Controllers\Portal\ClientController::class, 'editClientProfile'])->name('edit-client-profile');
    Route::get('/view-profile/{slug}', [App\Http\Controllers\Portal\ClientController::class, 'viewClientProfile'])->name('view-client-profile');
});


Route::group(['prefix'=>'/tasks', 'middleware'=>'auth'], function(){
    Route::get('/', [App\Http\Controllers\Portal\TaskController::class, 'showTasks'])->name('manage-tasks');
    Route::get('/create', [App\Http\Controllers\Portal\TaskController::class, 'showCreateTaskForm'])->name('create-task');
    Route::post('/create', [App\Http\Controllers\Portal\TaskController::class, 'storeTask']);
    Route::post('/mark-as', [App\Http\Controllers\Portal\TaskController::class, 'markAs'])->name('mark-as');
});


Route::group(['prefix'=>'/sales-n-marketing', 'middleware'=>'auth'],function(){
    Route::get('/', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showAllProducts'])->name('all-products');
    Route::post('/add-product-category', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'addProductCategory'])->name('add-product-category');
    Route::post('/edit-product-category', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'editProductCategory'])->name('edit-product-category');
    Route::post('/add-product', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'addProduct'])->name('add-product');
    Route::post('/edit-product', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'editProduct'])->name('edit-product');
    Route::get('/sales', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showSales'])->name('sales');
    Route::post('/create-sales', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'createSales'])->name('create-sales');
    Route::prefix('/marketing')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'marketing'])->name('marketing-dashboard');
        Route::get('/dashboard-filter', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'filterSalesRevenueReportDashboard'])->name('marketing-dashboard-filter');
        Route::get('/leads', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showLeads'])->name('leads');
        Route::post('/leads', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'createLead']);
        Route::get('/leads/{slug}', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'leadProfile'])->name('lead-profile');
        Route::post('/leave-lead-note', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'leaveLeadNote'])->name('leave-lead-note');
        Route::post('/edit-lead-note', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'editLeadNote'])->name('edit-lead-note');
        Route::post('/delete-lead-note', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'deleteLeadNote'])->name('delete-lead-note');
        Route::get('/messaging', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showMessaging'])->name('marketing-messaging');
        Route::get('/compose-messaging', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showComposeMessaging'])->name('marketing-compose-messaging');
        Route::post('/compose-messaging', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'storeMessage']);
        Route::get('/automations', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showAutomations'])->name('marketing-automations');
        Route::get('/create-automation', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showCreateAutomation'])->name('marketing-create-automation');
        Route::post('/create-automation', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'storeAutomation']);
        Route::get('/edit-marketing-automation/{slug}', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'showEditAutomationForm'])->name('edit-marketing-automation');
        Route::post('/save-marketing-automation-changes', [App\Http\Controllers\Portal\SalesnMarketingController::class, 'editAutomation'])->name('save-marketing-automation-changes');
    });

});

Route::group(['prefix'=>'/reports', 'middleware'=>'auth'],function(){
    Route::get('/appointments', [App\Http\Controllers\Portal\ReportsController::class, 'showAppointmentReports'])->name('appointment-reports');
    Route::get('/filter-appointment-reports', [App\Http\Controllers\Portal\ReportsController::class, 'filterAppointments'])->name('filter-appointment-reports');
    Route::get('/revenues', [App\Http\Controllers\Portal\ReportsController::class, 'showRevenueReports'])->name('show-revenue-reports');
    Route::get('/revenue-statistics', [App\Http\Controllers\Portal\ReportsController::class, 'getSalesReportStatistics'])->name('revenue-statistics');
    Route::get('/revenue-statistics-range', [App\Http\Controllers\Portal\ReportsController::class, 'getSalesReportStatisticsRange'])->name('revenue-statistics-range');
    Route::get('/filter-sales-report', [App\Http\Controllers\Portal\ReportsController::class, 'filterSalesRevenueReport'])->name('filter-sales-report');
    Route::get('/practitioners', [App\Http\Controllers\Portal\ReportsController::class, 'showPractitionerReport'])->name('practitioner-report');
    Route::get('/filter-practitioner-report', [App\Http\Controllers\Portal\ReportsController::class, 'filterPractitionerReport'])->name('filter-practitioner-report');
    Route::get('/clients', [App\Http\Controllers\Portal\ReportsController::class, 'showClientReport'])->name('client-report');

});

Route::group(['prefix'=>'/medication', 'middleware'=>'auth'], function(){
    Route::post('/add-medication', [App\Http\Controllers\Portal\MedicationController::class, 'addMedication'])->name('add-medication');
    Route::post('/edit-medication', [App\Http\Controllers\Portal\MedicationController::class, 'editMedication'])->name('edit-medication');
    Route::get('/medication-details/{slug}', [App\Http\Controllers\Portal\MedicationController::class, 'showMedicationDetails'])->name('medication-details');
    Route::post('/medication-report', [App\Http\Controllers\Portal\MedicationController::class, 'submitMedicationReport'])->name('medication-report');
});

Route::group(['prefix'=>'/website', 'middleware'=>'auth'], function(){
    Route::get('/homepage', [App\Http\Controllers\Portal\WebsiteController::class, 'showWebsiteHomepage'])->name('website-homepage');
    Route::get('/settings', [App\Http\Controllers\Portal\WebsiteController::class, 'showWebsiteSettings'])->name('website-settings');
    Route::get('/forms', [App\Http\Controllers\Portal\WebsiteController::class, 'showWebsiteForms'])->name('website-forms');
    Route::get('/create-form', [App\Http\Controllers\Portal\WebsiteController::class, 'showCreateWebsiteForm'])->name('create-website-form');
    Route::post('/create-form', [App\Http\Controllers\Portal\WebsiteController::class, 'CreateWebsiteForm']);
    Route::get('/edit-form/{slug}', [App\Http\Controllers\Portal\WebsiteController::class, 'showEditWebsiteForm'])->name('edit-website-form');
    Route::get('/view-form/{slug}', [App\Http\Controllers\Portal\WebsiteController::class, 'viewWebsiteForm'])->name('view-website-form');
    Route::get('/web-pages', [App\Http\Controllers\Portal\WebsiteController::class, 'showOrgWebpages'])->name('web-pages');
    Route::get('/web-pages/create', [App\Http\Controllers\Portal\WebsiteController::class, 'showCreateWebPageForm'])->name('create-web-page');
    Route::post('/web-pages/create', [App\Http\Controllers\Portal\WebsiteController::class, 'CreateWebPage']);
    Route::post('/web-pages/homepage-settings', [App\Http\Controllers\Portal\WebsiteController::class, 'updateHomepageSettings'])->name('website-homepage-settings');
    Route::post('/web-pages/add-service', [App\Http\Controllers\Portal\WebsiteController::class, 'addService'])->name('add-website-service');
    Route::post('/web-pages/edit-service', [App\Http\Controllers\Portal\WebsiteController::class, 'editService'])->name('edit-website-service');
});

Route::group(['prefix'=>'/newsfeed', 'middleware'=>'auth'], function(){

});

Route::group(['prefix'=>'/users', 'middleware'=>'auth'], function(){
    Route::get('/practitioners', [App\Http\Controllers\UserController::class, 'showPractitioners'])->name('practitioners');
    Route::get('/pastors', [App\Http\Controllers\UserController::class, 'showAdministrators'])->name('pastors');
    Route::get('/pastors/add-new', [App\Http\Controllers\UserController::class, 'showAddNewPastorForm'])->name('add-new-pastor');
    Route::get('/{slug}', [App\Http\Controllers\UserController::class, 'showUserProfile'])->name('user-profile');
    Route::post('/add-new-user', [App\Http\Controllers\UserController::class, 'addNewUser'])->name('add-new-user');
    Route::post('/delete-user', [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');
    Route::post('/grant-permission', [App\Http\Controllers\UserController::class, 'grantPermission'])->name('grant-permission');
});


Route::group(['prefix'=>'/accounting', 'middleware'=>'auth'], function(){
    Route::get('/chart-of-accounts', [App\Http\Controllers\Portal\AccountingController::class, 'showChartOfAccounts'])->name('chart-of-accounts');
    Route::get('/add-new-account', [App\Http\Controllers\Portal\AccountingController::class, 'showCreateChartOfAccountForm'])->name('add-new-account');
    Route::post('/add-new-account', [App\Http\Controllers\Portal\AccountingController::class, 'saveAccount']);
    Route::post('/get-account-type', [App\Http\Controllers\Portal\AccountingController::class, 'getParentAccount'])->name('get-account-type');
    Route::get('/journal-voucher', [App\Http\Controllers\Portal\AccountingController::class, 'showJournalVoucherForm'])->name('journal-voucher');
});

Route::group(['prefix'=>'app', 'middleware'=>'auth'],function(){
    Route::prefix('/settings')->group(function(){
        Route::get('/organization', \App\Http\Livewire\Portal\Settings\Organization::class)->name('organization');
        Route::get('/account', \App\Http\Livewire\Portal\Settings\Account::class)->name('account-settings');
        Route::get('/module-manager', \App\Http\Livewire\Portal\Settings\ModuleManager::class)->name('module-manager');
        Route::get('/purchase-or-upgrade-plan', \App\Http\Livewire\Portal\Settings\PurchaseUpgradePlan::class)->name('purchase-or-upgrade-plan');
    });
});
//Route::get('/', [App\Http\Controllers\Controller::class, 'showOrganizationPageDetails'])->name('homepage');


Route::get('/', [App\Http\Controllers\Controller::class, 'homepage'])->name('homepage');


Route::group(['domain'=>'{account}.'.env('APP_URL')],function(){
    Route::get('/', function(){
        return "Thanks";
    })->name('org-homepage');
    Route::post('/process-frontend-form', [App\Http\Controllers\Controller::class, 'processFrontendForm'])->name('process-frontend-form');
    Route::get('/contact-us', [App\Http\Controllers\Controller::class, 'contactUs'])->name('contact-org');
});

//Route::group(['prefix'=>'super-channel', 'middleware'=>'is_admin'],function(){
    //Route::get('/', [App\Http\Controllers\AdminController::class, 'adminDashboard'])->name('admin-dashboard');
//});

/*
 * You'll need a team to run the race of life faithfully. We offer ourselves to be that family you can hold unto.
 */


/*DB::beginTransaction();
try {
    $this->pippo();
} catch (\Exception $ex) {
    DB::rollback();
}
DB::commit();

public function pippo(){
    $type=Cga_type::create(['name'=>'vvvv','description'=>'yyy']);
    throw new Exception('error');

}*/
