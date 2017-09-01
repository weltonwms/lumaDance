<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
     protected $fillable=['nome','email','telefone','percentual'];
     
     public function turmas()
     {
         return $this->hasMany("App\Turma");
     }
}
