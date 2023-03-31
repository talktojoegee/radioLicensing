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
            $table->tinyInteger('theme_choice')->default(1)->comment('1=Dark,2=Light')->after('facebook_handle');
            $table->string('ui_color')->default('#2A3041')->after('facebook_handle');
            $table->string('btn_text_color')->default('#FFFFFF')->after('facebook_handle');
            $table->tinyInteger('publish_site')->default(1)->after('facebook_handle')->comment('1=Yes,0=No');
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
