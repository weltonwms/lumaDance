<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensalidades', function (Blueprint $table) {
            $table->increments('id');
            $table->date('vencimento');
            $table->date('pago_em')->nullable();
           $table->decimal('valor', 10, 2);
            $table->boolean('quitada')->nullable();
            $table->timestamps();
            $table->integer('contrato_id')->unsigned();
            $table->foreign('contrato_id')->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensalidades');
    }
}
