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
        Schema::create('post_radio_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->comment('radio license application ID');
            $table->bigInteger('cat_id')->nullable()->comment('	license category ID');
            $table->bigInteger('workstation_id')->nullable();
            $table->tinyInteger('type_of_device')->nullable()->comment('1=handheld,2=base,3=repeaters,4=vehicular');
            $table->integer('no_of_device')->nullable();
            $table->bigInteger('sub_cat_id')->nullable()->comment('licence sub-category ID');
            $table->tinyInteger('operation_mode')->nullable()->comment('1=Simplex,2=Duplex');
            $table->tinyInteger('frequency_band')->nullable()->comment('1=MF/HF,2=VHF,3=UHF,4=SHF');
            $table->string('others')->nullable();
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
        Schema::dropIfExists('post_radio_details');
    }
};
