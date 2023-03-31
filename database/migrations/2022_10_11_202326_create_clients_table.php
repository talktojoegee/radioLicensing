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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('added_by');
            $table->unsignedBigInteger('org_id');
            $table->integer('client_group_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_no')->nullable();

            $table->string('avatar')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('timezone')->nullable();
            $table->text('quick_note')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Active,2=Archived');
            $table->string('gender')->nullable();
            $table->string('pronoun')->nullable();
            $table->string('address')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
