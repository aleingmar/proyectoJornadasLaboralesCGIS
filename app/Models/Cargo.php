<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre'];

    public function personal_sanitarios(){
        return $this->hasMany(PersonalSanitario::class);
    }

    
    //para jugar un poco
    //accedo a los accesos de un tipo de cargo:

    public function accesos_centro(){
        return $this->hasManyThrough(AccesoCentro::class, PersonalSanitario::class);
    }


}
