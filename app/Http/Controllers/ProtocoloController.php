<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Patologia;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProtocoloController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
    }

    public function VerProtocolos(Request $request){
        $patologias = \App\Patologia::where('activo', 1)->where('id_user', Auth::id())->get();
        //dd($request->id_paciente);
        return DataTables::of($patologias)
        ->addColumn('accion', function (Patologia $patologia) {
            return "<a href='#' onclick='editar(".$patologia['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
            <a href='#' onclick='eliminar(".$patologia['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
        })
        ->rawColumns(['accion'])
        ->toJson();

    }

    public function AgregarProtocolo(Request $request){
        $patologia = \App\Patologia::where('nombre_patologia', ucfirst(strtolower($request->nombre_patologia)))->where('id_user', Auth::id())->where('activo', 1)->first();
        if(!$patologia){
            $patologia = new \App\Patologia();
            $patologia->id_user = Auth::id();
            $patologia->nombre_patologia = ucfirst(strtolower($request->nombre_patologia));
            $patologia->protocolo= $request->protocolo;
            $patologia->save();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia fue creada satisfactoriamente');

            return response()->json($regreso);
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia ingresada ya existe');

            return response()->json($regreso);
        }

    }

    public function EditarProtocolo(Request $request){
        $patologia = \App\Patologia::where('id', $request->id_patologia)->where('id_user', Auth::id())->where('activo', 1)->first();
        if($patologia){
            $patologia->protocolo = $request->protocolo;

            $patologia->save();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia fue editada satisfactoriamente');
            return response()->json($regreso);
        }
        else{

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'La patologia no fue encontrada');

        return response()->json($regreso);

        }

    }

    public function getProtocolo(Request $request){
        $protocolo = \App\Patologia::where('id', $request->id)->where('id_user', Auth::id())->where('activo', 1)->first();
        if($protocolo){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El protocolo fue editada satisfactoriamente');
            $regreso = Arr::add($regreso, 'protocolo', $protocolo);
            return response()->json($regreso);
        }
        else{

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'La patologia no fue encontrada');

        return response()->json($regreso);

        }
    }

    public function PatologiaProtocolo(Request $request){
        $protocolo = \App\Patologia::where('nombre_patologia', ucfirst(strtolower($request->nombre_patologia)))->where('id_user', Auth::id())->where('activo', 1)->first();
        if($protocolo){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'protocolo', $protocolo->protocolo);
            return response()->json($regreso);
        }
        else{

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');

        return response()->json($regreso);

        }
    }

    public function EliminarProtocolo(Request $request){
        $patologia = \App\Patologia::where('id',$request->id_patologia)->where('id_user', Auth::id())->where('activo', 1)->first();
        if($patologia){
            $check = \App\Patologia_morbido::where('id_patologia',$request->id_patologia)->where('activo', 1)->first();
            if($check){
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'No se puede eliminar una patologia asociada a un paciente.');
                return response()->json($regreso);
            }
            $patologia->activo = 0;
            $patologia->save();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia fue eliminada satisfactoriamente');
            return response()->json($regreso);
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Este paciente ya no tenian asociada esta patologia');
            return response()->json($regreso);
        }
    }
}
