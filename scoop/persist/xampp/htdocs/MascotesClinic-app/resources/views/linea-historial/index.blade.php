@extends('layouts.app')

@section('title', 'Historial')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Historial clínico</h1>
                <p class="text-sm text-gray-500 mt-1">Registro de visitas y tratamientos</p>
            </div>
            <a href="{{ route('linea-historial.create') }}"
               class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition duration-200">
                + Nuevo registro
            </a>
        </div>

        @if($linea->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <p class="text-4xl mb-3">📋</p>
                <p class="text-sm">No hay registros en el historial todavía.</p>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mascota</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Propietario</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Motivo</th>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($linea as $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                    {{ $item->fecha->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    <a href="{{ route('mascotas.show', $item->mascota) }}"
                                       class="text-teal-600 hover:underline">
                                        {{ $item->mascota->nom }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $item->mascota->propietario->nom }}
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->motivo_visita }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('linea-historial.edit', $item) }}"
                                           class="text-xs bg-teal-50 hover:bg-teal-100 text-teal-700 px-3 py-1.5 rounded-md transition duration-150">
                                            Editar
                                        </a>
                                        <form action="{{ route('linea-historial.destroy', $item) }}" method="POST"
                                              onsubmit="return confirm('¿Eliminar este registro?')">
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
                {{ $linea->links() }}
            </div>
        @endif

    </div>
</div>
@endsection