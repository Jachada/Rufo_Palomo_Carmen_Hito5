<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Condition extends Model
{
    protected $table = 'conditions';
    protected $fillable=['condition'];
    use HasFactory;


    public function obtenerCondiciones() {
        return Condition::all();
    }

    public function obtenerCondicion($id)
    {
        return Condition::find($id);
    }
}