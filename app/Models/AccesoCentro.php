<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesoCentro extends Model
{
    use HasFactory;

    protected $fillable = ['entrada', 'salida', 'personal_sanitario_id'];

    #protected $casts = [];

    public function personalSanitario(){
        return $this->belongsTo(PersonalSanitario::class);
    }


    //

    public function getHorasJornadaAttribute(){
        return $this->entrada->diffInHours($this->salida);
    }



}
