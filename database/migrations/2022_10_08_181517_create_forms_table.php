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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('org_id')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('show_title')->default(0)->comment('0=No,1=Yes');
            $table->text('description')->nullable();
            $table->string('button_text')->default('Get in Touch');
            $table->text('thank_you_message')->nullable();
            $table->string('embed_code')->nullable();
            $table->tinyInteger('enable_captcha')->default(0)->comment('0=No,1=Yes');
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('forms');
    }
};
