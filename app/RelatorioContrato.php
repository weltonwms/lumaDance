<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Util;
use App\Contrato;

class RelatorioContrato extends Model
{
    private $query;
    public $items=[];
    

    public function __construct(array $attributes = array())
    {
        $this->query = Contrato::query();
        parent::__construct($attributes);
    }

    public function getRelatorio()
    {
        if (request('aluno_id')):
            $this->query->whereIn('aluno_id', request('aluno_id'));
        endif;
        
         if (request('teacher_id')):
            $this->query->whereHas('turma', function($query){
                $query->whereIn('teacher_id', request('teacher_id'));
            });
        
        endif;
        
        if (request('turma_id')):
            $this->query->whereIn('turma_id', request('turma_id'));
        endif;

        if (request('inicio_contrato')):
            $dt = Util::dataToMysql(request('inicio_contrato'));
            $this->query->where('inicio_contrato', '>=', $dt);
        endif;

        if (request('ativo')):
            $ativo=request('ativo')=='1'?1:0;
            $this->query->where('ativo', $ativo);
        endif;
        $this->items = $this->query->orderBy('id', 'desc')->get();
        
        return $this;
    }

}
