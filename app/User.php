<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'perfil'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNomePerfilAttribute($value)
    {
        if ($this->perfil):
            $nomes = ['', 'Administrator', 'Secretaria'];
            return $nomes[$this->perfil];
        endif;
    }
    
    public function delete()
    {
        if($this->id==1):
             \Session::flash('mensagem', ['type' => 'danger', 'conteudo' => trans('Impossível Deletar Usuário Principal!')]);
             return false;
        endif;
        return parent::delete();
    }
    
     public function scopeAllUsers($query)
    {
        return $query->where('id','<>', 1);
    }
    
    public function getIsAdmAttribute(){
        return $this->perfil==1;
    }
    
    

}
