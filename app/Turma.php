<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Turma extends Model {

    protected $fillable = ['descricao', 'horario_inicio', 'horario_termino', 'dias_semana','teacher_id'];

    
    public function teacher()
    {
        return $this->belongsTo("App\Teacher");
    }
    
    public function contratos()
     {
         return $this->hasMany("App\Contrato");
     }
    
    public function getDiasSemanaAttribute($value)
    {
	//exit('oi');
        return json_decode($value);
    }

    public function setDiasSemanaAttribute($value)
    {

        $arrayValuesInt = array_map(function($val) {
            return (int) $val;
        }, $value);
        $this->attributes['dias_semana'] = json_encode($arrayValuesInt);
    }
    
     public function getNomesDiasSemanaAttribute()
    {
         $nomes='';
         $lista_dias=['domingo','segunda','terça','quarta','quinta','sexta','sábado'];
        foreach($this->dias_semana as $dia):
            $nomes.=$lista_dias[$dia]. " | ";
        endforeach;
        return $nomes;
    }

     public function getHorarioInicioAttribute($value)
    {
       $date=new \DateTime($value);
	return $date->format("H:i");
    }
    
    public function getHorarioTerminoAttribute($value)
    {
       $date=new \DateTime($value);
	return $date->format("H:i");
    }
    
    public static function grade()
    {
        //$turmas=DB::table('turmas') ->orderBy('horario_inicio', 'asc')->get();
        $turmas=Turma::all()->sortBy('horario_inicio');
        //dd($turmas[0]->dias_semana);
        $lista=array();
        foreach($turmas as $turma):
            $dias_semana=  $turma->dias_semana;
            foreach($dias_semana as $dia_semana):
                $lista[$turma->horario_inicio][$dia_semana][]=$turma;
            endforeach;
        endforeach;
        return $lista;
    }
    
    public function verifyAndDelete()
    {
        if($this->contratos->count()){
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => "Existe Contrato(s) relacionado(s) a esta Turma"]);
            return false;
        }
        return $this->delete();
    }

}
