<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Usuario - {{ config('app.name', 'Autoviaje') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] font-sans antialiased min-h-screen flex flex-col">
    @include('partials.alerts')

    <!-- Top Navigation -->
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
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Exportar
                        </a>
                        @if(auth()->user()->es_admin)
                            <a href="{{ route('users.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-[#f53003] text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                Usuarios
                            </a>
                        @endif
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
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Editar Usuario</h1>
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Actualiza la información de la cuenta.
                    </p>
                </div>
                <a href="{{ route('users.index') }}"
                    class="text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] dark:text-[#A1A09A] dark:hover:text-[#EDEDEC] transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Volver a la lista
                </a>
            </div>

            <!-- Form Card -->
            <div
                class="bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                <form action="{{ route('users.update', $user) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div>
                            <label for="username"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Nombre de
                                Usuario</label>
                            <input type="text" name="username" id="username" required
                                value="{{ old('username', $user->username) }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: JSMPEREZ">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Contraseña
                                (Dejar en blanco para no cambiar)</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all"
                                placeholder="••••••••">
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label for="nombre"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Nombres</label>
                            <input type="text" name="nombre" id="nombre" required
                                value="{{ old('nombre', $user->nombre) }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: JUAN SAMUEL">
                        </div>

                        <!-- Apellido -->
                        <div>
                            <label for="apellido"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Apellidos</label>
                            <input type="text" name="apellido" id="apellido" required
                                value="{{ old('apellido', $user->apellido) }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: PEREZ GARCIA">
                        </div>

                        <!-- Fecha Nacimiento -->
                        <div>
                            <label for="fecha_nacimiento"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Fecha de
                                Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $user->fecha_nacimiento ? $user->fecha_nacimiento->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="activo"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Estado</label>
                            <select name="activo" id="activo" required
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                                <option value="1" {{ old('activo', $user->activo) == '1' ? 'selected' : '' }}>Activo
                                </option>
                                <option value="0" {{ old('activo', $user->activo) == '0' ? 'selected' : '' }}>Inactivo
                                </option>
                            </select>
                        </div>

                        <!-- Rol -->
                        <div>
                            <label for="es_admin"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Rol del
                                Sistema</label>
                            <select name="es_admin" id="es_admin" required
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                                <option value="0" {{ old('es_admin', $user->es_admin) == '0' ? 'selected' : '' }}>Usuario
                                    Estándar</option>
                                <option value="1" {{ old('es_admin', $user->es_admin) == '1' ? 'selected' : '' }}>
                                    Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A] flex justify-end gap-3">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-all transform active:scale-95 shadow-sm">
                            Actualizar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-white dark:bg-[#161615] border-t border-[#e3e3e0] dark:border-[#3E3E3A] py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                © {{ date('Y') }} Autoviaje. Todos los derechos reservados.
            </p>
        </div>
    </footer>
</body>

</html>