@extends('layouts.app')

@section('title', 'Mascotas')

@section('content')
    <div class="min-h-screen bg-gray-50 p-8">
        <div class="max-w-5xl mx-auto">

            <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Mascotas</h1>
            <p class="text-sm text-gray-500 mt-1">Gestión de mascotas registradas</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('linea-historial.create') }}"
            class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium px-4 py-2 rounded-lg transition duration-200">
                + Añadir historial
            </a>    
        </div>
        </div>
        
        {{-- Buscador --}}
        <form method="GET" action="{{ route('mascotas.index') }}" class="mb-6 flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Buscar por nombre..."
                   class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
            <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition duration-200 whitespace-nowrap">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('mascotas.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-medium px-4 py-2 rounded-lg transition duration-200 whitespace-nowrap">
                    ✕ Limpiar
                </a>
            @endif
        </form>

        @if($mascotas->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">🐾</p>
                <p class="text-sm">
                    {{ request('search') ? 'No se encontraron mascotas con ese nombre.' : 'No hay mascotas registradas todavía.' }}
                </p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Propietario</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Historial</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($mascotas as $mascota)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-gray-400">{{ $mascota->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $mascota->nom }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('propietarios.show', $mascota->propietario) }}"
                                       class="text-teal-600 hover:underline">
                                        {{ $mascota->propietario->nom }}
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-teal-100 text-teal-700 text-xs font-medium px-2 py-1 rounded-full">
                                        {{ $mascota->lineasHistorial->count() }} registros
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">

                                        <a href="{{ route('mascotas.edit', $mascota) }}"
                                           class="text-xs bg-teal-50 hover:bg-teal-100 text-teal-700 px-3 py-1.5 rounded-md transition duration-150">
                                            Editar
                                        </a>
                                        <form action="{{ route('mascotas.destroy', $mascota) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar esta mascota?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-xs bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-md transition duration-150">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $mascotas->links() }}
            </div>
        @endif

    </div>
</div>
@endsection