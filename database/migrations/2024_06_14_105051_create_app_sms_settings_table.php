<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('new_licence_sms')->nullable()->comment('sms message that will be sent for new applications');
            $table->string('licence_renewal_sms')->nullable()->comment('sms message that will be sent for new applications');
            $table->string('licence_renewal_reminder_sms')->nullable()->comment('sms message that will be sent for new applications');
            //$table->integer('sms_type')->default(1)->comment('1=new licence,2=renewal reminder,3=renewal acknowledgement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_sms_settings');
    }
};
