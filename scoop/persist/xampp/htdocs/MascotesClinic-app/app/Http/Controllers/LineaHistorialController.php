<?php

namespace App\Http\Controllers;

use App\Models\LineaHistorial;
use App\Models\Mascota;
use Illuminate\Http\Request;

class LineaHistorialController extends Controller
{
    public function index()
    {
        $linea = LineaHistorial::with('mascota.propietario')->paginate(10);
        return view('linea-historial.index', compact('linea'));
    }

    public function create()
    {
        $mascotas = Mascota::with('propietario')->get();
        return view('linea-historial.create', compact('mascotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'motivo_visita' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'mascota_id' => 'required|exists:mascotas,id',
        ], [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'motivo_visita.required' => 'El motivo de visita es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'mascota_id.required' => 'Debe seleccionar una mascota.',
            'mascota_id.exists' => 'La mascota seleccionada no existe.',
        ]);

        try {
            LineaHistorial::create($validated);
            return redirect()->route('linea-historial.index')
                ->with('success', 'Línea de historial creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear la línea de historial: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(LineaHistorial $lineaHistorial)
    {
        $lineaHistorial->load('mascota.propietario');
        return view('linea-historial.show', compact('lineaHistorial'));
    }

    public function edit(LineaHistorial $lineaHistorial)
    {
        $mascotas = Mascota::with('propietario')->get();
        return view('linea-historial.edit', compact('lineaHistorial', 'mascotas'));
    }

    public function update(Request $request, LineaHistorial $lineaHistorial)
    {
        $validated = $request->validate([
            'fecha' => 'required|date',
            'motivo_visita' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'mascota_id' => 'required|exists:mascotas,id',
        ], [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser válida.',
            'motivo_visita.required' => 'El motivo de visita es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'mascota_id.required' => 'Debe seleccionar una mascota.',
            'mascota_id.exists' => 'La mascota seleccionada no existe.',
        ]);

        try {
            $lineaHistorial->update($validated);
            return redirect()->route('linea-historial.index')
                ->with('success', 'Línea de historial actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la línea de historial: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(LineaHistorial $lineaHistorial)
    {
        try {
            $lineaHistorial->delete();
            return redirect()->route('linea-historial.index')
                ->with('success', 'Línea de historial eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar la línea de historial: ' . $e->getMessage());
        }
    }
}