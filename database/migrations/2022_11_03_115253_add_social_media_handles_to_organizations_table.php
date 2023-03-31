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
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('facebook_handle')->after('type')->nullable();
            $table->string('twitter_handle')->after('type')->nullable();
            $table->string('instagram_handle')->after('type')->nullable();
            $table->string('youtube_handle')->after('type')->nullable();
            $table->string('google_analytics_tracking_id')->after('type')->nullable();
            $table->string('head_script')->after('type')->nullable();
            $table->string('body_script')->after('type')->nullable();
            $table->string('sub_domain')->after('type')->nullable();
            $table->string('plan_id')->after('type')->nullable();
            $table->string('active_sub_key')->after('type')->nullable();
            $table->date('end_date')->after('type')->nullable();
            $table->date('start_date')->after('type')->nullable();
            $table->tinyInteger('account_status')->after('type')->default(1)->comment('0=Inactive,1=Active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            //
        });
    }
};
