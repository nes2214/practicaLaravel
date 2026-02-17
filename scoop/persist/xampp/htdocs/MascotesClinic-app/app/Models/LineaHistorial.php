<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaHistorial extends Model
{
    use HasFactory;

    protected $fillable = ['fecha', 'motivo_visita', 'descripcion', 'mascota_id'];

    protected $casts = [
        'fecha' => 'date',
    ];

    // Relación N:1 con MascotaA
    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}