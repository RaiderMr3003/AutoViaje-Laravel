<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo Usuario - {{ config('app.name', 'Autoviaje') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col min-h-screen font-sans antialiased">
    @include('partials.alerts')

    <!-- Top Navigation -->
    <nav class="bg-white dark:bg-[#161615] border-b border-[#e3e3e0] dark:border-[#3E3E3A] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo"
                            class="h-8 w-auto dark:hidden transition-transform group-hover:scale-105">
                        <img src="{{ asset('img/logo-dark.svg') }}" alt="Logo"
                            class="h-8 w-auto hidden dark:block transition-transform group-hover:scale-105">
                        <span
                            class="text-lg font-semibold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC] group-hover:text-[#f53003] dark:group-hover:text-[#FF4433] transition-colors">Autoviaje</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Nuevo Usuario</h1>
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Crea una nueva cuenta de acceso al
                        sistema.</p>
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
                <form action="{{ route('users.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        <div>
                            <label for="username"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Nombre de
                                Usuario</label>
                            <input type="text" name="username" id="username" required value="{{ old('username') }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: JSMPEREZ">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Contraseña</label>
                            <input type="password" name="password" id="password" required
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all"
                                placeholder="••••••••">
                        </div>

                        <!-- Nombre -->
                        <div>
                            <label for="nombre"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Nombres</label>
                            <input type="text" name="nombre" id="nombre" required value="{{ old('nombre') }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: JUAN SAMUEL">
                        </div>

                        <!-- Apellido -->
                        <div>
                            <label for="apellido"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Apellidos</label>
                            <input type="text" name="apellido" id="apellido" required value="{{ old('apellido') }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all uppercase"
                                placeholder="EJ: PEREZ GARCIA">
                        </div>

                        <!-- Fecha Nacimiento -->
                        <div>
                            <label for="fecha_nacimiento"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Fecha de
                                Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento') }}"
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="activo"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Estado</label>
                            <select name="activo" id="activo" required
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                                <option value="1" {{ old('activo', '1') == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('activo') == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <!-- Rol -->
                        <div>
                            <label for="es_admin"
                                class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-2">Rol del
                                Sistema</label>
                            <select name="es_admin" id="es_admin" required
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all">
                                <option value="0" {{ old('es_admin', '0') == '0' ? 'selected' : '' }}>Usuario Estándar
                                </option>
                                <option value="1" {{ old('es_admin') == '1' ? 'selected' : '' }}>Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-[#e3e3e0] dark:border-[#3E3E3A] flex justify-end gap-3">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-2.5 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-all transform active:scale-95 shadow-sm">
                            Guardar Usuario
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