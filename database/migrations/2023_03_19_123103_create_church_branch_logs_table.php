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
        Schema::create('church_branch_logs', function (Blueprint $table) {
            $table->id('cbl_id');
            $table->bigInteger('cbl_branch_id');
            $table->bigInteger('cbl_user_id');
            $table->string('cbl_title')->nullable();
            $table->text('cbl_activity')->nullable();
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
        Schema::dropIfExists('church_branch_logs');
    }
};
