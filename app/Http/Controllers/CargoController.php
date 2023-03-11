<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use App\Models\Cargo;

class CargoController extends Controller
{

    public function __construct()
    {   // aqui esta asociado el policies 
        $this->authorizeResource(Cargo::class, 'cargo');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::paginate(25);
        return view('/cargos/index', ['cargos' => $cargos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCargoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargoRequest $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
        ], 
        [
            'nombre.required' => 'El cargo es obligatoria',
        ]);

        $cargo = new Cargo($request->all());
        $cargo->save();
        session()->flash('success', 'Cargo creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        //pk se llama asi la ruta?
        return redirect()->route('cargos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        return view('cargos/edit', ['cargo' => $cargo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCargoRequest  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        $this->validate($request, [
            'nombre' => 'required|string|max:255',
       ],)
       
       $cargo->fill($request->all());
       $cargo->save();
       session()->flash('success', 'Cargo modificada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
       return redirect()->route('cargos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        if($cargo->delete()) {
            session()->flash('success', 'Cargo borrada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'No pudo borrarse el cargo.');
        }
        return redirect()->route('cargos.index');
    }
}
