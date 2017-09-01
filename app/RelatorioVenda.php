<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Util;
use App\Venda;

class RelatorioVenda extends Model
{
     private $query;
    public $items=[];
    public $total_lucro;
    public $total_venda;

    public function __construct(array $attributes = array())
    {
        $this->query = Venda::query();
        parent::__construct($attributes);
    }

    public function getRelatorio()
    {
        if (request('produto_id')):
            $this->query->whereIn('produto_id', request('produto_id'));
        endif;

        if (request('periodo_inicial')):
            $dt = Util::dataToMysql(request('periodo_inicial'));
            $this->query->where('data', '>=', $dt);
        endif;

        if (request('periodo_final')):
            $dt = Util::dataToMysql(request('periodo_final'));
            $this->query->where('data', '<=', $dt);
        endif;
        $this->items = $this->query->orderBy('data', 'desc')->get();
        $this->calcTotalGeral();
        return $this;
    }

    private function calcTotalGeral()
    {
        $total_venda=0;
        $total_lucro=0;
        foreach ($this->items as $item):
            $total_lucro+=$item->lucro;
            $total_venda+=$item->total_venda;
        endforeach;
        $this->total_lucro=$total_lucro;
        $this->total_venda=$total_venda;
    }

}
