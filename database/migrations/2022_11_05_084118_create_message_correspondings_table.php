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
        Schema::create('message_correspondings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('sent_to');
            $table->unsignedBigInteger('sent_by');
            $table->tinyInteger('status')->comment('1=Read,0=Unread');
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
        Schema::dropIfExists('message_correspondings');
    }
};
