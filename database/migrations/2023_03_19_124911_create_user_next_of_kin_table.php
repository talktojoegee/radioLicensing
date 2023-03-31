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
        Schema::create('user_next_of_kin', function (Blueprint $table) {
            $table->id('nk_id');
            $table->bigInteger('nk_branch');
            $table->bigInteger('nk_user_id');
            $table->string('nk_first_name')->nullable();
            $table->string('nk_last_name')->nullable();
            $table->string('nk_email')->nullable();
            $table->string('nk_mobile_no')->nullable();
            $table->integer('nk_relationship')->nullable();
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
        Schema::dropIfExists('user_next_of_kin');
    }
};
