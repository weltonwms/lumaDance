<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable=['descricao','valor_compra','valor_venda','estoque'];
    
    public function vendas()
    {
        return $this->hasMany("App\Venda");
    }


    public function setValorCompraAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        
            $this->attributes['valor_compra'] = (float)$price;
       
    }
    
    public function setValorVendaAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        
            $this->attributes['valor_venda'] = (float)$price;
       
    }
    
    public function getFormatedValorCompraAttribute()
    {
        return number_format($this->attributes['valor_compra'], 2, ',', '.');
    }
    
    public function getFormatedValorVendaAttribute()
    {
        return number_format($this->attributes['valor_venda'], 2, ',', '.');
    }
    
    /**
     * Método que traz dados de todos os produtos em formato de array mapeado
     * pelo índice id. utilizado para datasets em selects por exemplo.
     * @return type array
     */
    public static function getDataSetsProdutos()
    {
        return self::all()->mapWithKeys(function ($item) {
            return [$item['id'] => [
                'data-venda' => $item['valor_venda'],
                'data-compra'=> $item['valor_compra'],
                     ]
                 ];
        })->toArray();
    }
    
    public function verifyAndDelete()
    {
        if($this->vendas->count()){
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => "Existe Venda(s) relacionada(s) a este Produto"]);
            return false;
        }
        return $this->delete();
    }
}
