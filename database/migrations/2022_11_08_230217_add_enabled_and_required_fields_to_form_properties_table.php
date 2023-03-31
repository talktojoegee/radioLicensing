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
        Schema::table('form_properties', function (Blueprint $table) {
            $table->tinyInteger('form_field_enabled')->after('form_field_id')->default(0)->comment('1=Enabled,0=Disabled');
            $table->tinyInteger('form_field_required')->after('form_field_id')->default(0)->comment('1=yes,0=not');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_properties', function (Blueprint $table) {
            //
        });
    }
};
