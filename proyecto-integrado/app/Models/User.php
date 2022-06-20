<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'date_birth',
        'telephone',
        'id_state'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function statesRelation()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function obtenerUsuarios()
    {
        return User::all();
    }

    public function obtenerUsuariosOrdenados()
    {
        return User::orderBy('id_state', 'asc')->get();
    }

    public function obtenerUsuario($id)
    {
        return User::find($id);
    }

    public function obtenerUsuarioNombre($name)
    {
        return User::where('name', $name);
    }

    public function stateRelation()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function filtrarUsuarios($queryString, $telephoneEmail, $warning , $state)
    {
        return User::where(function ($query) use ($queryString, $telephoneEmail, $warning, $state) {
            $query->where('name', 'like', '%'.$queryString.'%')
            -> where (function ($query) use ($telephoneEmail){
                      $query -> OrWhere('telephone', 'like', '%'.$telephoneEmail.'%')
                             -> OrWhere('email', 'like', '%'.$telephoneEmail.'%');
            })
            -> where (function ($query) use ($warning){
                $query -> Where('warning', 'like', '%'.$warning.'%');
      })
            -> where (function ($query) use ($state){
                      $query -> Where('id_state', 'like', '%'.$state.'%');
            })
            ;
        })
        ->orderByDesc('updated_at')->get();
    }
}
