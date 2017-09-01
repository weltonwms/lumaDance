<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Util;
use App\Mensalidade;
use App\Venda;
use App\TeacherPayment;
use App\Despesa;

class RelatorioGeral extends Model
{
    public $mensalidades=[];
    public $vendas=[];
    public $pagamentos=[];
    public $despesas=[];
    
    public function getRelatorio()
    {
       
        $this->mensalidades();
        $this->vendas();
        $this->pagamentos();
        $this->despesas();
        //dd($this->pagamentos);
        return $this;
    }
    
    
     private function mensalidades()
    {
        $this->mensalidades=  Mensalidade::query();
        $this->mensalidades->where('quitada',1);
         if (request('periodo_inicial')):
            $dt = Util::dataToMysql(request('periodo_inicial'));
            $this->mensalidades->where('pago_em', '>=', $dt);
        endif;

        if (request('periodo_final')):
            $dt = Util::dataToMysql(request('periodo_final'));
            $this->mensalidades->where('pago_em', '<=', $dt);
        endif;
        $this->mensalidades=$this->mensalidades->orderBy('pago_em', 'desc')->get();
    }
    
   
    
     private function vendas()
    {
        $this->vendas=Venda::query();
         if (request('periodo_inicial')):
            $dt = Util::dataToMysql(request('periodo_inicial'));
            $this->vendas->where('data', '>=', $dt);
        endif;

        if (request('periodo_final')):
            $dt = Util::dataToMysql(request('periodo_final'));
            $this->vendas->where('data', '<=', $dt);
        endif;
         $this->vendas=$this->vendas->orderBy('data', 'desc')->get();
    }
    
    
    
    private function pagamentos()
    {
        $this->pagamentos= TeacherPayment::query();
        $this->pagamentos->where('pago',1);
         if (request('periodo_inicial')):
            $dt = Util::dataToMysql(request('periodo_inicial'));
            $this->pagamentos->where('pago_em', '>=', $dt);
        endif;

        if (request('periodo_final')):
            $dt = Util::dataToMysql(request('periodo_final'));
            $this->pagamentos->where('pago_em', '<=', $dt);
        endif;
         $this->pagamentos=$this->pagamentos->orderBy('pago_em', 'desc')->get();
    }
    
     private function despesas()
    {
        $this->despesas=Despesa::query();
         if (request('periodo_inicial')):
            $dt = Util::dataToMysql(request('periodo_inicial'));
            $this->despesas->where('data', '>=', $dt);
        endif;

        if (request('periodo_final')):
            $dt = Util::dataToMysql(request('periodo_final'));
            $this->despesas->where('data', '<=', $dt);
        endif;
         $this->despesas=$this->despesas->orderBy('data', 'desc')->get();
    }
    
}
