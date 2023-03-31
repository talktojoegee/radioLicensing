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
        Schema::create('website_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('created_by');
            $table->string('page_title')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('show_in_menu')->default(1)->comment('1=Yes,0=No');
            $table->tinyInteger('password_protected')->default(0)->comment('0=No,1=Yes');
            $table->string('password')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1=Yes,0=no');
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
        Schema::dropIfExists('website_pages');
    }
};
