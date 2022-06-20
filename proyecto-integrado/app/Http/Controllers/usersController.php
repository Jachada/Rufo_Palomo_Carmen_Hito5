<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\State;
use App\Models\Admin;
use App\Mail\NotifyMailUser;

class usersController extends Controller
{    
    /**
     * Usuarios
     *
     * @var mixed
     */
    protected $users;    
    /**
     * Estado de los usuarios
     *
     * @var mixed
     */
    protected $states;    
    /**
     * Administrador
     *
     * @var mixed
     */
    protected $admin;

    
    /**
     * Constructor
     *
     * @param  mixed $users
     * @param  mixed $states
     * @param  mixed $admin
     * @return void
     */
    public function __construct(User $users, State $states, Admin $admin)
    {
        $this->users = $users;
        $this->states = $states;
        $this->admin = $admin;
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
     * Muestra todos los usuarios si eres administrador y según si has añadido filtro
     *
     * @param  mixed $request
     * @return void
     */
    public function admin(Request $request)
    {
        $states = $this->states->obtenerEstados();

        if($request->queryString != "" || $request->telephoneEmail != "" || $request->state != "" || $request->warning != ""){
            $users = $this->users->filtrarUsuarios($request->queryString, $request->telephoneEmail, $request->warning, $request->state);
        }else{
            $users = $this->users->obtenerUsuariosOrdenados();
        }

        if ($this->useradmin()) {
            return view('components.admin-users', ['users' => $users, 'states' => $states]);
        }
    }
    
    /**
     * Redirección para usuarios que estén dados de baja o pendientes de confirmar
     *
     * @return void
     */
    public function denied()
    {
        $user = $this->users->obtenerUsuario(auth()->id());
        $state = $user->id_state;
        Cookie::queue(Cookie::forget('laravel_session'));
        if ($state == 1) {
            return view('components.user-pendient-confirmation', ['users' => $user]);
        } else {
            return view('components.user-low', ['users' => $user]);
        }
        route('logout');
        
    }
    
    /**
     * Vista para editar un usuario
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!$this->useradmin()) {
            return view('usuarios.index');
        }
        $user = $this->users->obtenerUsuario($id);
        $states = $this->states->obtenerEstados();
        if ($this->useradmin()) {
            return view('components.admin-user-edit', ['user' => $user, 'states' => $states]);
        } else {
            return view('components.user-edit', ['user' => $user]);
        }
    }
    
    /**
     * Editar un usuario con los datos añadidos
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $user = $this->users->obtenerUsuario(auth()->id());

        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-z0-9.]*@iespoligonosur\.org$/'],
        //     'password' => ['confirmed', Rules\Password::defaults()],
        //     'date_birth' => ['required', 'date'],
        //     'telephone' => ['required', 'numeric', 'size:9'],
        // ]);

        $user->name =$request->name;
        $user->email = $request->email;
        $user->date_birth = $request->date_birth;
        $user->telephone = $request->telephone;
        $user->warning = $request->warning;
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();
	if ($this->useradmin()) {
		return redirect('usuarios');
	} else {
        return redirect("/perfil");
	}
    }
    
    /**
     * Actualizar estado de un usuario
     *
     * @param  mixed $request
     * @return void
     */
    public function updateState(Request $request)
    {
        $user = $this->users->obtenerUsuario($request->user);
        $user->fill($request->all());
        $user->save();
        Mail::to($user->email)->send(new NotifyMailUser($user));


        return redirect("/usuarios");

    }

}
