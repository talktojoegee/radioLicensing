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
        Schema::create('coas', function (Blueprint $table) {
            $table->id('coa_id');
            $table->string('account_name')->nullable();
            $table->integer('account_type')->nullable();
            $table->integer('bank')->nullable();
            $table->integer('glcode')->nullable();
            $table->integer('parent_account')->nullable();
            $table->string('type')->nullable()->comment('0=General, 1=Detail');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('coas');
    }
};
