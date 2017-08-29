<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Despesa extends Model
{
    protected $fillable=['descricao','valor','data'];
    protected $dates = array('data');
    
    
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = Carbon::createFromFormat('d\/m\/Y', $value);
    }
    
    public function getDataAttribute($value)
    {
        
        return Carbon::parse($value)->format('d/m/Y');
    }
    
     public function getFormatedValorAttribute()
    {
        return number_format($this->attributes['valor'], 2, ',', '.');
    }

    public function setValorAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        $this->attributes['valor'] = $price;
    }
}
