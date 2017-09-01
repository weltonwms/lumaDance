<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Venda extends Model
{
    protected $fillable=['produto_id','valor_compra','valor_venda','qtd','observacao','data'];
    protected $dates = array('data');
    
    public function produto()
    {
        return $this->belongsTo("App\Produto");
    }
    
    public static function getSearch()
    {
        
        return Venda::search()->orderBy('data', 'desc')->paginate(10);
    }
    
    public function scopeSearch($query)
    {
        //veruficar search sendo data ou valor numérico
        $search=request('search');
        if($search):
            $query->orWhere('id','=',$search);
            $query->orWhere('valor_venda','=',$search);
            $query->orWhere('valor_compra','=',$search);
            $query->orWhere('qtd','=',$search);
            $query->orWhereHas('produto', function($que) use ($search){
                $que->where('descricao', 'like', "%".$search."%");
                
            });
           
            
            
        endif;
        //dd($query->toSql());
        
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
    
     public function getTotalVendaAttribute()
    {
        return $this->valor_venda*$this->qtd;
    }
    
    public function getTotalCompraAttribute()
    {
        return $this->valor_compra*$this->qtd;
    }
    
    public function getLucroAttribute()
    {
        return $this->total_venda-$this->total_compra;
    }
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $value);
    }
    
    public function moneytoBr($attr)
    {
        return number_format($this->$attr, 2, ',', '.');
    }
}
