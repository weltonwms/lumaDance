<?php

namespace App\Observers;
use App\Mensalidade;
use App\TeacherPayment;

class MensalidadeObserver {

    public function quitada(Mensalidade $mensalidade)
    {
        $pay= new TeacherPayment;
        $pay->pago=0;
        $percentual=($mensalidade->contrato->turma->teacher->percentual)/100;
        $pay->valor=$mensalidade->valor*$percentual;
        $pay->mensalidade_id=$mensalidade->id;
        $pay->teacher_id=$mensalidade->contrato->turma->teacher->id;
        $pay->save();
        
    }
    
}
