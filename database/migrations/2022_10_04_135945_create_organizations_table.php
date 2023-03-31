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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name')->nullable();
            $table->string('organization_code')->unique()->nullable();
            $table->string('tax_id_type')->nullable();
            $table->string('tax_id_no')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('logo')->default('logo.png')->nullable();
            $table->string('favicon')->default('favicon.png')->nullable();
            $table->tinyInteger('type')->default(1)->comment("1=Main,2=sub-org/branch");
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
        Schema::dropIfExists('organizations');
    }
};
