<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';




Route::middleware(['auth'])->group(function () {
    Route::resources([
        //No pongo medicos como route resource porque voy a añadirle middlewares diferentes
        //'medicos' => MedicoController::class,

        //ASOCIO EL CRUD DE ESTAS ENTIDADES CON SUS CONTROLADORES
        'acceso_centros' => AccesoCentroController::class,
        'cargos' => CargoController::class,
        'profesions' => ProfesionController::class,
        'personal_sanitarios' => PersonalSanitarioController::class,
    ]);


    //Route::get('/pacientes-hoy', [PacienteController::class, 'pacientesHoy']);
    //Todos los usuarios pueden listar y ver el detalle de un médico
    //Route::get('/medicos', [MedicoController::class, 'index'])->name('medicos.index');
    //Route::get('/medicos/{medico}', [MedicoController::class, 'show'])->name('medicos.show');

});







////////////////////////////////////////////////////////////////////////////////////////////////////////
//     NO SIRVE CREO
////////////////////////////////////////////////////////////////////////////////////////////////

// HACE MAS COSAS PARA USAR EL MIDDLEWARE DE IS TIPO DE USUARIO PERO ES EXACTAMENTE LO MISMO QUE LAS POLICIES
// YO NO LO GENGO QUE USAR







//Solo los administradores pueden crear y borrar médicos, así como trabajar con el CRUD de Medicamentos
Route::middleware(['auth', 'tipo_usuario:3'])->group(function () {
    Route::get('/medicos/create', [MedicoController::class, 'create'])->name('medicos.create');
    Route::post('/medicos', [MedicoController::class, 'store'])->name('medicos.store');
    Route::delete('/medicos/{medico}', [MedicoController::class, 'destroy'])->name('medicos.destroy');
    Route::resources([
        'medicamentos' => MedicamentoController::class,
    ]);
});


//CITAS


//Tanto los médicos como los administradores pueden editar el médico y trabajar con los medicamentos de las citas


Route::middleware(['auth', 'tipo_usuario:1,3'])->group(function () { // le paso los dos tipos de middleware esos
    // kernel php , asocial tipo_usuario a la clase de middleware ISTIPOUSUARIO
    //le paso al middleware 1 y 3
    // este middleware hace lo mismo practicamente que la policies

    //auth es si el usuario esta logueado o no, si esta logueado next si no pasa al principio

    Route::get('/medicos/{medico}/edit', [MedicoController::class, 'edit'])->name('medicos.edit');
    Route::put('/medicos/{medico}', [MedicoController::class, 'update'])->name('medicos.update');
    //Dos rutas que tienen además un middleware con un Policy para hilar fino

    // se le pasa entre {} con el nombre del modelo en minuscula 

    Route::post('/citas/{cita}/attach-medicamento', [CitaController::class, 'attach_medicamento']) //añadir medicamento a la cita
        ->name('citas.attachMedicamento')
        ->middleware('can:attach_medicamento,cita'); //can significa: usa la policies (antes de llegar al controlaodr )
    Route::delete('/citas/{cita}/detach-medicamento/{medicamento}', [CitaController::class, 'detach_medicamento']) //quitar medicamento a la cita
        ->name('citas.detachMedicamento')
        ->middleware('can:detach_medicamento,cita');
});
