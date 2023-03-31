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
        Schema::table('appointment_types', function (Blueprint $table) {
            $table->tinyInteger('telehealth')->default(1)->after('group_appt');
            $table->tinyInteger('in_person')->default(1)->after('group_appt');
            $table->tinyInteger('phone_call')->default(1)->after('group_appt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment_types', function (Blueprint $table) {
            //
        });
    }
};
