<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function agendamentos()
    {
        return $this->hasMany(Agendamento::class);
    }
}
