<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Condition;
use App\Models\Comment;
use Barryvdh\DomPDF\Facade as PDF;

class issueUserController extends Controller
{    
    protected $issues;    
    protected $class;    
    protected $user;
    protected $conditions;
    
    public function __construct(Issue $issues, Classroom $class, User $user, Condition $conditions)
    {
        $this->issues = $issues;
        $this->class = $class;
        $this->user = $user;
        $this->conditions = $conditions;
    }
    
    /**
     * Perfil del usuario en el que se muestra sus datos y sus incidencias pudiendo filtrarlas
     *
     * @param  mixed $request
     * @return void
     */
    public function profile(Request $request) {
        $user = $this->user->obtenerUsuario(auth()->id());
        $class = $this->class->obtenerClases();
        $conditions = $this->conditions->obtenerCondiciones();

        if($request->queryString != "" || $request->condition != "" || $request->classroom != ""){
            $issues = $this->issues->filtrarIncidenciaUser(auth()->id(), $request->queryString, $request->classroom, $request->condition);
        }else{
            $issues = $this->issues->obtenerIncidenciaUser(auth()->id());
        }
        return view('components.user', ['issues' => $issues], ['user' => $user, 'class' => $class, 'conditions' => $conditions]);
    }
}
