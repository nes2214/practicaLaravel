<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MascotesClinic')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen font-sans">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-lg font-semibold text-teal-700 tracking-tight">MascotesClinic</span>
            <ul class="flex gap-1">
                <li>
                    <a href="{{ route('propietarios.index') }}"
                       class="text-sm text-gray-600 hover:text-teal-700 hover:bg-teal-50 px-4 py-2 rounded-lg transition duration-150">
                        Propietarios
                    </a>
                </li>
                <li>
                    <a href="{{ route('mascotas.index') }}"
                       class="text-sm text-gray-600 hover:text-teal-700 hover:bg-teal-50 px-4 py-2 rounded-lg transition duration-150">
                        Mascotas
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Alertas globales --}}
    <div class="max-w-6xl mx-auto px-6 mt-4">
        @if(session('success'))
            <div class="bg-teal-50 border border-teal-200 text-teal-700 px-4 py-3 rounded-lg text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                ✗ {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Contenido --}}
    <main>
        @yield('content')
    </main>

</body>
</html>