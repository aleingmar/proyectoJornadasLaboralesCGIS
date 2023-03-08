<?php

namespace App\Policies;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CitaPolicy
{



    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function viewAny(User $user)
    {

        //se le asocia al index() el metodo de controlador

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cita  $cita
     * @return mixed
     */
    public function view(User $user, Cita $cita)
    {
        // quien puede ver el detalle de una cita?? 
        //dejo ver o al admin o al paciente de esa cita o al medico de esa cita 

        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $cita->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $cita->medico_id == $user->medico->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function create(User $user)
    {

        // todo el mundo puede ver una cita
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cita  $cita
     * @return mixed
     */
    public function update(User $user, Cita $cita)
    {


        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $cita->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $cita->medico_id == $user->medico->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cita  $cita
     * @return mixed
     */
    public function delete(User $user, Cita $cita)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $cita->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $cita->medico_id == $user->medico->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cita  $cita
     * @return mixed
     */
    /*
    public function restore(User $user, Cita $cita)
    {
        //
    }
    */
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cita  $cita
     * @return mixed
     */

    /*
    public function forceDelete(User $user, Cita $cita)
    {
        //
    }
    */

    public function attach_medicamento(User $user, Cita $cita)
    {

        //sirve para las relaciones n:n --> añadir medicamentos a una cita (añadir fila a la tabla intermedia)

        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 1 && $cita->medico_id == $user->medico->id);
    }

    public function detach_medicamento(User $user, Cita $cita)
    {

        // quitar fila de la tabla intemedia
        
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 1 && $cita->medico_id == $user->medico->id);
    }
}
