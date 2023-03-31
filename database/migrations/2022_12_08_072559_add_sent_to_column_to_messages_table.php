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
        Schema::table('messages', function (Blueprint $table) {
            $table->text('sent_to')->nullable()->comment('an array of client IDs')->after('title');
            $table->string('slug')->nullable()->after('title');
            $table->tinyInteger('delivery_status')->default(0)->after('title')->comment('1=delivered,0=pending');
            $table->string('attachment')->nullable()->after('title');
            $table->integer('open_rate')->default(0)->after('title');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('column_to_messages', function (Blueprint $table) {
            //
        });
    }
};
