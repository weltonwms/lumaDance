<?php
namespace App\Helpers;

use Carbon\Carbon;
 
class MensalidadeVirtual {
 
   /**
    * Anexa às mensalidades fisicas algumas mensalidades virtuais.
    * A regra se baseia em: da data do início do contrato até o mês seguinte da
    * data atual tem que haver sempre uma mensalidade por mês. Se não houver é criada.
    * @param Contrato $contrato Model Contrato
    * @return Collection
    */
    
    public function getVirtuais($contrato)
    {
       
        if($contrato->ativo!=1):
            return $contrato->mensalidades;
        endif;
        $dtNow = Carbon::now()->addMonth();
        $dtInicio = $contrato->inicio_contrato_carbon->startOfMonth();
        $novaCollection = clone $contrato->mensalidades;
        
        while ($dtInicio->lte($dtNow)):
            $search = $contrato->mensalidades->search(function($item) use($dtInicio) {
                //$dt = Carbon::createFromFormat('Y-m-d', $item->vencimento);
                $dt=$item->vencimento_carbon;
                return ($dt->month == $dtInicio->month && $dt->year == $dtInicio->year);
            });
            $vencimento=Carbon::createFromDate($dtInicio->year, $dtInicio->month, $contrato->dia_vencimento);
            if ($search === FALSE && $vencimento->gte($contrato->inicio_contrato_carbon)):
                $obj = new \App\Mensalidade();
                $obj->id=null;
                $obj->pago_em=null;
                $obj->quitada=null;
                $obj->contrato_id = $contrato->id;
                $obj->valor = $contrato->valor_vencimento;
                $obj->vencimento = $vencimento;
                $novaCollection->push($obj);
            endif;
            $dtInicio->addMonth();
        endwhile;
       
        return $novaCollection->sortBy(function ($mensalidade, $key) {
            return $mensalidade->vencimentoCarbon;
        });
    
    }
    
    
 
}