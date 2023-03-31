<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;

    public static function subDomain() :Organization {
        return Organization::where('sub_domain', strtolower(str_replace('.'. env('APP_URL'), '', request()->getHost())))->firstOrFail();
    }

    public function getState(){
        return $this->belongsTo(State::class, 'state');
    }

    public function getOrgServices(){
        return $this->hasMany(Service::class, 'org_id')->orderBy('title', 'ASC');
    }

    public function registerOrganziationDuringRegistration($organizationName, $phone, $email, ){

        $active_key = "key_".substr(sha1(time()),23,40);
        $org = new Organization();
        $org->organization_name = $organizationName;
        $org->phone_no = $phone;
        $org->active_sub_key = $active_key;
        $org->slug = Str::slug($organizationName).'-'.substr(sha1(time()),33,40);
        $org->email = $email;
        $org->start_date = now();
        $org->end_date = Carbon::now()->addDays(180); //6 months FREE trial
        $org->plan_id = 1; //free
        $org->sub_domain = substr(strtolower(str_replace(" ","",$organizationName)),0,15).'.'.env('APP_URL');
        $org->save();
        return $org;
    }

    public function addOrganization($data){
        $org = new Organization();
        $org->organization_name = $data['organizationName'];
        $org->organization_code = $data['organizationCode'];
        $org->tax_id_type = $data['taxIDType'];
        $org->tax_id_no = $data['organizationTaxIDNumber'];
        $org->phone_no = $data['organizationPhoneNumber'];
        $org->address = $data['addressLine'];
        $org->city = $data['city'];
        $org->state = $data['state'];
        $org->zip_code = $data['zipCode'];
        $org->country = $data['country'];
        $org->email = $data['organizationEmail'];
        $org->save();
    }
    public function updateOrganizationSettings(Request $request){
        $org =  Organization::find($request->orgId);
        $org->organization_name = $request->organizationName ?? null;
        $org->organization_code = $request->organizationCod ?? null;
        $org->tax_id_type = $request->taxIDType ?? null;
        $org->tax_id_no = $request->organizationTaxIDNumber ?? null;
        $org->phone_no = $request->organizationPhoneNumber ?? null;
        $org->address = $request->addressLine ?? null;
        $org->city = $request->city ?? null;
        $org->state = $request->state ?? null;
        $org->zip_code = $request->zipCode ?? null;
        $org->country = $request->country ?? null;
        $org->facebook_handle = $request->facebookPage ?? null;
        $org->twitter_handle = $request->twitterAccount ?? null;
        $org->instagram_handle = $request->instagram ?? null;
        $org->youtube_handle = $request->youtubeChannel ?? null;
        $org->theme_choice = $request->themeChoice ?? 1;
        $org->ui_color = $request->uiColor ?? '#2A3041';
        $org->btn_text_color = $request->btnTextColor ?? '#FFFFFF';
        $org->publish_site = isset($request->publishSite) ? 1 : 0;
        $org->save();
    }
 public function editOrganization($organizationId, $data){
        $org =  Organization::where('id', $organizationId)->first();
        $org->organization_name = $data['organizationName'];
        $org->organization_code = $data['organizationCode'];
        $org->tax_id_type = $data['taxIDType'];
        $org->tax_id_no = $data['organizationTaxIDNumber'];
        $org->phone_no = $data['organizationPhoneNumber'];
        $org->address = $data['addressLine'];
        $org->city = $data['city'];
        $org->state = $data['state'];
        $org->zip_code = $data['zipCode'];
        $org->country = $data['country'];
        $org->email = $data['organizationEmail'];
        $org->save();
    }

    public function uploadLogo($logoHandler){
        $filename = $logoHandler->store('logos', 'public');
        $log = Organization::find(Auth::user()->org_id);
        if($log->logo != 'logos/logo.png'){
            $this->deleteFile($log->logo); //delete file first
        }
        $log->logo = $filename;
        $log->save();
    }
    public function uploadFavicon($faviconHandler){
        $filename = $faviconHandler->store('logos', 'public');
        $log = Organization::find(Auth::user()->org_id);
        if($log->favicon != 'logos/favicon.png'){
            $this->deleteFile($log->favicon); //delete file first
        }
        $log->favicon = $filename;
        $log->save();
    }

    public function deleteFile($file){
        if(\File::exists(public_path('storage/'.$file))){
            \File::delete(public_path('storage/'.$file));
        }
    }

    public function getUserOrganization($orgId){
        return Organization::find($orgId);
    }

    public function getSubDomain(Request $request){
        return strtolower(str_replace('.'. env('APP_URL'), '', request()->getHost()));
    }

    public function getOrganizationBySubdomain($website){
        return Organization::where('sub_domain', $website)->first();
    }
}


