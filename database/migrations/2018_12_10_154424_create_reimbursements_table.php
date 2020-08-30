<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('employee_id')->unsigned();
            $table->float('amount',15,2)->nullable();
            $table->string('description')->nullable();
            $table->boolean('m_approved')->nullable();
            $table->string('m_comment')->nullable();
            $table->boolean('a_approved')->nullable();
            $table->string('a_comment')->nullable();
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
        Schema::dropIfExists('reimbursements');
    }
}
