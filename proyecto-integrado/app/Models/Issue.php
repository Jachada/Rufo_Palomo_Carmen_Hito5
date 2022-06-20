<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Issue extends Model
{
    protected $table = 'issues';
    protected $fillable = ['title','description','author','classroom', 'id_condition'];
    use HasFactory;

    public function classroomRelation()
    {
        return $this->belongsTo(Classroom::class, 'classroom');
    }

    public function conditionRelation()
    {
        return $this->belongsTo(Condition::class, 'id_condition');
    }

    public function userRelation()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'issue')->orderBy('created_at', 'desc');
    }

    public function obtenerIncidencias()
    {
        return Issue::orderBy('updated_at', 'desc')->get();
    }


    public function obtenerIncidenciaId($id)
    {
        return Issue::find($id);
    }

    public function obtenerIncidenciaUser($author)
    {
        return Issue::where('author', $author)->orderByDesc('updated_at')->get();
    }

    public function filtrarIncidencia($queryString, $classroom, $condition)
    {
        return Issue::where(function ($query) use ($queryString, $classroom, $condition) {
            $query-> where (function ($query) use ($queryString){
                            $query-> OrWhere('title', 'like', '%'.$queryString.'%')
                                  -> OrWhere('description', 'like', '%'.$queryString.'%');
                            })
                            -> where (function ($query) use ($condition){
                                      $query -> Where('id_condition', 'like', '%'.$condition.'%');
                            })
                            -> where (function ($query) use ($classroom){
                                      $query -> Where('classroom', 'like', '%'.$classroom.'%');
                            });
        })
        ->orderByDesc('updated_at')->get();
    }

    public function filtrarIncidenciaUser($author, $queryString, $classroom , $condition)
    {
        return Issue::where(function ($query) use ($author, $queryString, $classroom, $condition) {
            $query->where('author', $author)
            -> where (function ($query) use ($queryString){
                      $query -> OrWhere('title', 'like', '%'.$queryString.'%')
                             -> OrWhere('description', 'like', '%'.$queryString.'%');
            })
            -> where (function ($query) use ($classroom){
                $query -> Where('classroom', 'like', '%'.$classroom.'%');
      })
            -> where (function ($query) use ($condition){
                      $query -> Where('id_condition', 'like', '%'.$condition.'%');
            });
        })
        ->orderByDesc('updated_at')->get();
    }

    
}
