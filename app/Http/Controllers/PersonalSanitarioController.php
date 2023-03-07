<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePersonalSanitarioRequest;
use App\Http\Requests\UpdatePersonalSanitarioRequest;
use App\Models\PersonalSanitario;

class PersonalSanitarioController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(PersonalSanitario::class, 'personal_sanitario');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $personal_sanitarios = PersonalSanitario::paginate(25);
        return view('/personal_sanitarios/index', ['personal_sanitarios' => $personal_sanitarios]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('personal_sanitarios/create', ['cargos' => $cargos, 'profesiones' => $profesiones]);
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePersonalSanitarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePersonalSanitarioRequest $request)
    {
        //

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'telefono' => 'required|integer|digits:9',
            'cargo_id' => 'required|exists:cargos,id',
            'profesion_id' => 'required|exists:profesions,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
        ]);

        //DUDA

        $personal_sanitario = new PersonalSanitario($request->all());
        $personal_sanitario->user_id = $user->id;
        $personal_sanitario->save();
        session()->flash('success', 'Personal Sanitario creado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('personal_sanitarios.index');





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalSanitario $personalSanitario)
    {
        //

        //DUDA -> pk en el show se le pasa el listado de cargos y profesiones (profesional_sanitario)

        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('personal_sanitarios/show', ['personal_sanitario' => $personalSanitario, 'cargos' => $cargos,
         'profesiones' => $profesiones]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalSanitario $personalSanitario)
    {
        $cargos = Cargo::all();
        $profesiones = Profesion::all();
        return view('personal_sanitarios/edit', ['personal_sanitario' => $personalSanitario, 'cargos' => $cargos,
         'profesiones' => $profesiones]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePersonalSanitarioRequest  $request
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePersonalSanitarioRequest $request, PersonalSanitario $personalSanitario)
    {
        //

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'telefono' => 'required|integer|digits:9',
            'cargo_id' => 'required|exists:cargos,id',
            'profesion_id' => 'required|exists:profesions,id',
        ]);

        // personalSanitario--> personal_sanitario
        //DUDA 
        $user = $personalSanitario->user;
        $user->fill($request->all());
        $user->save();
        $personalSanitario->fill($request->all());
        $personalSanitario->save();
        session()->flash('success', 'Personal Sanitario creado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('personal_sanitarios.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalSanitario $personalSanitario)
    {
        if($personalSanitario->delete()) {
            session()->flash('success', 'Personal Sanitario borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'El personal sanitario no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('personal_sanitarios.index');
    }
}
