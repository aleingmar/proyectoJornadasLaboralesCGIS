<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonalSanitarioRequest;
use App\Http\Requests\UpdatePersonalSanitarioRequest;
use App\Models\PersonalSanitario;

class PersonalSanitarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalSanitario $personalSanitario)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalSanitario  $personalSanitario
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalSanitario $personalSanitario)
    {
        //
    }
}
