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
        Schema::create('app_default_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('new_app_section_handler')->nullable()->comment('the first section that handles new lic. application');
            $table->integer('licence_renewal_handler')->nullable()->comment('the section(s) that handle licence renewal');
            $table->integer('engage_customer')->nullable()->comment('the section(s) that interact with customers');
            $table->integer('status')->default(1)->comment('1=active, 0=inactive');
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
        Schema::dropIfExists('app_default_settings');
    }
};
