<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Habito;
use App\Habito_morbido;
use Illuminate\Support\Arr;

class HabitoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
        $this->middleware('auth');
    }

    public function VerHabitoPaciente(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user',Auth::id())->first();
        if($paciente){
            $habitos = \App\Habito_morbido::where('id_paciente',$request->id_paciente)->with('habito')->get();
            //dd($habitos);
            return DataTables::of($habitos)
            ->addColumn('nombre_habito', function (Habito_morbido $habito) {
                return $habito->habito->nombre_habito;
            })
            ->addColumn('accion', function (Habito_morbido $habito) {
                return "<a href='#' onclick='editar(".$habito['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
                <a href='#' onclick='eliminar(".$habito['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
            })
            ->rawColumns(['nombre_habito', 'accion'])
            ->toJson();
        }
        $habito = new \App\Habito();
        $habitos = collect($habito);

        return DataTables::of($habitos)->toJson();
    }

    public function AgregarHabitoMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $habito = \App\Habito::where('nombre_habito', ucfirst(strtolower($request->nombre_habito)))->where('id_user', Auth::id())->first();
            if(!$habito){
                $habito = new \App\Habito();
                $habito->id_user = Auth::id();
                $habito->nombre_habito = ucfirst(strtolower($request->nombre_habito));
                $habito->save();
            }
            else{
                $enf = \App\Habito_morbido::where('id_habito', $habito->id)->where('id_paciente', $request->id_paciente)->first();
                if($enf){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'La habito ingresada ya esta asociada a este paciente');

                    return response()->json($regreso);
                }
            }
            $enf2 = new \App\Habito_morbido();
            $enf2->id_paciente = $request->id_paciente;
            $enf2->id_habito = $habito->id;
            $enf2->comentario = $request->comentario;
            $enf2->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El habito fue agregada satisfactoriamente');
            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al agregar el habito');

        return response()->json($regreso);

    }

    public function EditarHabitoMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $habito = \App\Habito_morbido::where('id', $request->id_habito)->where('id_paciente', $request->id_paciente)->first();
            if($habito){
                $habito->comentario = $request->comentario;
                $habito->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El habito fue editada satisfactoriamente');
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El habito no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function getHabitoMorbido($id, $paciente){

        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $habito = \App\Habito_morbido::where('id', $id)->where('id_paciente', $paciente)->with('habito')->first();
            if($habito){
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El habito fue editada satisfactoriamente');
                $regreso = Arr::add($regreso, 'habito', $habito);
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El habito no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function EliminarHabito(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $habito = \App\Habito_morbido::where('id_paciente', $request->id_paciente)->where('id',$request->id_habito)->first();
                if($habito){
                    $habito->delete();
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'true');
                    $regreso = Arr::add($regreso, 'mensaje', 'El habito fue eliminado satisfactoriamente');
                    return response()->json($regreso);
                }
                else{
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Este paciente ya no tenian asociada este habito');
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
