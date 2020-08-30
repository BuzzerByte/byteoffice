<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_awards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id')->nullable();
            $table->integer('employee_id')->unsigned();
            $table->string('award')->nullable();
            $table->string('gift')->nullable();
            $table->float('amount',15,2)->nullable();
            $table->date('month')->nullable();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_awards');
    }
}
