<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autorizacion;
use App\Models\TipoPermiso;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Autorizacion::with(['tipoPermiso', 'personas']);

        // Filtros
        if ($request->filled('tipo_permiso')) {
            $query->where('id_tppermi', $request->tipo_permiso);
        }

        if ($request->filled('nro_crono')) {
            $query->where('nro_kardex', 'like', '%' . $request->nro_crono . '%');
        }

        if ($request->filled('encargado')) {
            $query->where('encargado', 'like', '%' . $request->encargado . '%');
        }

        if ($request->filled('nombre_participante')) {
            $query->whereHas('personas', function ($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->nombre_participante . '%')
                    ->orWhere('apellidos', 'like', '%' . $request->nombre_participante . '%');
            });
        }

        if ($request->filled('fecha_min')) {
            $query->whereDate('fecha_ingreso', '>=', $request->fecha_min);
        }

        if ($request->filled('fecha_max')) {
            $query->whereDate('fecha_ingreso', '<=', $request->fecha_max);
        }

        // Ordenamiento (Legacy logic replication)
        $autorizaciones = $query->orderByRaw("CASE WHEN nro_kardex IS NULL OR TRIM(nro_kardex) = '' THEN 1 ELSE 2 END ASC")
            ->orderBy('fecha_ingreso', 'desc')
            ->orderByRaw('CAST(nro_kardex AS UNSIGNED) DESC')
            ->orderBy('nro_kardex', 'desc')
            ->paginate(10);

        $permisos = TipoPermiso::all();

        return view('Pages.home', compact('autorizaciones', 'permisos'));
    }
}
