<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class State extends Model
{
    protected $table = 'states';
    protected $fillable=['state'];
    use HasFactory;


    public function obtenerEstados() {
        return State::all();
    }

    public function obtenerEstadoId($id)
    {
        return State::find($id);
    }
}