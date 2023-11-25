<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('transactions')) {
            Schema::create('transactions', function (Blueprint $table) {
                $table->id();
                $table->string('email');
                $table->string('payment_amount');
                $table->string('transaction_id');

                $table->bigInteger('subscription_id')->unsigned()->nullable();
                $table->foreign('subscription_id')->references('id')->on('transactions')->onDelete('set null');

                $table->bigInteger('user_id')->unsigned()->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

                $table->bigInteger('paymentgateway_id')->unsigned()->nullable();
                $table->foreign('paymentgateway_id')->references('id')->on('paymentgateways')->onDelete('set null');

                $table->enum('status', ['Unpaid', 'Paid'])->default('Paid');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
