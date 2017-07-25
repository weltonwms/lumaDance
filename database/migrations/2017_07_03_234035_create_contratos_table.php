<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dia_vencimento');
            $table->decimal('valor_vencimento',10,2);
            $table->decimal('valor_entrada',10,2)->nullable();
            $table->date('inicio_contrato');
            $table->string('observacao')->nullable();
            $table->integer('aluno_id')->unsigned();
            $table->integer('turma_id')->unsigned();
            $table->boolean('ativo');
            $table->dateTime('desativado_em')->nullable();
            $table->timestamps();
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('turma_id')->references('id')->on('turmas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
