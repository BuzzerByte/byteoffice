<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('reference_no')->nullable();
            $table->double('received_amt',15,2)->nullable();
            $table->string('attachment')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('cc_name')->nullable();
            $table->string('cc_number')->nullable();
            $table->string('cc_type')->nullable();
            $table->string('cc_month')->nullable();
            $table->string('cc_year')->nullable();
            $table->string('cvc')->nullable();
            $table->string('payment_ref')->nullable();
            $table->integer('purchase_id')->unsigned()->nullable();
            $table->integer('order_id')->unsigned()->nullable();

            $table->timestamps();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
