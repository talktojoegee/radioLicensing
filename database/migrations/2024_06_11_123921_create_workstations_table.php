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
        Schema::create('workstations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->bigInteger('state_id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('capacity')->nullable();
            $table->string('long')->nullable();
            $table->string('lat')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1=active,0=inactive');
            $table->string('slug')->nullable();
            $table->string('station_class')->nullable();
            $table->string('operation_schedule')->nullable()->comment('1=day,2=night,3=both');
            $table->string('nature_of_frequency')->nullable();
            $table->string('transmitter_location')->nullable();
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
        Schema::dropIfExists('workstations');
    }
};
