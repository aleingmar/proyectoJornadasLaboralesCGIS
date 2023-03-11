<?php

namespace App\Policies;

use App\Models\AccesoCentro;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccesoCentroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {

        //se le asocia al index() el metodo de controlador

        // todos pueden ver citas

        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Auth\Access\Response|bool
     */



    public function view(User $user, AccesoCentro $accesoCentro)
    {
         // quien puede ver el detalle de un acceso?? 
        //dejo ver o al admin o al jefe de guardia de la profesion de ese acceso o al profesional de esa cita 

        return $user->cargo->id == 2 || 
        ($user->cargo->id == 1 && $accesoCentro->personal_sanitario->profesion_id == $user->profesion->id) || 
        ($user->cargo->id == 3 && $accesoCentro->personal_sanitario_id == $user->personal_sanitario->id);


    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // solo lo puede crear la direccion
        return $user->cargo()->id == 2;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AccesoCentro $accesoCentro)
    {
        //
        return $user->cargo()->id == 2;

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AccesoCentro $accesoCentro)
    {
        //
        return $user->cargo()->id == 2;

    }







//////////////////////////////////////////////////////////////////////////////////////////////////////////






    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AccesoCentro $accesoCentro)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccesoCentro  $accesoCentro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AccesoCentro $accesoCentro)
    {
        //
    }
}
