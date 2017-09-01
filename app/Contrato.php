<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Helpers\MensalidadeVirtual;

class Contrato extends Model {

    protected $fillable = [
        'dia_vencimento', 'valor_vencimento',
        'valor_entrada', 'inicio_contrato', 'aluno_id', 'turma_id',
        'observacao', 'ativo'
    ];
    private $listaMensalidades; //mensalidades fisicas e virtuais
    protected $dates = array('inicio_contrato');

//    protected $events = [
//        'saved' => ContratoSaved::class,
//        
//    ];

    public function __construct(array $attributes = array())
    {

        parent::__construct($attributes);
    }

    public function aluno()
    {
        return $this->belongsTo("App\Aluno");
    }

    public function turma()
    {
        return $this->belongsTo("App\Turma");
    }
    
   

    public function mensalidades()
    {
        return $this->hasMany("App\Mensalidade");
    }

    public function getInicioContratoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setInicioContratoAttribute($value)
    {
        $this->attributes['inicio_contrato'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function getInicioContratoCarbonAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->inicio_contrato);
    }

    public function getMensalidades($st=null)
    {
        
        if (empty($this->listaMensalidades)):
            $class = new MensalidadeVirtual();
            $this->listaMensalidades = $class->getVirtuais($this);
        endif;
        return $this->listaMensalidades->filter(function($mensalidade) use ($st){
            //dd($mensalidade);
            $quitada= (boolean)$mensalidade->quitada;
            return $quitada==$st;
        });
    }

    public function getFormatedValorVencimentoAttribute()
    {
        return number_format($this->attributes['valor_vencimento'], 2, ',', '.');
    }

    public function getFormatedValorEntradaAttribute()
    {
        return number_format($this->attributes['valor_entrada'], 2, ',', '.');
    }

    public function setValorVencimentoAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        $this->attributes['valor_vencimento'] = $price;
    }

    public function setValorEntradaAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        
            $this->attributes['valor_entrada'] = (float)$price;
       
    }
    
     public function getNomeAtivoAttribute($value)
    {
        $valores=['Não','Sim'];
        return $valores[$this->ativo];
    }
    
    public function desativar($request=array())
    {
        $retorno=false;
        if($this->ativo):
            $this->ativo=0;
            $this->desativado_em=date('Y-m-d H:i:s');
            $retorno=$this->save();
        endif;
        return $retorno;
    }
    
    public function verifyAndDelete()
    {
        if($this->isExistMensalidadeQuitada()):
             \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => 'Existem Mensalidades Quitadas. Não é possível Apagar']);
             return false;
        endif;
        
        \App\Mensalidade::destroy($this->mensalidades->pluck('id')->toArray());
        return $this->delete();
    }
    
    private function isExistMensalidadeQuitada()
    {
        $x=$this->mensalidades->search(function($item){
            return $item->quitada==1;
        });
        //$x é a posição do item quitado procurado. é falso caso não encontre.
        return ($x===false)?false:true;
        
    }

}
