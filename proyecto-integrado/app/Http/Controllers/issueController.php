<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Issue;
use App\Models\Classroom;
use App\Models\User;
use App\Models\Admin;
use App\Models\Condition;
use App\Models\Comment;
use App\Mail\NotifyMail;

class issueController extends Controller
{    
    /**
     * Incidencias
     *
     * @var mixed
     */
    protected $issues;    
    /**
     * Aulas
     *
     * @var mixed
     */
    protected $class;    
    /**
     * Usuario
     *
     * @var mixed
     */
    protected $user;    
    /**
     * Administrador
     *
     * @var mixed
     */
    protected $admin;    
    /**
     * Estado de las incidencias
     *
     * @var mixed
     */
    protected $conditions;
    
    /**
     * Constructor
     *
     * @param  mixed $issues
     * @param  mixed $class
     * @param  mixed $user
     * @param  mixed $admin
     * @param  mixed $conditions
     * @return void
     */
    public function __construct(Issue $issues, Classroom $class, User $user, Admin $admin, Condition $conditions)
    {
        $this->issues = $issues;
        $this->class = $class;
        $this->user = $user;
        $this->admin = $admin;
        $this->conditions = $conditions;
    }
    
    /**
     * Comprueba si el usuario es administrador
     *
     * @return void
     */
    public function useradmin()
    {
        return $admin = $this->admin->esAdmin(auth()->id());
    }
    
    /**
     * Muestra las incidencias según si eres administrador u otro usuario y según si has añadido filtro
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $class = $this->class->obtenerClases();
        $conditions = $this->conditions->obtenerCondiciones();
        $user = $this->user->obtenerUsuario(auth()->id());

        if($request->queryString != "" || $request->condition != "" || $request->classroom != ""){
            $issues = $this->issues->filtrarIncidencia($request->queryString, $request->classroom, $request->condition);
        }else{
            $issues = $this->issues->obtenerIncidencias();
        }

        if ($this->useradmin()) {
            return view('components.admin-issue', ['issues' => $issues, 'user' => $user, 'class' => $class, 'conditions' => $conditions]);
        } else {
            return view('components.issues', ['issues' => $issues, 'user' => $user, 'class' => $class, 'conditions' => $conditions]);
        }
    }
    
    /**
     * Vista para crear incidencias
     *
     * @return void
     */
    public function create()
    {
        $class = $this->class->obtenerClases();
        return view('components.issue-create', ['class' => $class]);
    }
    
    /**
     * Crear incidencias con los datos añadidos y enviar email
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $issue = Issue::create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => auth()->id(),
            'classroom' => $request->classroom,
        ]);
        $issue->save();

        $user = $this->user->obtenerUsuario(auth()->id());
        Mail::to($user->email)->send(new NotifyMail($issue));

        return redirect("/perfil");
    }
    
    /**
     * Ver una única incidencia
     *
     * @param  mixed $id
     * @return void
     */
    public function view($id)
    {
        $issue = $this->issues->obtenerIncidenciaId($id);
        return view('components.issue-view', ['issue' => $issue]);
    }
    
    /**
     * Vista para editar una incidencia
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $issue = $this->issues->obtenerIncidenciaId($id);
        $class = $this->class->obtenerClases();
        $conditions = $this->conditions->obtenerCondiciones();
        if ($this->useradmin()) {
            return view('components.admin-issue-edit', ['issue' => $issue, 'class' => $class, 'conditions' => $conditions]);
        } else if($issue->author == auth()->id()) {
            return view('components.issue-edit', ['issue' => $issue, 'class' => $class]);
        } else {
            return redirect('/perfil');
        }
    }
    
    /**
     * Actualizar incidencia con los datos añadidos
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $issue = $this->issues->obtenerIncidenciaId($id);
        $issue->fill($request->all());
        if ($request->id_condition) {
            $issue->closed_at = date('Y-m-d H:i:s');
        }
        $user = $this->user->obtenerUsuario($issue->author);
        $issue->save();
        if ($request->id_condition == 4 || $user->warning) {
           Mail::to($user->email)->send(new NotifyMail($issue));
        }
        if ($this->useradmin()) {
            return redirect("/incidencias");
        } else {
            return redirect('/perfil');
        }
    }
    
    /**
     * Añadir comentario
     *
     * @param  mixed $request
     * @return void
     */
    public function storeComment(Request $request)
    {
        $comment = Comment::create([
            'issue' => $request->issue,
            'comment' => $request->comment,
            'author' => auth()->id(),
        ]);
        $comment->save();
        $issue = $this->issues->obtenerIncidenciaId($request->issue);

        $user = $this->user->obtenerUsuario($issue->author);
        if ($user->warning) {
            Mail::to($user->email)->send(new NotifyMail($comment));
        }
        
        if ($this->useradmin()) {
            return redirect("/incidencias");
        } else {
            return redirect('/perfil');
        }
    }
        
    /**
     * Actualizar estado de una incidencia
     *
     * @param  mixed $request
     * @return void
     */
    public function updateCondition(Request $request)
    {
        $issue = $this->issues->obtenerIncidenciaId($request->issue);
        $issue->fill($request->all());

        $user = $this->user->obtenerUsuario($issue->author);
        $issue->save();
        if ($user->warning) {
            Mail::to($user->email)->send(new NotifyMail($issue));
        }

        if ($this->useradmin()) {
            return redirect("/incidencias");
        } else {
            return redirect('/perfil');
        }
    }
}
