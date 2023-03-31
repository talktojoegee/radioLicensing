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
        Schema::table('church_branches', function (Blueprint $table) {
            $table->string('cb_email')->nullable()->after('cb_lga');
            $table->string('cb_mobile_no')->nullable()->after('cb_lga');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('church_branches', function (Blueprint $table) {
            //
        });
    }
};
