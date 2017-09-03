<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mensalidade;

class RelatorioMensalidade extends Model {

    private $query;
    public $items = [];

    public function getRelatorio()
    {
        if (request('tipo_mensalidade') == -1):
            $this->ProcessarNaoQuitadas();
            return $this;
        endif;
        $this->query = Mensalidade::query();
        $this->query->whereHas('contrato', function($query) {
            $query->where('ativo', 1);
        });
        if (request('aluno_id')):
            $this->query->whereHas('contrato', function($query) {
                $query->whereIn('aluno_id', request('aluno_id'));
            });
        endif;

        if (request('teacher_id')):
            $this->query->whereHas('contrato.turma', function($query) {
                $query->whereIn('teacher_id', request('teacher_id'));
            });

        endif;

        if (request('turma_id')):
            $this->query->whereHas('contrato', function($query) {
                $query->whereIn('turma_id', request('turma_id'));
            });
        endif;
        if (request('tipo_mensalidade') == 1):
            $this->query->where('quitada', 1);

        endif;

        if (request('tipo_mensalidade') == -1):
            $this->query->where('quitada', '<>', 1);

        endif;

        $ordem = request('ordenado_por') ? request('ordenado_por') : 'vencimento';
        $this->items = $this->query->orderBy($ordem, 'desc')->get();

        return $this;
    }

    private function ProcessarNaoQuitadas()
    {
        $contratos = $this->getContratos();
        $mensalidades = collect([]);
        $helper = new \App\Helpers\MensalidadeVirtual();

        foreach ($contratos as $key => $contrato):
            $mensalidades = $mensalidades->merge($helper->getVirtuais($contrato));
        endforeach;
        $this->items=$this->filtrarNaoQuitadas($mensalidades);
    }

    private function getContratos()
    {
        $query = \App\Contrato::query();
        $query->where('ativo', 1);
        if (request('aluno_id')):
            $query->whereIn('aluno_id', request('aluno_id'));
        endif;

        if (request('teacher_id')):
            $query->whereHas('turma', function($query) {
                $query->whereIn('teacher_id', request('teacher_id'));
            });
        endif;

        if (request('turma_id')):
            $query->whereIn('turma_id', request('turma_id'));
        endif;
        return $query->get();
    }

    private function filtrarNaoQuitadas($mensalidades)
    {
        $filtered = $mensalidades->reject(function ($item) {
            return $item->quitada == 1;
        });
         $ordem = (request('ordenado_por')=='vencimento') ? 'vencimentoCarbon' : request('ordenado_por');
        $sorted = $filtered->sortByDesc(function ($item) use($ordem) {
            return $item->$ordem;
        });
        return $sorted;
        
    }

}
