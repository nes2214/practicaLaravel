<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('linea_historials', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('motivo_visita');
            $table->text('descripcion');
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('linea_historials');
    }
};