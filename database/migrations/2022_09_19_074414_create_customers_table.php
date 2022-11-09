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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('購入者名');
            $table->string('kana')->comment('購入者名カナ');
            $table->string('tel')->unique()->comment('購入者電話番号');
            $table->string('email')->comment('購入者メールアドレス');
            $table->string('postcode')->comment('購入者郵便番号');
            $table->string('address')->comment('購入者住所');
            $table->date('birthday')->nullable()->comment('購入者誕生日');
            $table->tinyInteger('gender')->comment('購入者性別'); // 0男性, 1女性、2その他
            $table->text('memo')->nullable()->comment('購入者備考欄');
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
        Schema::dropIfExists('customers');
    }
};
