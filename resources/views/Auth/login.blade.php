<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col font-sans antialiased">
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <div class="mb-8">
                        <h1 class="mb-2 text-2xl font-medium tracking-tight text-[#1b1b18] dark:text-[#EDEDEC]">
                            Bienvenido a Autoviaje!
                        </h1>
                        <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            Por favor ingresa tus credenciales de acceso.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Usuario</label>
                            <input 
                                type="text" 
                                name="username" 
                                id="username" 
                                value="{{ old('username') }}"
                                required 
                                autofocus
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all"
                                placeholder="Tu nombre de usuario"
                                autocomplete="off"
                            >
                            @error('username')
                                <p class="mt-2 text-sm text-[#f53003] dark:text-[#FF4433]">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Contraseña</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required 
                                class="w-full px-4 py-2.5 bg-[#FDFDFC] dark:bg-[#0a0a0a] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#1b1b18] dark:text-[#EDEDEC] placeholder:text-[#706f6c] focus:outline-none focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:border-transparent transition-all"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-[#f53003] dark:text-[#FF4433]">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="w-full px-5 py-2.5 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1b1b18] dark:focus:ring-[#EDEDEC]">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-[#fcfcfc] dark:bg-[#0a0a0a] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center p-12">
                     <img src="{{ asset('img/logo.svg') }}" alt="Logo de Autoviaje" class="w-full h-auto object-contain block dark:hidden drop-shadow-md">
                     <img src="{{ asset('img/logo-dark.svg') }}" alt="Logo de Autoviaje" class="w-full h-auto object-contain hidden dark:block drop-shadow-md">
                     <div class="absolute inset-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] pointer-events-none"></div>
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </body>
</html>