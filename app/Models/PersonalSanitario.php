<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalSanitario extends Model
{
    use HasFactory;

    protected $fillable = ['profesion', 'cargo'];

    #protected $casts = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    #public function especialidad(){return $this->belongsTo(Especialidad::class);}

    public function accesos(){
        return $this->hasMany(AccesoCentro::class);
    }


    public function getProfesionAttribute(){
        return $this->profesion;
    }

    public function getCargoAttribute(){
        return $this->cargo;
    }

    //

    #public function getDiasContratadoAttribute(){return Carbon::now()->diffInDays($this->fecha_contratacion);}










}
