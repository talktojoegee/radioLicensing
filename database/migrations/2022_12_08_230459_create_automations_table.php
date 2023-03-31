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
        Schema::create('automations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->string('title')->nullable();
            $table->integer('trigger_action')->default(1)->comment('1=member sign-up,2=visitor signup,3=new lead,4=membership start,5=promotion,6=absence,7=member frozen, 8=member cancelled, 9=manually triggered');
            $table->integer('lead_source_id')->nullable()->comment('New lead: from leads table');
            $table->integer('membership_type_id')->nullable()->comment('dependent on membership');
            $table->integer('program_id')->nullable()->comment('dependent on promotion');
            $table->integer('absence_value')->nullable()->comment('dependent on absence. 1=everyone,2=trial,3=active members');
            $table->integer('send_after')->default(0)->comment('0=instant in days');
            $table->integer('time')->default(0)->comment('in hours');
            $table->integer('type')->default(1)->comment('1=Email,2=Text');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->tinyInteger('active')->default(1)->comment('1=yes,0=no');
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
        Schema::dropIfExists('automations');
    }
};
