<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    public function index()
    {
        $propietarios = Propietario::with('mascotas')->paginate(10);
        return view('propietarios.index', compact('propietarios'));
    }

    public function create()
    {
        return view('propietarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:propietarios,email',
            'movil' => 'required|string|max:20',
        ], [
            'nom.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'email.unique' => 'Este email ya está registrado.',
            'movil.required' => 'El móvil es obligatorio.',
        ]);

        try {
            Propietario::create($validated);
            return redirect()->route('propietarios.index')
                ->with('success', 'Propietario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el propietario: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Propietario $propietario)
    {
        $propietario->load('mascotas.lineasHistorial');
        return view('propietarios.show', compact('propietario'));
    }

    public function edit(Propietario $propietario)
    {
        return view('propietarios.edit', compact('propietario'));
    }

    public function update(Request $request, Propietario $propietario)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:propietarios,email,' . $propietario->id,
            'movil' => 'required|string|max:20',
        ], [
            'nom.required' => 'El nombre es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser válido.',
            'email.unique' => 'Este email ya está registrado.',
            'movil.required' => 'El móvil es obligatorio.',
        ]);

        try {
            $propietario->update($validated);
            return redirect()->route('propietarios.index')
                ->with('success', 'Propietario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el propietario: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Propietario $propietario)
    {
        try {
            $propietario->delete();
            return redirect()->route('propietarios.index')
                ->with('success', 'Propietario eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el propietario: ' . $e->getMessage());
        }
    }
}