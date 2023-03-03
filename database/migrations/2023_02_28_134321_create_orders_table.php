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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('amount')->nullable();
            $table->string('status')->nullable();
            // $table->string('order_type')->nullable();
            // $table->enum('type', ['buy', 'sell'])->nullable();
            // $table->unsignedBigInteger('exchange_rate_toman')->nullable();
            // $table->string('wallet')->nullable();
            // $table->string('txid')->nullable();
            // $table->string('e_voucher')->nullable();
            // $table->string('activation_code')->nullable();
            // $table->foreignId('bank_account_id')->nullable()->constrained('users');
            // $table->string('bank_gateway')->nullable();
            // $table->string('bank_receive_code')->nullable();
            // $table->string('description')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
