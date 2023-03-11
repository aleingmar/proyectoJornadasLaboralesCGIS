<?php

namespace App\Models;

#use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function personal_sanitario()
    {
        return $this->hasOne(PersonalSanitario::class);
    }

    public function personal_sanitario()
    {
        return $this->hasOne(PersonalSanitario::class);
    }

    public function cargo(){
        return $this->hasManyThrough(Cargo::class, PersonalSanitario::class);
    }

    public function profesion(){
        return $this->hasManyThrough(Profesion::class, PersonalSanitario::class);
    }

    


    # DUDA


    #https://laravel.com/docs/8.x/eloquent-mutators)
    
    #Creo que no sirve para nada

    #public function getProfesionAttribute(){return $this->personal_sanitario()::getProfesionAttribute;}




    //no estoy seguro de si es personal_sanitario()->cargo() o personal_sanitario()::cargo()
    
    public function getTipoUsuarioAttribute(){ //cargo

        return $this->personal_sanitario()->cargo()->nombre;
 
     }


    
}
