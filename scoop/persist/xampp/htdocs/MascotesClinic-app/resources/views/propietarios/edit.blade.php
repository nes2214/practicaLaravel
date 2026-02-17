@extends('layouts.app')

@section('title', 'Editar Propietario')

@section('content')
<div class="min-h-screen bg-gray-50 p-8">
    <div class="max-w-xl mx-auto">

        <div class="mb-8">
            <a href="{{ route('propietarios.index') }}" class="text-sm text-teal-600 hover:underline">← Volver</a>
            <h1 class="text-2xl font-semibold text-gray-800 mt-2">Editar propietario</h1>
            <p class="text-sm text-gray-500 mt-1">Solo puedes modificar el email y el móvil</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('propietarios.update', $propietario) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Nombre solo lectura --}}
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Nombre</label>
                    <input type="text" value="{{ $propietario->nom }}" disabled
                           class="w-full border border-gray-100 rounded-lg px-3 py-2 text-sm text-gray-400 bg-gray-50 cursor-not-allowed">
                </div>

                {{-- Email editable --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $propietario->email) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Móvil editable --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Móvil</label>
                    <input type="text" name="movil" value="{{ old('movil', $propietario->movil) }}"
                           class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition">
                    @error('movil')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium px-5 py-2 rounded-lg transition duration-200">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection