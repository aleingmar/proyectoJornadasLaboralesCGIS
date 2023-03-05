<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesionRequest;
use App\Http\Requests\UpdateProfesionRequest;
use App\Models\Profesion;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesiones = Especialidad::paginate(25);
        return view('/profesiones/index', ['profesiones' => $profesiones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        {
            return view('profesiones/create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfesionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesionRequest $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
        ], [
            'nombre.required' => 'La profesion es obligatoria',
        ]);
        $profesion = new Profesion($request->all());
        $profesion->save();
        session()->flash('success', 'Profesion creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('profesions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function show(Profesion $profesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesion $profesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfesionRequest  $request
     * @param  \App\Models\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfesionRequest $request, Profesion $profesion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesion  $profesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesion $profesion)
    {
        //
    }
}