/*
 * Symfony\Component\Mailer\Exception\TransportException: Connection could not be established with host "localhost:2525": stream_socket_client(): Unable to connect to localhost:2525 (Connection refused) in /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php:154
Stack trace:
#0 [internal function]: Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream->Symfony\Component\Mailer\Transport\Smtp\Stream\{closure}(2, 'stream_socket_c...', '/Users/josephgb...', 157)
#1 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/Smtp/Stream/SocketStream.php(157): stream_socket_client('localhost:2525', 0, '', 60.0, 4, Resource id #917)
#2 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(251): Symfony\Component\Mailer\Transport\Smtp\Stream\SocketStream->initialize()
#3 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(194): Symfony\Component\Mailer\Transport\Smtp\SmtpTransport->start()
#4 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/AbstractTransport.php(68): Symfony\Component\Mailer\Transport\Smtp\SmtpTransport->doSend(Object(Symfony\Component\Mailer\SentMessage))
#5 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/mailer/Transport/Smtp/SmtpTransport.php(136): Symfony\Component\Mailer\Transport\AbstractTransport->send(Object(Symfony\Component\Mailer\SentMessage), Object(Symfony\Component\Mailer\DelayedEnvelope))
#6 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(521): Symfony\Component\Mailer\Transport\Smtp\SmtpTransport->send(Object(Symfony\Component\Mime\Email), Object(Symfony\Component\Mailer\DelayedEnvelope))
#7 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(285): Illuminate\Mail\Mailer->sendSymfonyMessage(Object(Symfony\Component\Mime\Email))
#8 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(210): Illuminate\Mail\Mailer->send(Object(Illuminate\Support\HtmlString), Array, Object(Closure))
#9 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Support/Traits/Localizable.php(19): Illuminate\Mail\Mailable->Illuminate\Mail\{closure}()
#10 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailable.php(211): Illuminate\Mail\Mailable->withLocale(NULL, Object(Closure))
#11 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(307): Illuminate\Mail\Mailable->send(Object(Illuminate\Mail\Mailer))
#12 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/Mailer.php(253): Illuminate\Mail\Mailer->sendMailable(Object(App\Mail\WelcomeNewUserMail))
#13 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Mail/PendingMail.php(124): Illuminate\Mail\Mailer->send(Object(App\Mail\WelcomeNewUserMail))
#14 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/app/Listeners/SendWelcomeEmailListener.php(33): Illuminate\Mail\PendingMail->send(Object(App\Mail\WelcomeNewUserMail))
#15 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Events/CallQueuedListener.php(107): App\Listeners\SendWelcomeEmailListener->handle(Object(App\Events\SendWelcomeEmail))
#16 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\Events\CallQueuedListener->handle(Object(Illuminate\Foundation\Application))
#17 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()
#18 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\Container\Util::unwrapIfClosure(Object(Closure))
#19 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\Container\BoundMethod::callBoundMethod(Object(Illuminate\Foundation\Application), Array, Object(Closure))
#20 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\Container\BoundMethod::call(Object(Illuminate\Foundation\Application), Array, Array, NULL)
#21 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(128): Illuminate\Container\Container->call(Array)
#22 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\Bus\Dispatcher->Illuminate\Bus\{closure}(Object(Illuminate\Events\CallQueuedListener))
#23 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\Pipeline\Pipeline->Illuminate\Pipeline\{closure}(Object(Illuminate\Events\CallQueuedListener))
#24 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Bus/Dispatcher.php(132): Illuminate\Pipeline\Pipeline->then(Object(Closure))
#25 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(119): Illuminate\Bus\Dispatcher->dispatchNow(Object(Illuminate\Events\CallQueuedListener), false)
#26 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(141): Illuminate\Queue\CallQueuedHandler->Illuminate\Queue\{closure}(Object(Illuminate\Events\CallQueuedListener))
#27 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Pipeline/Pipeline.php(116): Illuminate\Pipeline\Pipeline->Illuminate\Pipeline\{closure}(Object(Illuminate\Events\CallQueuedListener))
#28 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(121): Illuminate\Pipeline\Pipeline->then(Object(Closure))
#29 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/CallQueuedHandler.php(69): Illuminate\Queue\CallQueuedHandler->dispatchThroughMiddleware(Object(Illuminate\Queue\Jobs\DatabaseJob), Object(Illuminate\Events\CallQueuedListener))
#30 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Jobs/Job.php(98): Illuminate\Queue\CallQueuedHandler->call(Object(Illuminate\Queue\Jobs\DatabaseJob), Array)
#31 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(428): Illuminate\Queue\Jobs\Job->fire()
#32 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(378): Illuminate\Queue\Worker->process('database', Object(Illuminate\Queue\Jobs\DatabaseJob), Object(Illuminate\Queue\WorkerOptions))
#33 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(172): Illuminate\Queue\Worker->runJob(Object(Illuminate\Queue\Jobs\DatabaseJob), 'database', Object(Illuminate\Queue\WorkerOptions))
#34 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(128): Illuminate\Queue\Worker->daemon('database', 'default', Object(Illuminate\Queue\WorkerOptions))
#35 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(112): Illuminate\Queue\Console\WorkCommand->runWorker('database', 'default')
#36 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(36): Illuminate\Queue\Console\WorkCommand->handle()
#37 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/Util.php(41): Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()
#38 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(93): Illuminate\Container\Util::unwrapIfClosure(Object(Closure))
#39 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(37): Illuminate\Container\BoundMethod::callBoundMethod(Object(Illuminate\Foundation\Application), Array, Object(Closure))
#40 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Container/Container.php(653): Illuminate\Container\BoundMethod::call(Object(Illuminate\Foundation\Application), Array, Array, NULL)
#41 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Console/Command.php(171): Illuminate\Container\Container->call(Array)
#42 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/console/Command/Command.php(291): Illuminate\Console\Command->execute(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#43 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Console/Command.php(156): Symfony\Component\Console\Command\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#44 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/console/Application.php(989): Illuminate\Console\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#45 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/console/Application.php(299): Symfony\Component\Console\Application->doRunCommand(Object(Illuminate\Queue\Console\WorkCommand), Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#46 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/symfony/console/Application.php(171): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#47 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Console/Application.php(102): Symfony\Component\Console\Application->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#48 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(129): Illuminate\Console\Application->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#49 /Users/josephgbudujoseph/Documents/Dev env/Projects/PHP/healthdesk/artisan(37): Illuminate\Foundation\Console\Kernel->handle(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#50 {main}
 */
