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
        Schema::create('organization_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('org_id');
            $table->tinyInteger('type')->default(1)->comment('1=CAC,2=Tax');
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=verified,2=expired');
            $table->date('expires_at')->nullable();
            $table->string('filename')->nullable();
            $table->bigInteger('uploaded_by')->nullable();
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
        Schema::dropIfExists('organization_documents');
    }
};
