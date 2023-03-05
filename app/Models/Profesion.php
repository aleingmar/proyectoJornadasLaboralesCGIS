<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function personal_sanitarios(){
        return $this->hasMany(PersonalSanitario::class);
    }
}
