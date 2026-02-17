<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'movil'];

    // Relación 1:N con Mascota
    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }
}