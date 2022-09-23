<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Etapa;
use App\Patologia_morbido;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\each;

class PatologiaController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
        $this->middleware('auth');
    }

    public function VerPatologiaPaciente(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user',Auth::id())->first();
        if($paciente){
            $patologias = \App\Patologia_morbido::where('id_paciente',$request->id_paciente)->with('patologia')->get();
            //dd($request->id_paciente);
            return DataTables::of($patologias)
            ->addColumn('nombre_patologia', function (Patologia_morbido $patologia) {
                return $patologia->patologia->nombre_patologia;
            })
            ->addColumn('accion', function (Patologia_morbido $patologia) {
                return "<a href='#' onclick='editar(".$patologia['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
                <a href='#' onclick='eliminar(".$patologia['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
            })
            ->rawColumns(['nombre_patologia', 'accion'])
            ->toJson();
        }
        $patologia = new \App\Patologia();
        $patologias = collect($patologia);

        return DataTables::of($patologias)->toJson();
    }

    public function AgregarPatologiaMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $patologia = \App\Patologia::where('nombre_patologia', ucfirst(strtolower($request->nombre_patologia)))->first();
            if(!$patologia){
                $patologia = new \App\Patologia();
                $patologia->id_user = Auth::id();
                $patologia->nombre_patologia = ucfirst(strtolower($request->nombre_patologia));
                $patologia->save();
            }
            else{
                $enf = \App\Patologia_morbido::where('id_patologia', $patologia->id)->where('id_paciente', $request->id_paciente)->first();
                if($enf){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'La patologia ingresada ya esta asociada a este paciente');

                    return response()->json($regreso);
                }
            }
            $enf2 = new \App\Patologia_morbido();
            $enf2->id_paciente = $request->id_paciente;
            $enf2->id_patologia = $patologia->id;
            $enf2->tecnica = $request->tecnica;
            $enf2->protocolo = $request->protocolo;
            $enf2->comentario = $request->comentario;
            $enf2->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia fue agregada satisfactoriamente');
            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al agregar la patologia');

        return response()->json($regreso);

    }

    public function EditarPatologiaMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $patologia = \App\Patologia_morbido::where('id', $request->id_patologia)->where('id_paciente', $request->id_paciente)->first();
            if($patologia){
                $patologia->tecnica = $request->tecnica;
                $patologia->protocolo = $request->protocolo;
                $patologia->comentario = $request->comentario;

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
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function getPatologiaMorbido($id, $paciente){

        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $patologia = \App\Patologia_morbido::where('id', $id)->where('id_paciente', $paciente)->with('patologia')->first();
            if($patologia){
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'La patologia fue editada satisfactoriamente');
                $regreso = Arr::add($regreso, 'patologia', $patologia);
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'La patologia no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function EliminarPatologia(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $patologia = \App\Patologia_morbido::where('id_paciente', $request->id_paciente)->where('id',$request->id_patologia)->first();
                if($patologia){
                    $patologia->delete();
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
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar los datos a eliminar');
            return response()->json($regreso);
        }
    }
}
