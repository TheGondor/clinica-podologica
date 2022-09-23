<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Examen;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ExamenController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('activo');
    }

    public function EditarExamen(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $examen = \App\Examen::where('id', $request->id_examen)->where('id_paciente',$request->id_paciente)->first();
            if($examen){
                $examen->pulso_radial = $request->pulso_radial;
                $examen->pa = $request->pa;
                $examen->pulso_pedio_d = $request->pulso_pedio_d;
                $examen->pulso_pedio_i = $request->pulso_pedio_i;
                $examen->peso = $request->peso;
                $examen->talla = $request->talla;
                $examen->imc = $request->imc;
                $examen->amputacion = $request->amputacion;
                $examen->ubicacion = $request->ubicacion;
                $examen->calzado = $request->calzado;
                $examen->sensibilidad_d = $request->sensibilidad_d;
                $examen->sensibilidad_i = $request->sensibilidad_i;
                $examen->t_podal_d = $request->t_podal_d;
                $examen->t_podal_i = $request->t_podal_i;
                $examen->varices = $request->varices;
                $examen->herida = $request->herida;
                $examen->heridas = $request->heridas;
                $examen->tipo = $request->tipo;
                $examen->tratamiento = $request->tratamiento;
                $examen->nevo = $request->nevo;
                $examen->nevos = $request->nevos;
                $examen->macula = $request->macula;
                $examen->maculas = $request->maculas;
                $examen->fecha = $request->fecha;

                $examen->save();
                $examen->fecha2 = date('d/m/Y',strtotime($examen->fecha));

                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El examen fisico general fue editado satisfactoriamente');
                $regreso = Arr::add($regreso, 'examen', $examen);
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al encontrar el examen de este paciente');
                return response()->json($regreso);
            }


        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Los datos del paciente no concuerdan');
        return response()->json($regreso);
       }
    }

    public function AgregarExamen(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $examen = new \App\Examen();

            $examen->id_paciente = $request->id_paciente;
            $examen->pulso_radial = $request->pulso_radial;
            $examen->pa = $request->pa;
            $examen->pulso_pedio_d = $request->pulso_pedio_d;
            $examen->pulso_pedio_i = $request->pulso_pedio_i;
            $examen->peso = $request->peso;
            $examen->talla = $request->talla;
            $examen->imc = $request->imc;
            $examen->amputacion = $request->amputacion;
            $examen->ubicacion = $request->ubicacion;
            $examen->calzado = $request->calzado;
            $examen->sensibilidad_d = $request->sensibilidad_d;
            $examen->sensibilidad_i = $request->sensibilidad_i;
            $examen->t_podal_d = $request->t_podal_d;
            $examen->t_podal_i = $request->t_podal_i;
            $examen->varices = $request->varices;
            $examen->herida = $request->herida;
            $examen->heridas = $request->heridas;
            $examen->tipo = $request->tipo;
            $examen->tratamiento = $request->tratamiento;
            $examen->nevo = $request->nevo;
            $examen->nevos = $request->nevos;
            $examen->macula = $request->macula;
            $examen->maculas = $request->maculas;
            $examen->fecha = $request->fecha;

            $examen->save();
            $examen->fecha2 = date('d/m/Y',strtotime($examen->fecha));
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El examen fisico general fue agregado satisfactoriamente');
            $regreso = Arr::add($regreso, 'examen', $examen);
            return response()->json($regreso);
        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error con el examen fisico general');
        return response()->json($regreso);
       }
    }

    public function VerExamen($id, $paciente){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($paciente){
            $examen = \App\Examen::where('id', $id)->where('id_paciente',$paciente->id)->where('activo',1)->first();
            $examen->fecha2 = date('d/m/Y',strtotime($examen->fecha));

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El examen fisico general fue cargado satisfactoriamente');
            $regreso = Arr::add($regreso, 'examen', $examen);
            return response()->json($regreso);
        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al cargar el examen fisico general');
        return response()->json($regreso);
       }
    }

    public function EliminarExamen(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $examen = \App\Examen::where('id', $request->id_examen)->where('id_paciente',$request->id_paciente)->where('activo',1)->first();
            if($examen){
                $examen->activo = 0;
                $examen->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El examen fisico general fue eliminado satisfactoriamente');
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al eliminar el examen fisico general');
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

    public function VerExamenes(Request $request){
        $id = Auth::id();
        $examenes = \App\Examen::where('id_paciente', $request->id_paciente)->where('activo', 1)->orderBy('fecha', 'desc')->get();

        //dd($examenes);
        return Datatables::of($examenes)
        ->addColumn('accion', function (Examen $examen) {
            return "<a href='#' onclick='editar(".$examen['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
            <a href='#' onclick='eliminar(".$examen['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
        })
        ->rawColumns(['direccion','accion'])
        ->toJson();
    }
}
