<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAccesoCentroRequest;
use App\Http\Requests\UpdateAccesoCentroRequest;
use App\Models\AccesoCentro;

class AccesoCentroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // si soy de direccion ---> veo los accesos de todos

        if(Auth::user()->cargo()->id == 2 ){
        $accesos = AccesoCentro::orderBy('entrada', 'desc')->paginate(25);
        }

        //auth es coger la info de la persona que ha iniciado secion
        //si soy jefe de guardia enfermero veo todo lo de los enfermeros

        if(Auth::user()->cargo()->id == 1 & Auth::user()->profesion()->id == 1){
            //junta accesos y personal sanitario por esos atributos
            //se queda solo con los atributos de la tabla accesos
            // y filtra solo los que sean enfermeros

            $accesos = AccesoCentro::join('personal_sanitarios', 'acceso_centros.personal_sanitario_id', 'personal_sanitarios.id')
            ->select('acceso_centros.*')
            ->where('personal_sanitarios.profesion_id', 1)
            ->orderBy('acceso_centros.entrada', 'desc')
            ->paginate(25);
           
            // ->where('personal_sanitarios.cargo_id', 1)

            // auth::user() --> cogeme la instancia de usuario que ha logueado
            //paginate es el metodo terminal
        }

        //si soy jefe de guardia enfermero veo todo lo de los enfermeros

        if(Auth::user()->cargo()->id == 1 & Auth::user()->profesion()->id == 2){

            $accesos = AccesoCentro::join('personal_sanitarios', 'acceso_centros.personal_sanitario_id', 'personal_sanitarios.id')
            ->select('acceso_centros.*')
            ->where('personal_sanitarios.profesion_id', 2)
            ->orderBy('acceso_centros.entrada', 'desc')
            ->paginate(25);
           
        }
       
        // si soy un profesional normal

        if(Auth::user()->cargo()->id == 3 ){
            
            $accesos = AccesoCentro::join('personal_sanitarios', 'acceso_centros.personal_sanitario_id', 'personal_sanitarios.id')
            ->select('acceso_centros.*')
            ->where('personal_sanitarios.id', Auth::user()->personal_sanitario()->id)
            ->orderBy('acceso_centros.entrada', 'desc')
            ->paginate(25);
            }
       
            return return view('/accesos/index', ['accesos' => $accesos]);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //solo puedo crear accesos si soy de la direccion --> se podria hacer que si soy jefe de guardia de enfermeros
        //poder hacerlo solo para los enfermeros

        $personal = PersonalSanitario::all();
        //si soy de direccion

        return view('accesos/create', ['personal' => $personal]);


        //if(Auth::user()->Auth::user()->cargo()->id == 2){return view('accesos/create', ['personal' => $personal]);}
        //no pongo la condicion ya que solo podran pedir el create los de direccion

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccesoCentroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccesoCentroRequest $request)
    {
        //

        $reglas = [
            'entrada' => 'required|datetime',
            'salida' => 'required|datetime',
            'personal_sanitario_id' => 'required|exists:personal_sanitarios,id',
        ];


        $this->validate($request, $reglas);
        $accesos = new AccesoCentro($request->all());
        $accesos->save();
        session()->flash('success', 'Acceso creada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('accesos.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */
    public function show(AccesoCentro $accesoCentro)
    {
        //
        return view('accesos/show', ['accesos' => $accesoCentro]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */



    public function edit(AccesoCentro $accesoCentro)
    {
        // tambien se podria ampliar a si soy jefe de guardia

        $personal = PersonalSanitario::all();

        //if(Auth::user()->Auth::user()->cargo()->id == 2){return view('accesos/edit', ['accesos' => $accesoCentro, 'personal' => $personal]);}
       
        return view('accesos/edit', ['acceso' => $accesoCentro, 'personal' => $personal]);

    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccesoCentroRequest  $request
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateAccesoCentroRequest $request, AccesoCentro $accesoCentro)
    {
        //

        $reglas = [
            'entrada' => 'required|datetime',
            'salida' => 'required|datetime',
            'personal_sanitario_id' => 'required|exists:personal_sanitarios,id',
        ];


        $this->validate($request, $reglas);
        $accesoCentro->fill($request->all());
        $accesoCentro->save();
        session()->flash('success', 'Acceso modificada correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        return redirect()->route('accesos.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Http\Response
     */

    public function destroy(AccesoCentro $accesoCentro)
    {
        //

        if($accesoCentro->delete()) {
            session()->flash('success', 'Acceso borrado correctamente. Si nos da tiempo haremos este mensaje internacionalizable y parametrizable');
        }
        else{
            session()->flash('warning', 'El acceso no pudo borrarse. Es probable que se deba a que tenga asociada información como citas que dependen de él.');
        }
        return redirect()->route('accesos.index');


    }
}
