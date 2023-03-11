<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\Nuhsa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function create_personal_sanitario()
    {
        $personal = PersonalSanitario::all();
        return view('auth.register-personal_sanitario', ['personal_sanitarios' => $personal]);
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'telefono' => 'required|integer|digits:9',
        ];

       
        $request->validate($rules);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
        ]);


        
        $personal = new PersonalSanitario($request->all());
        $personal->user_id = $user->id;
        $personal->save();
        
        
        $user->fresh();
        Auth::login($user);
        event(new Registered($user));
        return redirect(RouteServiceProvider::HOME);
    }


    
}
