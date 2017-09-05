<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
        $teacher=$this->route('teacher');
        $id=$teacher?$teacher->id:null;
        return [
            'nome'=>"required",
            'email'=>"required|email|unique:teachers,email,$id",
            'telefone'=>"required",
            'percentual'=>"required",
            
        ];
    }
}
