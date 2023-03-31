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
            $table->string('title')->nullable()->after('first_name');
            $table->string('other_names')->nullable()->after('last_name');
            $table->tinyInteger('gender')->nullable()->after('other_names')->comment('1=Male,2=Female');
            $table->tinyInteger('marital_status')->nullable()->after('gender');
            $table->integer('role')->nullable()->after('marital_status');
            $table->tinyInteger('pastor')->nullable()->after('role')->comment('0=No,1=Yes');
            $table->string('occupation')->nullable()->after('pastor');
            $table->integer('branch')->nullable()->after('occupation');
            $table->integer('department')->nullable()->after('occupation');
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
