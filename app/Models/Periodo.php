<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
