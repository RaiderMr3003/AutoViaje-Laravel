<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exportar Autorizaciones - Autoviaje</title>
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
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Inicio
                        </a>
                        <a href="{{ route('autorizaciones.create') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Nueva Autorización
                        </a>
                        <a href="{{ route('exportar.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-[#f53003] text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
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
            <div class="flex flex-col lg:flex-row gap-8">

                <!-- Sidebar Filtros -->
                <aside class="w-full lg:w-1/4">
                    <div
                        class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] p-6 sticky top-8">
                        <h2 class="text-lg font-medium mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">Exportar Datos</h2>
                        <form action="{{ route('exportar.index') }}" method="GET" class="space-y-4">
                            <div>
                                <label for="fecha_min"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Fecha
                                    Inicio</label>
                                <input type="date" name="fecha_min" id="fecha_min" value="{{ $fecha_min }}"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                            </div>
                            <div>
                                <label for="fecha_max"
                                    class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Fecha
                                    Fin</label>
                                <input type="date" name="fecha_max" id="fecha_max" value="{{ $fecha_max }}"
                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                            </div>
                            <div class="pt-2 flex flex-col gap-2">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors cursor-pointer">
                                    Aplicar Filtros
                                </button>
                                <a href="{{ route('exportar.index') }}"
                                    class="block text-center text-xs text-[#706f6c] hover:underline">Limpiar Filtros</a>
                            </div>
                        </form>
                    </div>
                </aside>

                <!-- Tabla Resultados -->
                <div class="w-full lg:w-3/4">
                    <div
                        class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] flex justify-between items-center bg-[#FAFAFA] dark:bg-[#1C1C1C]">
                            <h2 class="font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Resultados de Búsqueda</h2>
                            <div class="flex items-center gap-4">
                                <span
                                    class="text-xs px-2 py-1 bg-[#F0F0F0] dark:bg-[#2C2C2C] rounded text-[#706f6c] dark:text-[#A1A09A] whitespace-nowrap">
                                    {{ $autorizaciones->total() }} registros
                                </span>
                                <a href="{{ route('exportar.download', request()->query()) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-[#107c41] hover:bg-[#0d6335] text-white rounded text-xs font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Exportar Excel
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead
                                    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#706f6c] dark:text-[#A1A09A] border-b border-[#e3e3e0] dark:border-[#3E3E3A] uppercase text-xs font-medium">
                                    <tr>
                                        <th class="px-6 py-3">N° Crono</th>
                                        <th class="px-6 py-3">Participantes</th>
                                        <th class="px-6 py-3">Tipo Permiso</th>
                                        <th class="px-6 py-3">Fecha</th>
                                        <th class="px-6 py-3">Destino</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                                    @forelse($autorizaciones as $auth)
                                        <tr
                                            class="hover:bg-[#FAFAFA] dark:hover:bg-[#1C1C1C] transition-colors group uppercase">
                                            <td class="px-6 py-4 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                                {{ $auth->nro_kardex }}
                                            </td>
                                            <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A]">
                                                <ul class="list-disc list-inside text-xs">
                                                    @foreach($auth->personas as $persona)
                                                        <li>{{ $persona->nombres }} {{ $persona->apellidos }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $auth->tipoPermiso->des_tppermi ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A] whitespace-nowrap">
                                                {{ $auth->fecha_ingreso ? $auth->fecha_ingreso->format('d/m/Y') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A]">
                                                {{ $auth->viaja_a ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-12 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                                <p class="mb-1">No se encontraron resultados.</p>
                                                <p class="text-xs">Intenta ajustar los filtros de búsqueda.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if($autorizaciones->hasPages())
                            <div
                                class="px-6 py-4 border-t border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FAFAFA] dark:bg-[#1C1C1C]">
                                {{ $autorizaciones->withQueryString()->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>