<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Autorización - Autoviaje</title>
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
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-[#f53003] text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
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
    <main class="flex-grow py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                <div class="px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FAFAFA] dark:bg-[#1C1C1C]">
                    <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Registrar Autorización de Viaje
                    </h2>
                </div>

                <form action="{{ route('autorizaciones.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Nro Control & Tipo Permiso -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nro_kardex"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">N°
                                Control</label>
                            <input type="text" name="nro_kardex" id="nro_kardex" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                        </div>
                        <div>
                            <label for="id_tppermi"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Tipo de
                                Permiso</label>
                            <select name="id_tppermi" id="id_tppermi" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                                <option value="">Seleccione</option>
                                @foreach($permisos as $permiso)
                                    <option value="{{ $permiso->id_tppermi }}">{{ $permiso->des_tppermi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Fecha & Destino -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fecha_ingreso"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Fecha de
                                Ingreso</label>
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ date('Y-m-d') }}"
                                disabled
                                class="w-full px-3 py-2 bg-[#f5f5f5] dark:bg-[#2C2C2C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#a1a09a] cursor-not-allowed">
                        </div>
                        <div>
                            <label for="viaja_a"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Viaja
                                a</label>
                            <input type="text" name="viaja_a" id="viaja_a" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                        </div>
                    </div>

                    <!-- Transporte -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="id_tptrans"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Medio de
                                Transporte</label>
                            <select name="id_tptrans" id="id_tptrans" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                                <option value="">Seleccione</option>
                                @foreach($tiposTransporte as $transporte)
                                    <option value="{{ $transporte->id_tptrans }}">{{ $transporte->des_tptrans }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tiempo_viaje"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Tiempo de
                                Viaje</label>
                            <input type="text" name="tiempo_viaje" id="tiempo_viaje" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                        </div>
                    </div>
                    <div>
                        <label for="agencia_transporte"
                            class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Agencia de
                            Transporte (Opcional)</label>
                        <input type="text" name="agencia_transporte" id="agencia_transporte"
                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                    </div>


                    <!-- Section Separator for Extra Data (Hidden in legacy but implemented here for completeness if needed later) -->
                    <!-- Used a simple divider for now, keeping fields hidden to match legacy behavior unless requested -->

                    <div x-data="{ showExtras: false }" class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-4">
                        <button type="button" @click="showExtras = !showExtras"
                            class="text-sm text-[#f53003] hover:underline focus:outline-none mb-4 flex items-center">
                            <span
                                x-text="showExtras ? 'Ocultar Datos Adicionales (Acompañante/Responsable)' : 'Mostrar Datos Adicionales (Acompañante/Responsable)'"></span>
                        </button>

                        <div x-show="showExtras" class="space-y-6" style="display: none;">
                            <!-- Acompañante -->
                            <div>
                                <h3 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-3">Datos del
                                    Acompañante</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Tipo
                                            Documento</label>
                                        <select name="id_tpdoc_acomp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                            <option value="10">Seleccione (Default)</option>
                                            @foreach($tiposDocumento as $doc)
                                                <option value="{{ $doc->id_tpdoc }}">{{ $doc->des_tpdoc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">N°
                                            Documento</label>
                                        <input type="text" name="num_doc_acomp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Nombres</label>
                                        <input type="text" name="nombres_acomp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Apellidos</label>
                                        <input type="text" name="apellidos_acomp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                </div>
                            </div>

                            <!-- Responsable -->
                            <div>
                                <h3 class="text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-3">Datos del
                                    Responsable</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Tipo
                                            Documento</label>
                                        <select name="id_tpdoc_resp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                            <option value="10">Seleccione (Default)</option>
                                            @foreach($tiposDocumento as $doc)
                                                <option value="{{ $doc->id_tpdoc }}">{{ $doc->des_tpdoc }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">N°
                                            Documento</label>
                                        <input type="text" name="num_doc_resp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Nombres</label>
                                        <input type="text" name="nombres_resp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Apellidos</label>
                                        <input type="text" name="apellidos_resp"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones -->
                    <div>
                        <label for="observaciones"
                            class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" rows="3"
                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]"></textarea>
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <a href="{{ route('home') }}"
                            class="px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm font-medium text-[#706f6c] hover:bg-[#FDFDFC] transition-colors">Cancelar</a>
                        <button type="submit"
                            class="px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors cursor-pointer">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>