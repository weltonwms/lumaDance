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
    public $totalMensalidades;
    public $totalLucroVendas; //representa total lucro de vendas
    public $totalPagamentos;
    public $totalDespesas;
    public $totalCredito;
    public $totalDebito;
    public $totalLucro;
    
    public function getRelatorio()
    {
       
        $this->setMensalidades();
        $this->setVendas();
        $this->setPagamentos();
        $this->setDespesas();
        
        $this->setTotalMensalidades();
        $this->setTotalLucroVendas();
        $this->setTotalPagamentos();
        $this->setTotalDespesas();
        
        $this->setTotalCredito();
        $this->setTotalDebito();
        $this->setTotalLucro();
        //dd($this->pagamentos);
        return $this;
    }
    
    
     private function setMensalidades()
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
    
   
    
     private function setVendas()
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
    
    
    
    private function setPagamentos()
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
    
     private function setDespesas()
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
    
    private function setTotalMensalidades()
    {
        $total=0;
        foreach ($this->mensalidades as $mensalidade):
            $total+=$mensalidade->valor;
        endforeach;
        $this->totalMensalidades=$total;
    }
    
    private function setTotalLucroVendas()
    {
        $total=0;
        foreach ($this->vendas as $venda):
            $total+=$venda->lucro;
        endforeach;
        $this->totalLucroVendas=$total;
    }
    
    private function setTotalPagamentos()
    {
        $total=0;
        foreach ($this->pagamentos as $pagamento):
            $total+=$pagamento->valor;
        endforeach;
        $this->totalPagamentos=$total;
    }
    
    private function setTotalDespesas()
    {
        $total=0;
        foreach ($this->despesas as $despesa):
            $total+=$despesa->valor;
        endforeach;
        $this->totalDespesas=$total;
    }
    
    private function setTotalCredito()
    {
        $this->totalCredito=  $this->totalMensalidades+$this->totalLucroVendas;
        
    }
    
    private function setTotalDebito()
    {
        $this->totalDebito=  $this->totalPagamentos+$this->totalDespesas;
    }
    
    private function setTotalLucro()
    {
        $this->totalLucro=  $this->totalCredito-$this->totalDebito;
    }
    
    public function moneytoBr($attr)
    {
        return number_format($this->$attr, 2, ',', '.');
    }
    
}
