<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
{
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
        return [
            'aluno_id'=>"required",
            'turma_id'=>"required",
            'dia_vencimento'=>"required",
            'inicio_contrato'=>"required",
            'valor_vencimento'=>'required',
        ];
    }
}