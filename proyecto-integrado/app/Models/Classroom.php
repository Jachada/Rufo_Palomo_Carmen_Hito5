<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Classroom extends Model
{
    protected $table = 'classroom';
    protected $fillable=['class'];
    use HasFactory;


    public function obtenerClases() {
        return Classroom::all();
    }

    public function obtenerClase($id)
    {
        return Classroom::find($id);
    }
}