@extends('layouts.app')

@section('title', 'Propietarios')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Propietarios</h1>
                <p class="text-sm text-gray-500 mt-1">Gestión de propietarios registrados</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg mb-6 text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm">
                ✗ {{ session('error') }}
            </div>
        @endif

        @if($propietarios->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">🐾</p>
                <p class="text-sm">No hay propietarios registrados todavía.</p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Móvil</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mascotas</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($propietarios as $propietario)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-gray-400">{{ $propietario->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $propietario->nom }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $propietario->email }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $propietario->movil }}</td>
                                <td class="px-4 py-4">
                                    <span class="bg-teal-100 text-teal-700 text-xs font-medium px-2 py-1 rounded-full">
                                        {{ $propietario->mascotas->count() }} mascotas
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('propietarios.show', $propietario) }}"
                                           class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1.5 rounded-md transition duration-150">
                                            Ver
                                        </a>
                                        <a href="{{ route('propietarios.edit', $propietario) }}"
                                           class="text-xs bg-teal-50 hover:bg-teal-100 text-teal-700 px-3 py-1.5 rounded-md transition duration-150">
                                            Editar
                                        </a>
                                        <form action="{{ route('propietarios.destroy', $propietario) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar este propietario?')">
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
                {{ $propietarios->links() }}
            </div>
        @endif
    </div>
</div>
@endsection