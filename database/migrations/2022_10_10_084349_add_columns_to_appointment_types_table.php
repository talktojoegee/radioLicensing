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
            $table->tinyInteger('group_appt')->default(1)->comment('Group Appointments')->after('name');
            $table->tinyInteger('client_can_book')->default(1)->comment('Client can book this appointment type')->after('name');
            $table->tinyInteger('all_client_book')->default(1)->comment('All client can book 1=Yes | 2=Specific')->after('name');
            $table->integer('length')->default(5)->after('name');
            $table->string('contact_types')->nullable()->after('name');
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
