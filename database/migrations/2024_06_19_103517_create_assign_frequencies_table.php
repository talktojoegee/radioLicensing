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
        Schema::create('assign_frequencies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id'); //app ID
            $table->bigInteger('radio_detail_id');
            $table->bigInteger('org_id');
            $table->bigInteger('assigned_by')->nullable();

            $table->string('frequency')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=active,2=expired,3=renewed');
            $table->date('start_date')->nullable();
            $table->date('expires_at')->nullable();
            $table->integer('duration_id')->nullable();

            $table->integer('station_id')->nullable();
            $table->integer('mode')->nullable()->comment('1=simplex,2=duplex');
            $table->integer('category')->nullable();
            $table->integer('band')->nullable()->comment('1=MF/HF,2=VHF,3=UHF,4=SHF');
            $table->integer('type')->nullable()->comment('1=handheld,2=base station,3=repeaters,4=vehicular');
            $table->string('batch_code')->nullable();
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
        Schema::dropIfExists('assign_frequencies');
    }
};
