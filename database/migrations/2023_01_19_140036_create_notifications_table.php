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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('user_id');
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->string('route_name')->nullable();
            $table->string('route_param')->nullable();
            $table->tinyInteger('route_type')->comment('0=No param,1=yes')->default(0);
            $table->tinyInteger('is_read')->comment('0=No,1=yes')->default(0);
            $table->dateTime('read_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
};
