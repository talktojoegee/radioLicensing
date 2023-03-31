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
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->string('slider_caption')->nullable();
            $table->string('slider_image')->nullable()->default('slider.png');
            $table->string('slider_cta_btn')->default('Learn more')->nullable();
            $table->string('slider_caption_detail')->nullable()->default('Bind brought it harvest super unpack that secular accountability group special music. Theology seeing the fruit oceans outreach, treasure that very relational father');
            $table->string('appointment_cta_btn')->default('Book Appointment')->nullable();
            $table->string('appointment_detail')->default('An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum and vitae a purus primis ipsum magna ipsum')->nullable();
            $table->string('emergency_cta_btn')->default('Give us a Call')->nullable();
            $table->string('emergency_detail')->default('An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum and vitae a purus primis ipsum magna ipsum')->nullable();
            $table->string('welcome_written_by')->nullable();
            $table->text('welcome_message')->nullable();
            $table->string('welcome_featured_img')->nullable()->default('welcome.png');
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
        Schema::dropIfExists('homepages');
    }
};
