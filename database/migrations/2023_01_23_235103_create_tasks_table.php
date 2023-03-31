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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->boolean('priority')->comment('high or low')->nullable();
            $table->boolean('complete')->comment('yes or no')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('created_by');
            $table->json('assigned_to')->nullable();
            $table->json('clients')->nullable();
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
        Schema::dropIfExists('tasks');
    }
};
