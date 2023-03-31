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
        Schema::table('users', function (Blueprint $table) {
            $table->date('birth_date')->after('org_id')->nullable();
            $table->integer('birth_day')->after('org_id')->nullable();
            $table->integer('birth_month')->after('org_id')->nullable();
            $table->integer('birth_year')->after('org_id')->nullable();
            $table->string('address_1')->after('org_id')->nullable();
            $table->string('address_2')->after('org_id')->nullable();
            $table->string('city')->after('org_id')->nullable();
            $table->string('zipcode')->after('org_id')->nullable();
            $table->bigInteger('state_id')->after('org_id')->nullable();
            $table->bigInteger('country_id')->after('org_id')->nullable();
            $table->text('note')->after('org_id')->nullable();
            $table->string('slug')->after('org_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
