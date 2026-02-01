<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Autoviaje') }} - Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] font-sans antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-white dark:bg-[#161615]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center gap-3">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 group transition-all">
                            <img src="{{ asset('img/logo.svg') }}" class="h-8 w-auto dark:hidden" alt="Logo">
                            <img src="{{ asset('img/logo-dark.svg') }}" class="h-8 w-auto hidden dark:block" alt="Logo">
                            <span
                                class="text-xl font-semibold tracking-tight group-hover:text-[#f53003] transition-colors">Autoviaje</span>
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-[#f53003] text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                            Inicio
                        </a>
                        <a href="{{ route('autorizaciones.create') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Nueva Autorización
                        </a>
                        <a href="{{ route('exportar.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Exportar
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors focus:outline-none cursor-pointer">
                            <div
                                class="w-8 h-8 rounded-full bg-[#FAFAFA] dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#706f6c] dark:text-[#A1A09A]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span>{{ Auth::user()->username }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-[#161615] rounded-md shadow-lg border border-[#e3e3e0] dark:border-[#3E3E3A] py-1 z-50"
                            style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-[#f53003] hover:bg-[#FAFAFA] dark:hover:bg-[#1C1C1C] transition-colors flex items-center gap-2 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.alerts')
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar Filters -->
                <div class="w-full lg:w-1/4">
                    <div
                        class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 sticky top-8">
                        <h2 class="text-lg font-medium mb-4">Filtrar Resultados</h2>
                        <form method="GET" action="{{ route('home') }}" class="space-y-4">
                            <div>
                                <label for="tipo_permiso"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Tipo de
                                    Permiso</label>
                                <select name="tipo_permiso" id="tipo_permiso"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                                    <option value="">Todos</option>
                                    @foreach($permisos as $permiso)
                                        <option value="{{ $permiso->id_tppermi }}" {{ request('tipo_permiso') == $permiso->id_tppermi ? 'selected' : '' }}>
                                            {{ $permiso->des_tppermi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="nro_crono"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">N°
                                    Cronológico</label>
                                <input type="text" name="nro_crono" id="nro_crono" value="{{ request('nro_crono') }}"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                            </div>

                            <div>
                                <label for="encargado"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Encargado</label>
                                <input type="text" name="encargado" id="encargado" value="{{ request('encargado') }}"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                            </div>

                            <div>
                                <label for="nombre_participante"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Participante</label>
                                <input type="text" name="nombre_participante" id="nombre_participante"
                                    value="{{ request('nombre_participante') }}"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label for="fecha_min"
                                        class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Desde</label>
                                    <input type="date" name="fecha_min" id="fecha_min"
                                        value="{{ request('fecha_min') }}"
                                        class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                                </div>
                                <div>
                                    <label for="fecha_max"
                                        class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Hasta</label>
                                    <input type="date" name="fecha_max" id="fecha_max"
                                        value="{{ request('fecha_max') }}"
                                        class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors cursor-pointer">
                                    Aplicar Filtros
                                </button>
                                <a href="{{ route('home') }}"
                                    class="block text-center mt-2 text-xs text-[#706f6c] hover:underline">Limpiar
                                    Filtros</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="w-full lg:w-3/4">
                    <div
                        class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] flex justify-between items-center bg-[#FAFAFA] dark:bg-[#1C1C1C]">
                            <h2 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Autorizaciones Registradas</h2>
                            <span
                                class="text-xs px-2 py-1 bg-[#F0F0F0] dark:bg-[#2C2C2C] rounded text-[#706f6c] dark:text-[#A1A09A]">{{ $autorizaciones->total() }}
                                registros</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead
                                    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#706f6c] dark:text-[#A1A09A] border-b border-[#e3e3e0] dark:border-[#3E3E3A] uppercase text-xs font-medium">
                                    <tr>
                                        <th class="px-6 py-3">N° Crono</th>
                                        <th class="px-6 py-3">Encargado</th>
                                        <th class="px-6 py-3">Participantes</th>
                                        <th class="px-6 py-3">Tipo</th>
                                        <th class="px-6 py-3">Fecha</th>
                                        <th class="px-6 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                                    @forelse($autorizaciones as $auth)
                                        <tr class="hover:bg-[#FAFAFA] dark:hover:bg-[#1C1C1C] transition-colors group">
                                            <td class="px-6 py-4 font-medium">{{ $auth->nro_kardex }}</td>
                                            <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A] first-letter:uppercase">
                                                {{ strtolower($auth->encargado) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($auth->personas->count() > 0)
                                                    <ul
                                                        class="list-disc list-inside text-xs text-[#706f6c] dark:text-[#A1A09A]">
                                                        @foreach($auth->personas->take(2) as $persona)
                                                            <li>{{ $persona->nombres }} {{ $persona->apellidos }}</li>
                                                        @endforeach
                                                        @if($auth->personas->count() > 2)
                                                            <li class="italic">+ {{ $auth->personas->count() - 2 }} más</li>
                                                        @endif
                                                    </ul>
                                                @else
                                                    <span class="text-xs italic text-[#a1a09a]">Sin participantes</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $auth->tipoPermiso->des_tppermi ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A] whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($auth->fecha_ingreso)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('autorizaciones.edit', $auth->id_autorizacion) }}"
                                                    class="text-blue-500 hover:text-blue-700 transition-colors"
                                                    title="Editar Autorización">
                                                    <svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-12 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                                <p class="mb-1">No se encontraron resultados.</p>
                                                <p class="text-xs">Intenta ajustar los filtros de búsqueda.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="px-6 py-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FAFAFA] dark:bg-[#1C1C1C]">
                            {{ $autorizaciones->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>