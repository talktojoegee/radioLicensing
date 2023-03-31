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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('sold_by');
            $table->unsignedBigInteger('client_id');
            $table->date('transaction_date')->nullable();
            $table->string('transaction_ref')->nullable();
            $table->integer('payment_method')->nullable();
            $table->double('sub_total')->default(0);
            $table->double('total')->default(0);
            $table->double('tax_rate')->default(0);
            $table->double('tax_value')->default(0);
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
        Schema::dropIfExists('sales');
    }
};
