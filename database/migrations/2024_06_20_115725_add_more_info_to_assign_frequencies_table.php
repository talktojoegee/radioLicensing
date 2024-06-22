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
        Schema::table('assign_frequencies', function (Blueprint $table) {
            $table->string('make')->nullable()->after('slug');
            $table->string('call_sign')->nullable()->after('slug');
            $table->string('form_serial_no')->nullable()->after('slug');
            $table->string('max_freq_tolerance')->nullable()->after('slug');
            $table->string('emission_bandwidth')->nullable()->after('slug');
            $table->string('max_effective_rad')->nullable()->after('slug');
            $table->string('aerial_xtics')->nullable()->after('slug');
            $table->string('license_no')->nullable()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_frequencies', function (Blueprint $table) {
            //
        });
    }
};
