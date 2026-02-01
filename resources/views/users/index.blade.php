<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Usuarios - {{ config('app.name', 'Autoviaje') }}</title>

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
                    <div class="hidden sm:flex sm:space-x-8 h-full">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:border-[#e3e3e0] dark:hover:border-[#3E3E3A] transition-colors">Inicio</a>
                        <a href="{{ route('exportar.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] hover:border-[#e3e3e0] dark:hover:border-[#3E3E3A] transition-colors">Exportar</a>
                        @if(auth()->user()->es_admin)
                            <a href="{{ route('users.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 border-[#f53003] text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Usuarios</a>
                        @endif
                    </div>
                </div>
                <!-- User dropdown placeholder - Use same as home.blade.php -->
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
    <main class="flex-grow py-8 bg-[#FDFDFC] dark:bg-[#0a0a0a]" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Gestión de Usuarios</h1>
                    <p class="mt-1 text-sm text-[#706f6c] dark:text-[#A1A09A]">Administra las cuentas de acceso al
                        sistema.</p>
                </div>
                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-all transform active:scale-95 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Nuevo Usuario
                </a>
            </div>

            <!-- Users Table -->
            <div
                class="bg-white dark:bg-[#161615] shadow-sm rounded-lg border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                <div class="overflow-x-auto text-sm">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#FAFAFA] dark:bg-[#1C1C1C] border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                            <tr>
                                <th class="px-6 py-4 font-medium text-[#706f6c] dark:text-[#A1A09A]">Usuario</th>
                                <th class="px-6 py-4 font-medium text-[#706f6c] dark:text-[#A1A09A]">Nombre Completo
                                </th>
                                <th class="px-6 py-4 font-medium text-[#706f6c] dark:text-[#A1A09A]">Estado</th>
                                <th class="px-6 py-4 font-medium text-[#706f6c] dark:text-[#A1A09A]">Rol</th>
                                <th class="px-6 py-4 font-medium text-[#706f6c] dark:text-[#A1A09A] text-right">Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                            @forelse($users as $user)
                                <tr class="hover:bg-[#FAFAFA] dark:hover:bg-[#1C1C1C] transition-colors">
                                    <td class="px-6 py-4 font-medium text-[#1b1b18] dark:text-[#EDEDEC]">
                                        {{ $user->username }}</td>
                                    <td class="px-6 py-4 text-[#706f6c] dark:text-[#A1A09A]">{{ $user->nombre }}
                                        {{ $user->apellido }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->activo ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                                            {{ $user->activo ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->es_admin ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' }}">
                                            {{ $user->es_admin ? 'Administrador' : 'Usuario' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="text-[#f53003] dark:text-[#FF4433] hover:underline transition-colors uppercase font-bold text-xs"
                                            title="Editar">
                                            Editar
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                                x-ref="deleteForm{{ $user->username }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" @click="
                                                        Swal.fire({
                                                            title: '¿Eliminar usuario?',
                                                            text: 'Esta acción no se puede deshacer.',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#d33',
                                                            cancelButtonColor: '#3085d6',
                                                            confirmButtonText: 'Sí, eliminar',
                                                            cancelButtonText: 'Cancelar',
                                                            background: document.documentElement.classList.contains('dark') ? '#161615' : '#fff',
                                                            color: document.documentElement.classList.contains('dark') ? '#EDEDEC' : '#1b1b18'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                $event.target.closest('form').submit();
                                                            }
                                                        })
                                                    "
                                                    class="text-[#706f6c] dark:text-[#A1A09A] hover:text-[#1b1b18] dark:hover:text-[#EDEDEC] transition-colors uppercase font-bold text-xs cursor-pointer">
                                                    Eliminar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-[#706f6c] dark:text-[#A1A09A]">
                                        No hay otros usuarios registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
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