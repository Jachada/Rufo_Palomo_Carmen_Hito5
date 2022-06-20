<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable=['id'];
    use HasFactory;

    public function obtenerAdmins()
    {
        return Admin::all();
    }


    public function esAdmin($id)
    {
        return Admin::find($id);
    }


}
