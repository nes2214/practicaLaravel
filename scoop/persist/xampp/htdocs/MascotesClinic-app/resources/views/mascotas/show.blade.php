<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Propietario;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotas = Mascota::with('propietario')->paginate(10);
        return view('mascotas.index', compact('mascotas'));
    }

    public function create()
    {
        $propietarios = Propietario::all();
        return view('mascotas.create', compact('propietarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'propietario_id' => 'required|exists:propietarios,id',
        ], [
            'nom.required' => 'El nombre es obligatorio.',
            'propietario_id.required' => 'Debe seleccionar un propietario.',
            'propietario_id.exists' => 'El propietario seleccionado no existe.',
        ]);

        try {
            Mascota::create($validated);
            return redirect()->route('mascotas.index')
                ->with('success', 'Mascota creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear la mascota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Mascota $mascota)
    {
        $mascota->load('propietario', 'lineasHistorial');
        return view('mascotas.show', compact('mascota'));
    }

    public function edit(Mascota $mascota)
    {
        $propietarios = Propietario::all();
        return view('mascotas.edit', compact('mascota', 'propietarios'));
    }

    public function update(Request $request, Mascota $mascota)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'propietario_id' => 'required|exists:propietarios,id',
        ], [
            'nom.required' => 'El nombre es obligatorio.',
            'propietario_id.required' => 'Debe seleccionar un propietario.',
            'propietario_id.exists' => 'El propietario seleccionado no existe.',
        ]);

        try {
            $mascota->update($validated);
            return redirect()->route('mascotas.index')
                ->with('success', 'Mascota actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la mascota: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Mascota $mascota)
    {
        try {
            $mascota->delete();
            return redirect()->route('mascotas.index')
                ->with('success', 'Mascota eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar la mascota: ' . $e->getMessage());
        }
    }
}