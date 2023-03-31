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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('appoint_type')->nullable();
            $table->integer('contact_type')->nullable();
            $table->integer('room_id')->nullable();
            $table->string('note')->nullable();
            $table->dateTime('event_date')->nullable();
            $table->string('color')->nullable();
            $table->integer('status')->default(1)->comment('1=Confirmed,2=Unconfirmed,3=All');
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
        Schema::dropIfExists('calendars');
    }
};
