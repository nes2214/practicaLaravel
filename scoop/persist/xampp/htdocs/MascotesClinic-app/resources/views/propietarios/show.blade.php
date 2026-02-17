@extends('layouts.app')

@section('title', 'Detalle Propietario')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('propietarios.index') }}" class="text-sm text-teal-600 hover:underline">← Volver</a>
            <h1 class="text-2xl font-semibold text-gray-800 mt-2">Detalle del propietario</h1>
        </div>

        {{-- Datos del propietario --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-start">
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Nombre</p>
                        <p class="text-gray-800 font-medium">{{ $propietario->nom }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Email</p>
                        <p class="text-gray-800">{{ $propietario->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Móvil</p>
                        <p class="text-gray-800">{{ $propietario->movil }}</p>
                    </div>
                </div>
                <a href="{{ route('propietarios.edit', $propietario) }}"
                   class="text-xs bg-teal-50 hover:bg-teal-100 text-teal-700 px-3 py-1.5 rounded-md transition duration-150">
                    Editar
                </a>
            </div>
        </div>

        {{-- Mascotas del propietario --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-sm font-semibold text-gray-700">🐾 Mascotas</h2>
                <span class="text-xs text-gray-400">{{ $propietario->mascotas->count() }} registradas</span>
            </div>

            @if($propietario->mascotas->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <p class="text-sm">Este propietario no tiene mascotas registradas.</p>
                </div>
            @else
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Especie</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Raza</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Historial</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($propietario->mascotas as $mascota)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $mascota->nom }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $mascota->especie ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $mascota->raza ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-teal-100 text-teal-700 text-xs font-medium px-2 py-1 rounded-full">
                                        {{ $mascota->lineasHistorial->count() }} registros
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

    </div>
</div>
@endsection