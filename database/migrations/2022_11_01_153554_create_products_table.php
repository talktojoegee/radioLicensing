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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('added_by');
            $table->integer('category_id');
            $table->string('product_name')->nullable();
            $table->double('price')->nullable()->default(0);
            $table->double('cost')->nullable()->default(0);
            $table->tinyInteger('track_inventory')->default(0)->comment('1=yes,0=No');
            $table->integer('low_inventory_notice')->default(0);
            $table->integer('stock')->default(0)->comment('amount in stock');
            $table->integer('sold')->default(0)->comment('amount sold');
            $table->string('sku')->nullable()->comment('store keeping unit');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('products');
    }
};
