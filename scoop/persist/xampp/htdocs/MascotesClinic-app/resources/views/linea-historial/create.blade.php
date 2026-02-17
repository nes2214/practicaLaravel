@extends('layouts.app')

@section('title', 'Añadir Registro')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-xl mx-auto">

        <div class="mb-8">
            <a href="javascript:history.back()" class="text-sm text-teal-600 hover:underline">← Volver</a>
            <h1 class="text-2xl font-semibold text-gray-800 mt-2">Nuevo registro clínico</h1>
            <p class="text-sm text-gray-500 mt-1">Añade una entrada al historial de la mascota</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('linea-historial.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mascota</label>
                    <select name="mascota_id"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                        <option value="">Selecciona una mascota</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}"
                                {{ (old('mascota_id', request('mascota_id')) == $mascota->id) ? 'selected' : '' }}>
                                {{ $mascota->nom }} — {{ $mascota->propietario->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('mascota_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                    @error('fecha')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motivo de visita</label>
                    <input type="text" name="motivo_visita" value="{{ old('motivo_visita') }}"
                           placeholder="Ej: Revisión anual, vacunación..."
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                    @error('motivo_visita')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                    <textarea name="descripcion" rows="4"
                              placeholder="Describe los detalles de la visita..."
                              class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition resize-none">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition duration-200">
                        Guardar registro
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection