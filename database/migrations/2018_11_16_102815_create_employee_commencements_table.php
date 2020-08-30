<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeCommencementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_commencements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('join_date')->nullable();
            $table->date('probation_end')->nullable();
            $table->date('dop')->nullable();
            $table->integer('employee_id')->unsigned();
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
        Schema::dropIfExists('employee_commencements');
    }
}
