<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'propietario_id'];

    // Relación N:1 con Propietario
    public function propietario()
    {
        return $this->belongsTo(Propietario::class);
    }

    // Relación 1:N con LineaHistorial
    public function lineasHistorial()
    {
        return $this->hasMany(LineaHistorial::class);
    }
}