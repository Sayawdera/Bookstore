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
        Schema::create('product_relaises', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('title');
            $table->json('description');
            $table->json('pdf');
            $table->boolean('status_price');
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
        Schema::dropIfExists('productrelaise');
    }
};
