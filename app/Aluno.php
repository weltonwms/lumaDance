<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Aluno extends Model
{
    protected $fillable=['nome','email','telefone','nascimento','endereco'];
    protected $dates = array('nascimento');
   
    public function getNascimentoAttribute($value)
    {
        
        return Carbon::parse($value)->format('d/m/Y');
    }
     
    
    public  function getNascimento1Attribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->nascimento);
    }
    
    
    public function setNascimentoAttribute($value){
        $this->attributes['nascimento'] = Carbon::createFromFormat('d/m/Y', $value);
    
    }
     

}
