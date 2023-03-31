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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('prescribed_by');
            $table->string('drug_name')->nullable();
            $table->text('prescription')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('medications');
    }
};
