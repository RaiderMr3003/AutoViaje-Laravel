<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorizacion;
use App\Models\TipoPermiso;
use App\Models\TipoDocumento;
use App\Models\TipoTransporte;
use App\Models\TipoRelacion;
use App\Models\Ubigeo;
use App\Models\Nacionalidad;
use App\Models\Persona;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AutorizacionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permisos = TipoPermiso::all();
        $tiposDocumento = TipoDocumento::all();
        $tiposTransporte = TipoTransporte::all();

        return view('autorizaciones.create', compact('permisos', 'tiposDocumento', 'tiposTransporte'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nro_kardex' => 'required', // id_control
            'id_tppermi' => 'required|exists:tp_permiso,id_tppermi', // tipo-permiso
            'viaja_a' => 'required',
            'tiempo_viaje' => 'required', // tiempo-de-viaje
            'id_tptrans' => 'required|exists:tp_transporte,id_tptrans', // tipo_transporte
            // Optional but present in form
            'agencia_transporte' => 'nullable',
            'observaciones' => 'nullable',

            // Companion
            'id_tpdoc_acomp' => 'nullable',
            'num_doc_acomp' => 'nullable',
            'nombres_acomp' => 'nullable',
            'apellidos_acomp' => 'nullable',

            // Responsible
            'id_tpdoc_resp' => 'nullable',
            'num_doc_resp' => 'nullable',
            'nombres_resp' => 'nullable',
            'apellidos_resp' => 'nullable',
        ]);

        // Mapping legacy fields and defaults
        $data = [
            'nro_kardex' => $request->nro_kardex,
            'encargado' => Auth::user()->username, // Using username as legacy
            'id_tppermi' => $request->id_tppermi,
            'fecha_ingreso' => Carbon::now()->toDateString(),
            'viaja_a' => $request->viaja_a,

            'id_tpdoc_acomp' => $request->id_tpdoc_acomp ?? 10,
            'num_doc_acomp' => $request->num_doc_acomp ?? '',
            'nombres_acomp' => $request->nombres_acomp ?? '',
            'apellidos_acomp' => $request->apellidos_acomp ?? '',

            'id_tpdoc_resp' => $request->id_tpdoc_resp ?? 10,
            'num_doc_resp' => $request->num_doc_resp ?? '',
            'nombres_resp' => $request->nombres_resp ?? '',
            'apellidos_resp' => $request->apellidos_resp ?? '',

            'id_tptrans' => $request->id_tptrans,
            'agencia_transporte' => $request->agencia_transporte,
            'tiempo_viaje' => $request->tiempo_viaje,
            'observaciones' => $request->observaciones,
        ];

        $autorizacion = Autorizacion::create($data);

        // Legacy redirects to edit page after create
        return redirect()->route('autorizaciones.edit', $autorizacion->id_autorizacion)
            ->with('success', 'Autorización guardada correctamente.');
    }

    public function edit($id)
    {
        $autorizacion = Autorizacion::with(['personas.representados'])->findOrFail($id);
        $permisos = TipoPermiso::all();
        $tiposDocumento = TipoDocumento::all();
        $tiposTransporte = TipoTransporte::all();

        $condiciones = TipoRelacion::all();
        $ubigeos = Ubigeo::orderBy('nom_dis', 'asc')->get();
        $nacionalidades = Nacionalidad::all();

        return view('autorizaciones.edit', compact(
            'autorizacion',
            'permisos',
            'tiposDocumento',
            'tiposTransporte',
            'condiciones',
            'ubigeos',
            'nacionalidades'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $autorizacion = Autorizacion::findOrFail($id);

        $validated = $request->validate([
            'nro_kardex' => 'required',
            'id_tppermi' => 'required|exists:tp_permiso,id_tppermi',
            'viaja_a' => 'required',
            'tiempo_viaje' => 'required',
            'id_tptrans' => 'required|exists:tp_transporte,id_tptrans',
            'agencia_transporte' => 'nullable',
            'observaciones' => 'nullable',

            'id_tpdoc_acomp' => 'nullable',
            'num_doc_acomp' => 'nullable',
            'nombres_acomp' => 'nullable',
            'apellidos_acomp' => 'nullable',

            'id_tpdoc_resp' => 'nullable',
            'num_doc_resp' => 'nullable',
            'nombres_resp' => 'nullable',
            'apellidos_resp' => 'nullable',
        ]);

        $data = [
            'nro_kardex' => $request->nro_kardex,
            'encargado' => Auth::user()->username,
            'id_tppermi' => $request->id_tppermi,
            'viaja_a' => $request->viaja_a,

            'id_tpdoc_acomp' => $request->id_tpdoc_acomp ?? 10,
            'num_doc_acomp' => $request->num_doc_acomp ?? '',
            'nombres_acomp' => $request->nombres_acomp ?? '',
            'apellidos_acomp' => $request->apellidos_acomp ?? '',

            'id_tpdoc_resp' => $request->id_tpdoc_resp ?? 10,
            'num_doc_resp' => $request->num_doc_resp ?? '',
            'nombres_resp' => $request->nombres_resp ?? '',
            'apellidos_resp' => $request->apellidos_resp ?? '',

            'id_tptrans' => $request->id_tptrans,
            'agencia_transporte' => $request->agencia_transporte,
            'tiempo_viaje' => $request->tiempo_viaje,
            'observaciones' => $request->observaciones,
        ];

        $autorizacion->update($data);

        return redirect()->route('autorizaciones.edit', $autorizacion->id_autorizacion)
            ->with('success', 'Autorización actualizada correctamente.');
    }

    public function addParticipant(Request $request, $id)
    {
        $autorizacion = Autorizacion::findOrFail($id);

        $request->validate([
            'numdoc_persona' => 'required',
            'nombre_persona' => 'required',
            'apellido_persona' => 'required',
            'condicion' => 'required', // id_tp_relacion
            'firma' => 'required',
        ]);

        $id_tp_relacion = $request->condicion;
        $id_ubigeo = $request->Ubigeo_persona;
        $direccion = $request->direccion_persona;

        // If 'Menor' (ID 1), ubigeo and address are null per legacy logic
        if ($id_tp_relacion == 1) {
            $id_ubigeo = null;
            $direccion = null;
        }

        // Find Persona by num_doc
        $persona = Persona::where('num_doc', $request->numdoc_persona)->first();

        if ($persona) {
            // Update only metadata to match legacy behavior and avoid identity collisions
            $persona->update([
                'edad' => $request->edad,
                'tipo_edad' => $request->tipo_edad,
                'id_nacionalidad' => $request->nacionalidad,
                'id_ubigeo' => $id_ubigeo,
                'direccion' => $direccion,
            ]);
        } else {
            // Create new Persona if it doesn't exist
            $persona = Persona::create([
                'num_doc' => $request->numdoc_persona,
                'id_tpdoc' => $request->documento_persona ?? 1,
                'nombres' => $request->nombre_persona,
                'apellidos' => $request->apellido_persona,
                'edad' => $request->edad,
                'tipo_edad' => $request->tipo_edad,
                'id_nacionalidad' => $request->nacionalidad,
                'id_ubigeo' => $id_ubigeo,
                'direccion' => $direccion,
            ]);
        }

        // Attach to Authorization
        if (!$autorizacion->personas->contains($persona->id_persona)) {
            $autorizacion->personas()->attach($persona->id_persona, [
                'id_tp_relacion' => $id_tp_relacion,
                'firma' => $request->firma
            ]);
        } else {
            // Update pivot data if already attached to this specific authorization
            $autorizacion->personas()->updateExistingPivot($persona->id_persona, [
                'id_tp_relacion' => $id_tp_relacion,
                'firma' => $request->firma
            ]);
        }

        // Handle Representation (Legacy relationship)
        if ($request->has('en_representacion') && $request->representante_persona) {
            $persona->representados()->syncWithoutDetaching([$request->representante_persona]);
        }

        return redirect()->back()->with('success', 'Participante añadido.');
    }

    public function removeParticipant($id, $persona_id)
    {
        $autorizacion = Autorizacion::findOrFail($id);
        $autorizacion->personas()->detach($persona_id);
        return redirect()->back()->with('success', 'Participante eliminado.');
    }

    public function updateParticipant(Request $request, $id, $persona_id)
    {
        $autorizacion = Autorizacion::findOrFail($id);
        $persona = Persona::findOrFail($persona_id);

        $id_tp_relacion = $request->condicion;
        $id_ubigeo = $request->Ubigeo_persona;
        $direccion = $request->direccion_persona;

        // If 'Menor', ubigeo and address are null per legacy logic
        if ($id_tp_relacion == 1) {
            $id_ubigeo = null;
            $direccion = null;
        }

        // Update Persona metadata (not indexable identity fields for now as per plan)
        $persona->update([
            'edad' => $request->edad,
            'tipo_edad' => $request->tipo_edad,
            'id_nacionalidad' => $request->nacionalidad,
            'id_ubigeo' => $id_ubigeo,
            'direccion' => $direccion,
        ]);

        // Update pivot info
        $autorizacion->personas()->updateExistingPivot($persona_id, [
            'id_tp_relacion' => $id_tp_relacion,
            'firma' => $request->firma
        ]);

        return redirect()->back()->with('success', 'Participante actualizado.');
    }

    /**
     * Search for a persona by document number (AJAX).
     */
    public function searchPersona($num_doc)
    {
        $persona = Persona::where('num_doc', $num_doc)->first();

        if (!$persona) {
            return response()->json(['error' => 'Persona no encontrada'], 404);
        }

        return response()->json($persona);
    }
}
