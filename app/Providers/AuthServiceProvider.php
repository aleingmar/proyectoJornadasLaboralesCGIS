<?php

namespace App\Providers;

use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Medicamento;
use App\Models\Medico;
use App\Models\Paciente;
use App\Policies\CitaPolicy;
use App\Policies\EspecialidadPolicy;
use App\Policies\MedicamentoPolicy;
use App\Policies\MedicoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',

        //enlaza los policies a los modelos

        PersonalSanitario::class => PersonalSanitarioPolicy::class,
        Cargo::class => CargoPolicy::class,
        Profesion::class => ProfesionPolicy::class,
        AccesoCentro::class => AccesoCentroPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
