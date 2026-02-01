<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Autorización - Autoviaje</title>
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
                            class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-[#706f6c] hover:text-[#1b1b18] hover:border-[#e3e3e0] transition-colors">
                            Exportar
                        </a>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ Auth::user()->username }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="text-sm font-medium text-[#f53003] hover:text-[#d92a02] dark:text-[#FF4433] dark:hover:text-[#ff6b5c] transition-colors focus:outline-none cursor-pointer">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @include('partials.alerts')

            <!-- Edit Form Card -->
            <div
                class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                <div
                    class="px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FAFAFA] dark:bg-[#1C1C1C] flex justify-between items-center">
                    <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Editar Autorización
                        #{{ $autorizacion->nro_kardex }}</h2>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('autorizaciones.documento', $autorizacion->id_autorizacion) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-[#005bed] hover:bg-[#005bed73] text-white text-xs font-medium rounded-md shadow-sm transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Descargar Word
                        </a>
                        <span class="text-xs text-[#706f6c]">Creado:
                            {{ $autorizacion->fecha_ingreso->format('d/m/Y') }}</span>
                    </div>
                </div>

                <form action="{{ route('autorizaciones.update', $autorizacion->id_autorizacion) }}" method="POST"
                    class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nro Control & Tipo Permiso -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nro_kardex"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">N°
                                Control</label>
                            <input type="text" name="nro_kardex" id="nro_kardex"
                                value="{{ old('nro_kardex', $autorizacion->nro_kardex) }}" required
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
                                    <option value="{{ $permiso->id_tppermi }}" {{ $autorizacion->id_tppermi == $permiso->id_tppermi ? 'selected' : '' }}>
                                        {{ $permiso->des_tppermi }}
                                    </option>
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
                            <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                                value="{{ $autorizacion->fecha_ingreso->format('Y-m-d') }}" disabled
                                class="w-full px-3 py-2 bg-[#f5f5f5] dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm text-[#a1a09a] dark:text-[#555555] cursor-not-allowed">
                        </div>
                        <div>
                            <label for="viaja_a"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Viaja
                                a</label>
                            <input type="text" name="viaja_a" id="viaja_a"
                                value="{{ old('viaja_a', $autorizacion->viaja_a) }}" required
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
                                    <option value="{{ $transporte->id_tptrans }}" {{ $autorizacion->id_tptrans == $transporte->id_tptrans ? 'selected' : '' }}>
                                        {{ $transporte->des_tptrans }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tiempo_viaje"
                                class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Tiempo de
                                Viaje</label>
                            <input type="text" name="tiempo_viaje" id="tiempo_viaje"
                                value="{{ old('tiempo_viaje', $autorizacion->tiempo_viaje) }}" required
                                class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                        </div>
                    </div>
                    <div>
                        <label for="agencia_transporte"
                            class="block text-sm font-medium mb-1 text-[#706f6c] dark:text-[#A1A09A]">Agencia de
                            Transporte (Opcional)</label>
                        <input type="text" name="agencia_transporte" id="agencia_transporte"
                            value="{{ old('agencia_transporte', $autorizacion->agencia_transporte) }}"
                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">
                    </div>

                    <!-- Section Separator for Extra Data -->
                    <div x-data="{ showExtras: false }" class="border-t border-[#e3e3e0] dark:border-[#3E3E3A] pt-4">
                        <button type="button" @click="showExtras = !showExtras"
                            class="text-sm text-[#f53003] hover:underline focus:outline-none mb-4 flex items-center">
                            <span
                                x-text="showExtras ? 'Ocultar Datos Adicionales' : 'Mostrar Datos Adicionales (Acompañante/Responsable)'"></span>
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
                                            @foreach($tiposDocumento as $doc)
                                                <option value="{{ $doc->id_tpdoc }}" {{ $autorizacion->id_tpdoc_acomp == $doc->id_tpdoc ? 'selected' : '' }}>
                                                    {{ $doc->des_tpdoc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">N°
                                            Documento</label>
                                        <input type="text" name="num_doc_acomp"
                                            value="{{ old('num_doc_acomp', $autorizacion->num_doc_acomp) }}"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Nombres</label>
                                        <input type="text" name="nombres_acomp"
                                            value="{{ old('nombres_acomp', $autorizacion->nombres_acomp) }}"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Apellidos</label>
                                        <input type="text" name="apellidos_acomp"
                                            value="{{ old('apellidos_acomp', $autorizacion->apellidos_acomp) }}"
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
                                            @foreach($tiposDocumento as $doc)
                                                <option value="{{ $doc->id_tpdoc }}" {{ $autorizacion->id_tpdoc_resp == $doc->id_tpdoc ? 'selected' : '' }}>
                                                    {{ $doc->des_tpdoc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">N°
                                            Documento</label>
                                        <input type="text" name="num_doc_resp"
                                            value="{{ old('num_doc_resp', $autorizacion->num_doc_resp) }}"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Nombres</label>
                                        <input type="text" name="nombres_resp"
                                            value="{{ old('nombres_resp', $autorizacion->nombres_resp) }}"
                                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium mb-1 text-[#706f6c]">Apellidos</label>
                                        <input type="text" name="apellidos_resp"
                                            value="{{ old('apellidos_resp', $autorizacion->apellidos_resp) }}"
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
                            class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm focus:ring-2 focus:ring-[#f53003] dark:focus:ring-[#FF4433] focus:outline-none dark:text-[#EDEDEC]">{{ old('observaciones', $autorizacion->observaciones) }}</textarea>
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <a href="{{ route('home') }}"
                            class="px-4 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm font-medium text-[#706f6c] hover:bg-[#FDFDFC] transition-colors">Cancelar</a>
                        <button type="submit"
                            class="cursor-pointer px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Participantes Section -->
            <div x-data="{ 
                openModal: false, 
                editMode: false,
                participantId: null,
                condicion: '', 
                enRepresentacion: false,
                numdoc: '',
                nombre: '',
                apellido: '',
                edad: '',
                tipoEdad: 'AÑO(S)',
                nacionalidad: '',
                ubigeo: '',
                direccion: '',
                firma: 'HUELLA',
                resetModal() {
                    this.editMode = false;
                    this.participantId = null;
                    this.numdoc = '';
                    this.nombre = '';
                    this.apellido = '';
                    this.edad = '';
                    this.tipoEdad = 'AÑO(S)';
                    this.condicion = '';
                    this.enRepresentacion = false;
                    this.ubigeo = '';
                    this.direccion = '';
                    this.firma = 'HUELLA';
                    this.nacionalidad = '';
                },
                editParticipant(p) {
                    this.resetModal();
                    this.editMode = true;
                    this.participantId = p.id_persona;
                    this.numdoc = p.num_doc;
                    this.nombre = p.nombres;
                    this.apellido = p.apellidos;
                    this.edad = p.edad;
                    this.tipoEdad = p.tipo_edad || 'AÑO(S)';
                    this.condicion = p.pivot.id_tp_relacion;
                    this.firma = p.pivot.firma;
                    this.ubigeo = p.id_ubigeo || '';
                    this.direccion = p.direccion || '';
                    this.nacionalidad = p.id_nacionalidad || '';
                    this.openModal = true;
                },
                async searchPersona() {
                    if (!this.numdoc) return;
                    try {
                        const response = await fetch(`/personas/search/${this.numdoc}`);
                        if (response.ok) {
                            const data = await response.json();
                            this.nombre = data.nombres;
                            this.apellido = data.apellidos;
                            this.edad = data.edad;
                            this.tipoEdad = data.tipo_edad || 'AÑO(S)';
                            this.nacionalidad = data.id_nacionalidad;
                            this.ubigeo = data.id_ubigeo;
                            this.direccion = data.direccion;
                            Swal.fire({
                                icon: 'success',
                                title: 'Persona encontrada',
                                text: 'Los datos se han cargado correctamente.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'No encontrado',
                                text: 'La persona no existe en la base de datos.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true
                            });
                        }
                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al realizar la búsqueda.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true
                        });
                    }
                },
                confirmDelete(id) {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Esta acción desvinculará al participante de esta autorización.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1b1b18',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });
                }
            }"
                class="bg-white dark:bg-[#161615] rounded-lg shadow-sm border border-[#e3e3e0] dark:border-[#3E3E3A] overflow-hidden">
                <div
                    class="px-6 py-4 border-b border-[#e3e3e0] dark:border-[#3E3E3A] bg-[#FAFAFA] dark:bg-[#1C1C1C] flex justify-between items-center">
                    <h2 class="text-lg font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Participantes</h2>
                    <button @click="resetModal(); openModal = true;"
                        class="px-3 py-1.5 bg-[#f53003] text-white text-xs font-medium rounded-md hover:bg-[#d92a02] transition-colors cursor-pointer">
                        Añadir Participante
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-[#FAFAFA] dark:bg-[#1C1C1C] border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
                            <tr>
                                <th class="px-6 py-3 font-medium text-[#706f6c] dark:text-[#A1A09A]">Nro. Doc</th>
                                <th class="px-6 py-3 font-medium text-[#706f6c] dark:text-[#A1A09A]">Nombre Completo
                                </th>
                                <th class="px-6 py-3 font-medium text-[#706f6c] dark:text-[#A1A09A]">Relación</th>
                                <th class="px-6 py-3 font-medium text-[#706f6c] dark:text-[#A1A09A]">Firma</th>
                                <th class="px-6 py-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e3e3e0] dark:divide-[#3E3E3A]">
                            @forelse($autorizacion->personas as $persona)
                                <tr>
                                    <td class="px-6 py-4">{{ $persona->num_doc }}</td>
                                    <td class="px-6 py-4">{{ $persona->nombres }} {{ $persona->apellidos }}</td>
                                    <td class="px-6 py-4">
                                        {{-- Relacion lookup locally --}}
                                        @foreach($condiciones as $cond)
                                            @if($cond->id_tp_relacion == $persona->pivot->id_tp_relacion)
                                                {{ $cond->descripcion }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $persona->pivot->firma }}
                                        @if($persona->representados->count() > 0)
                                            <div class="text-[10px] text-[#706f6c] mt-1 italic">
                                                En representación de:
                                                @foreach($persona->representados as $rep)
                                                    {{ $rep->nombres }} {{ $rep->apellidos }}{{ !$loop->last ? ',' : '' }}
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end items-center gap-3">
                                            <button @click="editParticipant({{ json_encode($persona) }})"
                                                class="text-blue-500 hover:text-blue-700 transition-colors cursor-pointer"
                                                title="Editar Participante">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $persona->id_persona }}"
                                                action="{{ route('autorizaciones.removeParticipant', ['id' => $autorizacion->id_autorizacion, 'persona_id' => $persona->id_persona]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" @click="confirmDelete('{{ $persona->id_persona }}')"
                                                    class="text-red-500 hover:text-red-700 transition-colors cursor-pointer"
                                                    title="Eliminar Participante">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-[#706f6c]">No hay participantes
                                        registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Add Participant Modal -->
                <div x-show="openModal" class="relative z-50" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true" style="display: none;">

                    <!-- Background backdrop, show/hide based on modal state. -->
                    <div x-show="openModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-[#0000009e] bg-opacity-50"></div>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                            <!-- Modal panel, show/hide based on modal state. -->
                            <div x-show="openModal" x-transition:enter="ease-out duration-300"
                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave="ease-in duration-200"
                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                @click.outside="openModal = false"
                                class="relative transform overflow-hidden rounded-lg bg-white dark:bg-[#161615] text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl border border-[#e3e3e0] dark:border-[#3E3E3A]">

                                <form
                                    :action="editMode ? '{{ route('autorizaciones.updateParticipant', ['id' => $autorizacion->id_autorizacion, 'persona_id' => ':id']) }}'.replace(':id', participantId) : '{{ route('autorizaciones.addParticipant', $autorizacion->id_autorizacion) }}'"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" :value="editMode ? 'PUT' : 'POST'">
                                    <div class="bg-white dark:bg-[#161615] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg leading-6 font-medium text-[#1b1b18] dark:text-[#EDEDEC] mb-4"
                                            x-text="editMode ? 'Editar Participante' : 'Añadir Participante'">
                                        </h3>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium mb-1 text-[#706f6c]">Tipo
                                                    Documento</label>
                                                <select name="documento_persona" :disabled="editMode"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC] disabled:bg-[#f5f5f5] dark:disabled:bg-[#1a1a19] disabled:text-[#a1a09a] dark:disabled:text-[#555555] disabled:cursor-not-allowed">
                                                    @foreach($tiposDocumento as $doc)
                                                        <option value="{{ $doc->id_tpdoc }}">{{ $doc->des_tpdoc }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium mb-1 text-[#706f6c]">N°
                                                    Documento</label>
                                                <div class="flex gap-2">
                                                    <input type="text" name="numdoc_persona" required x-model="numdoc"
                                                        :disabled="editMode"
                                                        class="flex-grow px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC] disabled:bg-[#f5f5f5] dark:disabled:bg-[#1a1a19] disabled:text-[#a1a09a] dark:disabled:text-[#555555] disabled:cursor-not-allowed">
                                                    <button type="button" @click="searchPersona()" x-show="!editMode"
                                                        class="px-3 py-2 bg-[#f53003] hover:bg-[#d92a02] text-white rounded-md text-xs transition-colors cursor-pointer">
                                                        Buscar
                                                    </button>
                                                </div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Nombres</label>
                                                <input type="text" name="nombre_persona" required x-model="nombre"
                                                    :disabled="editMode"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC] disabled:bg-[#f5f5f5] dark:disabled:bg-[#1a1a19] disabled:text-[#a1a09a] dark:disabled:text-[#555555] disabled:cursor-not-allowed">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Apellidos</label>
                                                <input type="text" name="apellido_persona" required x-model="apellido"
                                                    :disabled="editMode"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC] disabled:bg-[#f5f5f5] dark:disabled:bg-[#1a1a19] disabled:text-[#a1a09a] dark:disabled:text-[#555555] disabled:cursor-not-allowed">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium mb-1 text-[#706f6c]">Condición
                                                    (Relación)</label>
                                                <select name="condicion" required x-model="condicion"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                    <option value="">Seleccione</option>
                                                    @foreach($condiciones as $cond)
                                                        <option value="{{ $cond->id_tp_relacion }}">{{ $cond->descripcion }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Firma</label>
                                                <select name="firma" required x-model="firma"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                    <option value="">Seleccione</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                    <option value="HUELLA">HUELLA</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Edad</label>
                                                <input type="number" name="edad" required x-model="edad"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium mb-1 text-[#706f6c]">Tipo
                                                    Edad</label>
                                                <select name="tipo_edad" x-model="tipoEdad"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                    <option value="AÑO(S)">AÑO(S)</option>
                                                    <option value="MES(ES)">MES(ES)</option>
                                                </select>
                                            </div>

                                            <div class="md:col-span-2" x-show="condicion != '1'" x-transition>
                                                <div
                                                    class="flex items-center gap-2 mb-2 p-2 bg-[#FAFAFA] dark:bg-[#1C1C1C] rounded-md border border-[#e3e3e0] dark:border-[#3E3E3A]">
                                                    <input type="checkbox" name="en_representacion"
                                                        id="en_representacion" x-model="enRepresentacion"
                                                        class="w-4 h-4 text-[#f53003] bg-gray-100 border-gray-300 rounded focus:ring-[#f53003] dark:focus:ring-[#FF4433] dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                                    <label for="en_representacion"
                                                        class="text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] cursor-pointer">En
                                                        representación de:</label>
                                                </div>

                                                <div x-show="enRepresentacion" x-transition class="mt-2"
                                                    style="display: none;">
                                                    <select name="representante_persona"
                                                        class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                        <option value="">Seleccione al representado</option>
                                                        @foreach($autorizacion->personas as $p)
                                                            <option value="{{ $p->id_persona }}">{{ $p->nombres }}
                                                                {{ $p->apellidos }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="md:col-span-2" x-show="condicion != '1'" x-transition>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Dirección</label>
                                                <input type="text" name="direccion_persona" x-model="direccion"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                            </div>
                                            <div x-show="condicion != '1'" x-transition>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Distrito</label>
                                                <select name="Ubigeo_persona" x-model="ubigeo"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                    <option value="">Seleccione</option>
                                                    @foreach($ubigeos as $ubigeo)
                                                        <option value="{{ $ubigeo->id_ubigeo }}">
                                                            {{ $ubigeo->full_location }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div x-show="condicion != '1'" x-transition>
                                                <label
                                                    class="block text-xs font-medium mb-1 text-[#706f6c]">Nacionalidad</label>
                                                <select name="nacionalidad" x-model="nacionalidad"
                                                    class="w-full px-3 py-2 bg-transparent dark:bg-[#1C1C1C] border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm dark:text-[#EDEDEC]">
                                                    <option value="">Seleccione</option>
                                                    @foreach($nacionalidades as $nac)
                                                        <option value="{{ $nac->id_nacionalidad }}">
                                                            {{ $nac->desc_nacionalidad }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-[#FAFAFA] dark:bg-[#1C1C1C] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-[#e3e3e0] dark:border-[#3E3E3A] gap-3">
                                        <button type="submit"
                                            class="cursor-pointer w-full sm:w-auto px-4 py-2 bg-[#1b1b18] dark:bg-[#EDEDEC] text-white dark:text-[#161615] rounded-md text-sm font-medium hover:bg-black dark:hover:bg-white transition-colors duration-200">
                                            Guardar
                                        </button>
                                        <button type="button" @click="openModal = false"
                                            class="cursor-pointer mt-3 sm:mt-0 w-full sm:w-auto px-4 py-2 bg-white dark:bg-transparent border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md text-sm font-medium text-[#706f6c] hover:bg-[#FDFDFC] dark:hover:bg-[#1C1C1C] transition-colors duration-200">
                                            Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </main>
</body>

</html>