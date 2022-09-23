<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Enfermedad;
use App\Enfermedad_morbido;
use Illuminate\Support\Arr;


class EnfermedadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
    }


    public function VerEnfermedadPaciente(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user',Auth::id())->first();
        if($paciente){
            $enfermedades = \App\Enfermedad_morbido::where('id_paciente',$request->id_paciente)->with('enfermedad')->get();
            //dd($enfermedades);
            return DataTables::of($enfermedades)
            ->addColumn('nombre_enfermedad', function (Enfermedad_morbido $enfermedad) {
                return $enfermedad->enfermedad->nombre_enfermedad;
            })
            ->addColumn('accion', function (Enfermedad_morbido $enfermedad) {
                return "<a href='#' onclick='editar(".$enfermedad['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
                <a href='#' onclick='eliminar(".$enfermedad['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
            })
            ->rawColumns(['nombre_enfermedad', 'accion'])
            ->toJson();
        }
        $enfermedad = new \App\Enfermedad();
        $enfermedades = collect($enfermedad);

        return DataTables::of($enfermedades)->toJson();
    }

    public function AgregarEnfermedadMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $enfermedad = \App\Enfermedad::where('nombre_enfermedad', ucfirst(strtolower($request->nombre_enfermedad)))->where('id_user', Auth::id())->first();
            if(!$enfermedad){
                $enfermedad = new \App\Enfermedad();
                $enfermedad->id_user = Auth::id();
                $enfermedad->nombre_enfermedad = ucfirst(strtolower($request->nombre_enfermedad));
                $enfermedad->save();
            }
            else{
                $enf = \App\Enfermedad_morbido::where('id_enfermedad', $enfermedad->id)->where('id_paciente', $request->id_paciente)->first();
                if($enf){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad ingresada ya esta asociada a este paciente');

                    return response()->json($regreso);
                }
            }
            $enf2 = new \App\Enfermedad_morbido();
            $enf2->id_paciente = $request->id_paciente;
            $enf2->id_enfermedad = $enfermedad->id;
            $enf2->comentario = $request->comentario;
            $enf2->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad fue agregada satisfactoriamente');
            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al agregar la enfermedad');

        return response()->json($regreso);

    }

    public function EditarEnfermedadMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $enfermedad = \App\Enfermedad_morbido::where('id', $request->id_enfermedad)->where('id_paciente', $request->id_paciente)->first();
            if($enfermedad){
                $enfermedad->comentario = $request->comentario;
                $enfermedad->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad fue editada satisfactoriamente');
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function getEnfermedadMorbido($id, $paciente){

        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $enfermedad = \App\Enfermedad_morbido::where('id', $id)->where('id_paciente', $paciente)->with('enfermedad')->first();
            if($enfermedad){
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad fue editada satisfactoriamente');
                $regreso = Arr::add($regreso, 'enfermedad', $enfermedad);
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function EliminarEnfermedad(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $enfermedad = \App\Enfermedad_morbido::where('id_paciente', $request->id_paciente)->where('id',$request->id_enfermedad)->first();
                if($enfermedad){
                    $enfermedad->delete();
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'true');
                    $regreso = Arr::add($regreso, 'mensaje', 'La enfermedad fue eliminada satisfactoriamente');
                    return response()->json($regreso);
                }
                else{
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Este paciente ya no tenian asociada esta enfermedad');
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
