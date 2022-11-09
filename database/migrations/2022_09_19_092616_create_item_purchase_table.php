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
        Schema::create('item_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onUpdate('cascade')->comment('商品ID');
            $table->foreignId('purchase_id')->constrained()->onUpdate('cascade')->comment('購入ID');
            $table->integer('quantity')->comment('購入数');
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
        Schema::dropIfExists('item_purchase');
    }
};
