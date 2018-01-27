<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $id_contrato=  $this->contrato_id;
        $turma_id=  $this->turma_id;
       
        return [
            'aluno_id' => ['required', Rule::unique('contratos')->where(function ($query) use($turma_id) {
               
                        return $query->where('turma_id', $turma_id)->where('ativo','1');
                    })->ignore($id_contrato)],
            'turma_id'=>"required",
            'dia_vencimento'=>"required",
            'inicio_contrato'=>"required",
            'valor_vencimento'=>'required',
        ];
    }
    
    public function messages()
    {
        return[
            'aluno_id.unique' => 'Já existe Contrato Ativo nessa Turma para esse Aluno!',
        ];
    }
}
