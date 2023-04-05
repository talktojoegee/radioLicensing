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
        Schema::create('journal_vouchers', function (Blueprint $table) {
            $table->id('jv_id');
            $table->bigInteger('jv_glcode')->nullable();
            $table->bigInteger('jv_entry_by')->nullable();
            $table->string('jv_narration')->nullable();
            $table->double('jv_dr_amount')->nullable()->default(0);
            $table->double('jv_cr_amount')->nullable()->default(0);
            $table->string('jv_ref_no')->nullable();
            $table->dateTime('jv_date')->nullable();
            $table->dateTime('jv_entry_date')->nullable();
            $table->tinyInteger('jv_status')->nullable()->default(0)->comment('0=Pending,1=posted,2=trashed');
            $table->dateTime('jv_action_date')->nullable();
            $table->string('jv_slug')->nullable();
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
        Schema::dropIfExists('journal_vouchers');
    }
};
