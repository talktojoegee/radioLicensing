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
        Schema::create('church_branches', function (Blueprint $table) {
            $table->id('cb_id');
            $table->string('cb_name');
            $table->string('cb_code')->nullable();
            $table->tinyInteger('cb_status')->default(1)->comment('0=Inactive,1=Active');
            $table->integer('cb_country')->nullable();
            $table->integer('cb_state')->nullable();
            $table->integer('cb_lga')->nullable();
            $table->string('cb_address')->nullable();
            $table->integer('cb_head_pastor')->nullable();
            $table->integer('cb_assistant_pastor')->nullable();
            $table->integer('cb_added_by')->nullable()->comment('user ID');
            $table->dateTime('cb_date_added')->nullable();
            $table->string('cb_slug')->nullable();
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
        Schema::dropIfExists('church_branches');
    }
};
