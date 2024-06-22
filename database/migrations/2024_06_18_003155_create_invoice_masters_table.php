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
        Schema::create('invoice_masters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id');
            $table->bigInteger('generated_by');
            $table->bigInteger('org_id');
            $table->string('rrr')->nullable();
            $table->double('total')->default(0);
            $table->double('amount_paid')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=paid,2=verified,3=declined');
            $table->string('ref_no')->nullable();
            $table->bigInteger('actioned_by')->nullable();
            $table->date('date_actioned')->nullable();
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
        Schema::dropIfExists('invoice_masters');
    }
};
