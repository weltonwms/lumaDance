<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('teacher_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor', 10, 2);
            $table->date('pago_em')->nullable();
            $table->boolean('pago')->nullable();
            $table->timestamps();
            $table->integer('teacher_id')->unsigned();
            $table->integer('mensalidade_id')->unsigned()->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('mensalidade_id')->references('id')->on('mensalidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_payments');
    }
}
