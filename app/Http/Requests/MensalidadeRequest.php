<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Helpers\Util;

class MensalidadeRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id_mensalidade=  $this->id_mensalidade;
        $vencimento= Util::dataToMysql($this->vencimento);
        $valor=Util::moneyBrToUsd($this->valor);
       
        $rules = [
            'vencimento' => "required",
            'valor' => "required",
            'contrato_id' => ['required', Rule::unique('mensalidades')->where(function ($query) use($vencimento,$valor) {
               
                        return $query->where('valor', $valor)->where('vencimento',$vencimento);
                    })->ignore($id_mensalidade)]
        ];
        if ($this->segment(2) == 'quitar'):
            $rules['pago_em'] = 'required';
        endif;

        return $rules;
    }
    
    public function messages()
    {
        return[
            'contrato_id.unique' => 'Mensalidade Repetida!',
        ];
    }

}
