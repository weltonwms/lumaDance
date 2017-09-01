<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TeacherPayment extends Model {

    protected $fillable = ['valor', 'pago', 'pago_em', 'teacher_id', 'mensalidade_id'];
    protected $dates = array('pago_em');

    public function mensalidade()
    {
        return $this->belongsTo("App\Mensalidade");
    }

    public function teacher()
    {
        return $this->belongsTo("App\Teacher");
    }
    
    public function quitar()
    {
        $this->pago=1;
        $this->pago_em=  Carbon::now();
        $this->save();
    }

    public static function getQuery($request)
    {
        $status = $request->input('st') ? $request->input('st') : 0;
        $res = TeacherPayment::where('pago', $status);
        if ($request->input('teacher')):
            $res->where('teacher_id', $request->input('teacher'));
        endif;
        return $res->get();
    }
    
    public function getFormatedValorAttribute()
    {
         return number_format($this->attributes['valor'], 2, ',', '.');
    }
    
    public function getFormatedPagoAttribute()
    {
         $status=  $this->pago?1:0;
         $nomes=["Não",'Sim'];
         return $nomes[$status];
    }

}
