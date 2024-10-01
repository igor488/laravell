<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }

    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
