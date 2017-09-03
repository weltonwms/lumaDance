<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Mensalidade extends Model {

    protected $fillable = ['vencimento', 'valor', 'quitada', 'pago_em', 'contrato_id'];
    protected $dates = array('vencimento', 'pago_em');
    protected $observables = ['quitada'];

    public function getVencimentoAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function contrato()
    {
        return $this->belongsTo("App\Contrato");
    }

    public function setVencimentoAttribute($value)
    {
        if ($value && !$value instanceof Carbon):
            $this->attributes['vencimento'] = Carbon::createFromFormat('d/m/Y', $value);
        else:
            $this->attributes['vencimento'] = $value;
        endif;
    }

    public function setPagoEmAttribute($value)
    {

        if ($value && !$value instanceof Carbon):
            $this->attributes['pago_em'] = Carbon::createFromFormat('d/m/Y', $value);
        else:
            $this->attributes['pago_em'] = $value;
        endif;
    }

    public function getVencimentoCarbonAttribute()
    {
        return Carbon::createFromFormat('d/m/Y', $this->vencimento);
    }

    public function getFormatedValorAttribute()
    {
        return number_format($this->attributes['valor'], 2, ',', '.');
    }

    public function getFormatedPagoEmAttribute()
    {
        if ($this->pago_em):
            return $this->pago_em->format('d.m.Y');
        endif;
    }

    public function getNomeStatusAttribute()
    {
        if($this->quitada!=1 && $this->vencimentoCarbon->lt(Carbon::now())):
            return "vencida";
        endif;
        $status = $this->quitada ? 1 : 0;
        $nomes = ['Aberta', 'Quitada'];
        
        return $nomes[$status];
    }

    public function setValorAttribute($price)
    {
        if (!is_numeric($price)):
            $price = str_replace(".", "", $price);
            $price = str_replace(",", ".", $price);
        endif;
        $this->attributes['valor'] = $price;
    }

    public function quitar()
    {
        $retorno = false;
        if ($this->quitada != 1 && $this->contrato->ativo == 1):
            $this->quitada = 1;
            $retorno = $this->save();
            $this->fireModelEvent('quitada', false);
        endif;
        return $retorno;
    }

    public function desquitar()
    {
        if ($this->quitada == 1):
            $this->quitada = 0;
            $this->pago_em=null;
            $this->save();
            $m=\App\TeacherPayment::where('mensalidade_id', $this->id)->first();
            return $m->delete();
        endif;
        return false;
    }

    public function VerifyAndSave()
    {
        if ($this->quitada == 1):
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
            return false;
        endif;
        return $this->save();
    }

    public function VerifyAndDelete()
    {
        if ($this->quitada == 1):
            \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('messages.error')]);
            return false;
        endif;
        return $this->delete();
    }

}
