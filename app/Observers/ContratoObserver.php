<?php

namespace App\Observers;

use App\Contrato;
use App\Mensalidade;
use Carbon\Carbon;

class ContratoObserver {

    public function created(Contrato $contrato)
    {
        $this->gerarMensalidadeValorEntrada($contrato);
        $this->gerarMensalidadeValorVencimento($contrato);
    }

    public function saved(Contrato $contrato)
    {
        
    }

    /**
     * Se houver valor de entrada incluir para o inicio do contrato uma 
     *mensalidade nesse valor.
     */
    private function gerarMensalidadeValorEntrada(Contrato $contrato)
    {
        
        if ($contrato->valor_entrada):
            $obj1 = new Mensalidade();
            $obj1->pago_em = null;
            $obj1->quitada = 0;
            $obj1->contrato_id = $contrato->id;
            $obj1->valor = $contrato->valor_entrada;
            $obj1->vencimento = $contrato->inicio_contrato;
            $obj1->save();
            
        endif;
    }

    /**
     * incluir outra mensalidade para o dia do vencimento com o mes e ano do inicio
     *do contrato. Se o  dia inicio contrato >= dia do vencimento. Então joga
     *essa mensalidade para o proximo mes.
     */
    private function gerarMensalidadeValorVencimento(Contrato $contrato)
    {
        
        $dtInicio = $contrato->inicio_contrato_carbon;
        $vencimento = Carbon::create($dtInicio->year, $dtInicio->month, $contrato->dia_vencimento);
        if ($dtInicio->day >= $contrato->dia_vencimento):
            $vencimento->addMonth();
        endif;
        $obj2 = new Mensalidade();
        $obj2->pago_em = null;
        $obj2->quitada = 0;
        $obj2->contrato_id = $contrato->id;
        $obj2->valor = $contrato->valor_vencimento;
        $obj2->vencimento = $vencimento;
        $obj2->save();
    }
    
    
}
