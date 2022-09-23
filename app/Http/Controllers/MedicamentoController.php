<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Medicamento;
use App\Medicamento_morbido;
use Illuminate\Support\Arr;

class MedicamentoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
        $this->middleware('auth');
    }

    public function VerMedicamentoPaciente(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user',Auth::id())->first();
        if($paciente){
            $medicamentos = \App\Medicamento_morbido::where('id_paciente',$request->id_paciente)->with('medicamento')->get();
            //dd($medicamentos);
            return DataTables::of($medicamentos)
            ->addColumn('nombre_medicamento', function (Medicamento_morbido $medicamento) {
                return $medicamento->medicamento->nombre_medicamento;
            })
            ->addColumn('accion', function (Medicamento_morbido $medicamento) {
                return "<a href='#' onclick='editar(".$medicamento['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
                <a href='#' onclick='eliminar(".$medicamento['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
            })
            ->rawColumns(['nombre_medicamento', 'accion'])
            ->toJson();
        }
        $medicamento = new \App\Medicamento();
        $medicamentos = collect($medicamento);

        return DataTables::of($medicamentos)->toJson();
    }

    public function AgregarMedicamentoMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $medicamento = \App\Medicamento::where('nombre_medicamento', ucfirst(strtolower($request->nombre_medicamento)))->where('id_user', Auth::id())->first();
            if(!$medicamento){
                $medicamento = new \App\Medicamento();
                $medicamento->id_user = Auth::id();
                $medicamento->nombre_medicamento = ucfirst(strtolower($request->nombre_medicamento));
                $medicamento->save();
            }
            else{
                $enf = \App\Medicamento_morbido::where('id_medicamento', $medicamento->id)->where('id_paciente', $request->id_paciente)->first();
                if($enf){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'La medicamento ingresada ya esta asociada a este paciente');

                    return response()->json($regreso);
                }
            }
            $enf2 = new \App\Medicamento_morbido();
            $enf2->id_paciente = $request->id_paciente;
            $enf2->id_medicamento = $medicamento->id;
            $enf2->comentario = $request->comentario;
            $enf2->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El medicamento fue agregada satisfactoriamente');
            return response()->json($regreso);
        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al agregar el medicamento');

        return response()->json($regreso);

    }

    public function EditarMedicamentoMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $medicamento = \App\Medicamento_morbido::where('id', $request->id_medicamento)->where('id_paciente', $request->id_paciente)->first();
            if($medicamento){
                $medicamento->comentario = $request->comentario;
                $medicamento->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El medicamento fue editada satisfactoriamente');
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El medicamento no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function getMedicamentoMorbido($id, $paciente){

        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $medicamento = \App\Medicamento_morbido::where('id', $id)->where('id_paciente', $paciente)->with('medicamento')->first();
            if($medicamento){
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El medicamento fue editada satisfactoriamente');
                $regreso = Arr::add($regreso, 'medicamento', $medicamento);
                return response()->json($regreso);
            }
            else{

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El medicamento no fue encontrada');

            return response()->json($regreso);

            }

        }
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar el paciente');

        return response()->json($regreso);

    }

    public function EliminarMedicamento(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $medicamento = \App\Medicamento_morbido::where('id_paciente', $request->id_paciente)->where('id',$request->id_medicamento)->first();
                if($medicamento){
                    $medicamento->delete();
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'true');
                    $regreso = Arr::add($regreso, 'mensaje', 'El medicamento fue eliminado satisfactoriamente');
                    return response()->json($regreso);
                }
                else{
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Este paciente ya no tenian asociada este medicamento');
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
