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
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->tinyInteger('new_comment_posted')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('new_journal_entry')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('package_purchased')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('intake_flow_started')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('intake_flow_completed')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('program_module_completed')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('chat_message')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('group_chat_message')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('appointment_reminder')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('client_books_appointment')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('client_cancel_appointment')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('shared_document')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('shared_folder')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('task_assigned')->default(1)->comment('0=No,1=Yes');
            $table->tinyInteger('task_status_updated')->default(1)->comment('0=No,1=Yes');
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
        Schema::dropIfExists('user_notification_settings');
    }
};
