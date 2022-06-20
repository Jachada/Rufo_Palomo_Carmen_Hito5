<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-z0-9.]*@iespoligonosur\.org$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'date_birth' => ['required', 'date'],
            'telephone' => ['required', 'numeric', 'min:9'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'date_birth' => $request->date_birth,
            'telephone' => $request->telephone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $user = $user->obtenerUsuario(auth()->id());
        if ($user->id_state == 2) {
            return redirect('/perfil');
        } else {
            return redirect('/accesoDenegado');
        }
    }
}
