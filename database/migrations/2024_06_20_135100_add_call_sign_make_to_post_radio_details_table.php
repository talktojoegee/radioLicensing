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
        Schema::table('post_radio_details', function (Blueprint $table) {
            $table->string('call_sign')->nullable();
            $table->string('make')->nullable();
            $table->string('form_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_radio_details', function (Blueprint $table) {
            //
        });
    }
};
