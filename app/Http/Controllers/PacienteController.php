<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Paciente;
use App\Atencion;
use App\Morbido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('activo');
        $this->middleware('auth');
    }

    public function index($id){

        $personales=\App\Paciente::where('id_user', Auth::id())->where('activo',1)->where('id',$id)->with(['commune'=>function($query){
            $query->with('region');
        }])->with('estado')->with('actividad')->first();
        if($personales){
            $fecha_morbido = \App\Morbido::where('id_paciente',$id)->where('activo',1)->orderBy('fecha','desc')->orderBy('id','asc')->get(['id', 'fecha']);
            $fecha_examen = \App\Examen::where('id_paciente',$id)->where('activo',1)->orderBy('fecha','desc')->orderBy('id','asc')->get(['id', 'fecha']);
            $fecha_pies = \App\Pie::where('id_paciente',$id)->orderBy('fecha','desc')->orderBy('id','asc')->get(['id', 'fecha']);
            $habitos = \App\Habito::where('id_user', Auth::id())->where('activo',1)->get();
            $medicamentos = \App\Medicamento::where('id_user', Auth::id())->where('activo',1)->get();
            $enfermedades = \App\Enfermedad::where('id_user', Auth::id())->where('activo',1)->get();
            $patologias = \App\Patologia::where('id_user', Auth::id())->where('activo',1)->get();

            $morbido = \App\Morbido::where('id_paciente', $id)->where('activo',1)->orderBy('fecha','desc')->orderBy('id','desc')->first();
            $examen = \App\Examen::where('id_paciente', $id)->where('activo',1)->orderBy('fecha','desc')->orderBy('id','desc')->first();
            $pie = \App\Pie::where('id_paciente', $id)->orderBy('fecha','desc')->orderBy('id','desc')->first();

            $regiones = \App\Region::all();
            $comunas = \App\Region::find($personales->commune->region->id)->communes;

            $actividades = \App\Actividad::where('id_user', Auth::id())->where('activo', 1)->get();

            $estados = \App\Estado::where('id_user', Auth::id())->where('activo', 1)->get();

            return view('paciente.paciente',compact('personales','fecha_morbido','morbido','fecha_examen','examen','regiones','actividades','estados','comunas','examen', 'fecha_examen','pie','fecha_pies','habitos','medicamentos', 'patologias', 'enfermedades'));
        }
        else{
            abort(404);
        }

    }

    public function get($id){

        $paciente=\App\Paciente::where('id_user', Auth::id())->where('activo',1)->where('id',$id)->with(['commune'=>function($query){
            $query->with('region');
        }])->with('estado')->with('actividad')->first();
        if($paciente){
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'paciente', $paciente);
            return response()->json($regreso);
        }
        else{
            abort(404);
        }

    }

    public function VerPacientes(){
        $id = Auth::id();
        $pacientes = \App\Paciente::where('id_user', $id)->where('activo',1)->with(['commune'=>function($query){
            $query->with('region');
        }])->with('estado')->with('actividad')->get();

        //dd($pacientes);
        return Datatables::of($pacientes)
        ->addColumn('direccion', function (Paciente $paciente) {
           // dd($paciente);
           $direccion = $paciente['domicilio'].", ".$paciente['commune']['name'].", ".$paciente['commune']['region']['name'];
            return $direccion;
        })
        ->addColumn('accion', function (Paciente $paciente) {
            return "<a href='#' onclick='ver(".$paciente['id'].")' class='btn btn-sm btn-outline-primary m-1 px-3' title='Ver'><i class='fal fa-user'></i></a>
            <a href='#' onclick='editar(".$paciente['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
            <a href='#' onclick='eliminar(".$paciente['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
        })
        ->rawColumns(['direccion','accion'])
        ->toJson();
    }

    public function CrearPaciente(Request $request){

        $id = Auth::id();
        $paciente = \App\Paciente::where('rut', $request->rut)->where('id_user', Auth::id())->where('activo', 1)->count();
        if($paciente == 0){
            $paciente = new \App\Paciente();
            $paciente->id_user = $id;
            $paciente->rut = $request->rut;
            $paciente->nombre = $request->nombre;
            $paciente->apellido = $request->apellido;
            $paciente->nacimiento = $request->nacimiento;
            $paciente->domicilio = $request->domicilio;
            $paciente->telefono = $request->telefono;
            $paciente->id_commune = $request->id_commune;

            $estado = \App\Estado::where('nombre_estado', ucfirst(strtolower($request->nombre_estado)))->count();
            if($estado >= 1){
                $estado = \App\Estado::where('nombre_estado', ucfirst(strtolower($request->nombre_estado)))->first();
            }
            else{
                $estado = new \App\Estado();
                $estado->nombre_estado = ucfirst(strtolower($request->nombre_estado));
                $estado->id_user = Auth::id();
                $estado->save();
            }

            $actividad = \App\Actividad::where('nombre_actividad', ucfirst(strtolower($request->nombre_actividad)))->count();
            if($actividad >= 1){
                $actividad = \App\Actividad::where('nombre_actividad', ucfirst(strtolower($request->nombre_actividad)))->first();
            }
            else{
                $actividad = new \App\Actividad();
                $actividad->nombre_actividad = ucfirst(strtolower($request->nombre_actividad));
                $actividad->id_user = Auth::id();
                $actividad->save();
            }
            $paciente->id_estado = $estado->id;
            $paciente->id_actividad = $actividad->id;
            $paciente->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'id_paciente', $paciente->id);
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El paciente fue agregado con exito');
            return response()->json($regreso);
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El paciente que se intento agregar ya existe');
            return response()->json($regreso);
        }
    }

    public function EliminarPaciente(Request $request){
        $paciente = \App\Paciente::where('id', $request->id)->where('id_user',Auth::id())->first();
        if($paciente){


            if($paciente->activo == 1){
                $paciente->activo = 0;
                $paciente->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'El paciente fue eliminado satisfactoriamente');
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'El paciente ya habia sido eliminado anteriormente');
                return response()->json($regreso);
            }

        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El paciente seleccionado no existe o no le pertenece');
            return response()->json($regreso);
        }
    }

    public function EditarPaciente(Request $request){
        $paciente = \App\Paciente::where('id', $request->id_paciente)->where('id_user',Auth::id())->first();
        if($paciente){
            $paciente->rut = $request->rut;
            $paciente->nombre = $request->nombre;
            $paciente->apellido = $request->apellido;
            $paciente->nacimiento = $request->nacimiento;
            $paciente->domicilio = $request->domicilio;
            $paciente->telefono = $request->telefono;
            $paciente->id_commune = $request->id_commune;
            $estado = \App\Estado::where('nombre_estado', ucfirst(strtolower($request->nombre_estado)))->count();
            if($estado >= 1){
                $estado = \App\Estado::where('nombre_estado', ucfirst(strtolower($request->nombre_estado)))->first();
            }
            else{
                $estado = new \App\Estado();
                $estado->nombre_estado = ucfirst(strtolower($request->nombre_estado));
                $estado->id_user = Auth::id();
                $estado->save();
            }

            $actividad = \App\Actividad::where('nombre_actividad', ucfirst(strtolower($request->nombre_actividad)))->count();
            if($actividad >= 1){
                $actividad = \App\Actividad::where('nombre_actividad', ucfirst(strtolower($request->nombre_actividad)))->first();
            }
            else{
                $actividad = new \App\Actividad();
                $actividad->nombre_actividad = ucfirst(strtolower($request->nombre_actividad));
                $actividad->id_user = Auth::id();
                $actividad->save();
            }
            $paciente->id_estado = $estado->id;
            $paciente->id_actividad = $actividad->id;
            $paciente->save();
            $paciente = $pacientes = \App\Paciente::where('id', $paciente->id)->where('activo',1)->with(['commune'=>function($query){
                $query->with('region');
            }])->with('estado')->with('actividad')->get();
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'El paciente fue editado satisfactoriamente');
            $regreso = Arr::add($regreso, 'paciente', $paciente);
            return response()->json($regreso);
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'El paciente seleccionado no existe o no le pertenece');
            return response()->json($regreso);
        }
    }

    public function editMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
                $morbido = \App\Morbido::where('id', $request->id_morbido)->where('id_paciente',$request->id_paciente)->first();
                if($morbido){
                    $morbido->hta = $request->hta;
                    $morbido->dm = $request->dm;
                    $morbido->tipo = $request->tipo_dm;
                    $morbido->anos_evolucion = $request->anos_evolucion;
                    $morbido->pcte_mixto = $request->pcte_mixto;
                    $morbido->control = $request->control;
                    $morbido->ortopedia = $request->ortopedia;
                    $morbido->fecha = $request->fecha_morbido;
                    $morbido->save();

                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'true');
                    $regreso = Arr::add($regreso, 'mensaje', 'Los antecedentes morbidos fueron editados satisfactoriamente');
                    $regreso = Arr::add($regreso, 'morbido', $morbido);
                    return response()->json($regreso);
                }
                else{
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Los datos del paciente no concuerdan');
                    return response()->json($regreso);
                }

        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al editar los antecedentes morbidos del paciente');
        return response()->json($regreso);
       }
    }

    public function addMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $morbido = new \App\Morbido();

            $morbido->id_paciente = $request->id_paciente;
            $morbido->hta = $request->hta;
            $morbido->dm = $request->dm;
            $morbido->tipo = $request->tipo_dm;
            $morbido->anos_evolucion = $request->anos_evolucion;
            $morbido->pcte_mixto = $request->pcte_mixto;
            $morbido->control = $request->control;
            $morbido->ortopedia = $request->ortopedia;
            $morbido->fecha = $request->fecha_morbido;

            $morbido->save();
            $morbido->fecha2 = date('d/m/Y',strtotime($morbido->fecha));
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Los antecedentes morbidos fueron agregados satisfactoriamente');
            $regreso = Arr::add($regreso, 'morbido', $morbido);
            return response()->json($regreso);

        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al editar los antecedentes morbidos del paciente');
        return response()->json($regreso);
       }
    }

    public function VerMorbido($id, $paciente){
        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $morbido = \App\Morbido::where('id', $id)->where('id_paciente',$paciente)->where('activo',1)->first();
            $morbido->fecha2 = date('d/m/Y',strtotime($morbido->fecha));

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'Los antecedentes morbidos fueron cargados satisfactoriamente');
            $regreso = Arr::add($regreso, 'morbido', $morbido);
            return response()->json($regreso);
        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al cargar los antecedentes morbidos del paciente');
        return response()->json($regreso);
       }
    }

    public function VerMorbidos(Request $request){
        $id = Auth::id();
        $morbidos = \App\Morbido::where('id_paciente', $request->id_paciente)->where('activo', 1)->orderBy('fecha', 'desc')->get();

        //dd($morbidos);
        return Datatables::of($morbidos)
        ->addColumn('accion', function (Morbido $morbido) {
            return "<a href='#' onclick='editar(".$morbido['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
            <a href='#' onclick='eliminar(".$morbido['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
        })
        ->rawColumns(['direccion','accion'])
        ->toJson();
    }

    public function EliminarMorbido(Request $request){
        $paciente = \App\Paciente::where('id_user', Auth::id())->where('id', $request->id_paciente)->where('activo',1)->first();
        if($paciente){
            $morbido = \App\Morbido::where('id', $request->id_morbido)->where('id_paciente',$request->id_paciente)->where('activo',1)->first();
            if($morbido){
                $morbido->activo = 0;
                $morbido->save();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Los antecedentes morbidos fueron eliminados satisfactoriamente');
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al eliminar los antecedentes morbidos del paciente');
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

    public function VerAtencion(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
        if($paciente){
            $atenciones = \App\Atencion::where('id_paciente', $request->id_paciente)->where('activo',1)->get(['id','atencion_fecha']);
        //dd($morbido);

        }
        else{
            //$atenciones = \App\Atencion::where('id',0)->get();
            $atencion = new \App\Atencion();
            $atenciones = collect($atencion);
        }
        return Datatables::of($atenciones)
            ->addColumn('accion', function (Atencion $atencion) {
                return "<a href='#' onclick='editar(".$atencion['id'].")' class='btn btn-sm btn-outline-success m-1 px-3' title='Editar'><i class='fal fa-edit'></i></a>
            <a href='#' onclick='eliminar(".$atencion['id'].")' class='btn btn-sm btn-outline-danger m-1 px-3' title='Eliminar'><i class='fal fa-trash'></i></a>";
            })
            ->rawColumns(['accion'])
            ->toJson();
    }

    public function PacienteAtencion($id, $paciente){


        $pacientes = \App\Paciente::where('id_user', Auth::id())->where('id', $paciente)->where('activo',1)->first();
        if($pacientes){
            $atencion = \App\Atencion::where('id', $id)->where('id_paciente',$paciente)->where('activo',1)->first();
            $atencion->fecha2 = date('d/m/Y',strtotime($atencion->fecha));

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La atencion fue cargada satisfactoriamente');
            $regreso = Arr::add($regreso, 'atencion', $atencion);
            return response()->json($regreso);
        }
       else{
        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al cargar la atencion del paciente');
        return response()->json($regreso);
       }

    }

    public function AgregaAtencion(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
        if($paciente){
            $atencion = new \App\Atencion();
            $atencion->id_paciente = $request->id_paciente;
            $atencion->atencion_fecha = $request->atencion_fecha;
            $atencion->atencion_pa = $request->atencion_pa;
            $atencion->atencion_pulso_radial = $request->atencion_pulso_radial;
            $atencion->atencion_peso = $request->atencion_peso;
            $atencion->atencion_pedio_d = $request->atencion_pedio_d;
            $atencion->atencion_pedio_i = $request->atencion_pedio_i;
            $atencion->atencion_sensibilidad_d = $request->atencion_sensibilidad_d;
            $atencion->atencion_sensibilidad_i = $request->atencion_sensibilidad_i;
            $atencion->atencion_t_podal = $request->atencion_t_podal;
            $atencion->atencion_podal = $request->atencion_podal;
            $atencion->atencion_curacion = $request->atencion_curacion;
            $atencion->atencion_colocacion = $request->atencion_colocacion;
            $atencion->atencion_resecado = $request->atencion_resecado;
            $atencion->atencion_enucleasion = $request->atencion_enucleasion;
            $atencion->atencion_devastado = $request->atencion_devastado;
            $atencion->atencion_masoterapia = $request->atencion_masoterapia;
            $atencion->atencion_espiculoectomia = $request->atencion_espiculoectomia;
            $atencion->atencion_analgesia = $request->atencion_analgesia;
            $atencion->atencion_acrilico = $request->atencion_acrilico;
            $atencion->atencion_banda = $request->atencion_banda;
            $atencion->atencion_bracket = $request->atencion_bracket;
            $atencion->atencion_policarboxilato = $request->atencion_policarboxilato;
            $atencion->atencion_descripcion = $request->atencion_descripcion;

            $atencion->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La atencion fue agregada satisfactoriamente');
            return response()->json($regreso);
        }

        $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar los datos');
            return response()->json($regreso);
    }

    public function EditaAtencion(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
        if($paciente){
            $atencion = \App\Atencion::where('id',$request->id_atencion)->first();
            $atencion->atencion_fecha = $request->atencion_fecha;
            $atencion->atencion_pa = $request->atencion_pa;
            $atencion->atencion_pulso_radial = $request->atencion_pulso_radial;
            $atencion->atencion_peso = $request->atencion_peso;
            $atencion->atencion_pedio_d = $request->atencion_pedio_d;
            $atencion->atencion_pedio_i = $request->atencion_pedio_i;
            $atencion->atencion_sensibilidad_d = $request->atencion_sensibilidad_d;
            $atencion->atencion_sensibilidad_i = $request->atencion_sensibilidad_i;
            $atencion->atencion_t_podal = $request->atencion_t_podal;
            $atencion->atencion_podal = $request->atencion_podal;
            $atencion->atencion_curacion = $request->atencion_curacion;
            $atencion->atencion_colocacion = $request->atencion_colocacion;
            $atencion->atencion_resecado = $request->atencion_resecado;
            $atencion->atencion_enucleasion = $request->atencion_enucleasion;
            $atencion->atencion_devastado = $request->atencion_devastado;
            $atencion->atencion_masoterapia = $request->atencion_masoterapia;
            $atencion->atencion_espiculoectomia = $request->atencion_espiculoectomia;
            $atencion->atencion_analgesia = $request->atencion_analgesia;
            $atencion->atencion_acrilico = $request->atencion_acrilico;
            $atencion->atencion_banda = $request->atencion_banda;
            $atencion->atencion_bracket = $request->atencion_bracket;
            $atencion->atencion_policarboxilato = $request->atencion_policarboxilato;
            $atencion->atencion_descripcion = $request->atencion_descripcion;

            $atencion->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La atencion fue editada satisfactoriamente');
            return response()->json($regreso);
        }

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar los datos');
        return response()->json($regreso);


    }

    public function EliminaAtencion(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
        if($paciente){
            $atencion = \App\Atencion::where('id',$request->id_atencion)->where('id_paciente',$request->id_paciente)->first();
            $atencion->activo = 0;
            $atencion->save();

            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'true');
            $regreso = Arr::add($regreso, 'mensaje', 'La atencion fue eliminada satisfactoriamente');
            return response()->json($regreso);
        }

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'false');
        $regreso = Arr::add($regreso, 'mensaje', 'Ocurrio un error al validar los datos');
        return response()->json($regreso);
    }

    public function SubirPie(Request $request){
        if($request->id_foto == 0){
            $id = $request->id_paciente;
            $paciente = \App\Paciente::where('id', $id)->where('id_user',Auth::id())->first();
            $pie = \App\Pie::where("fecha", $request->fecha)->where("id_paciente",$request->id_paciente)->first();
            if($paciente){
                if($pie){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Ya existe un pie con esa fecha');
                    return response()->json($regreso);
                }
                $image = $request->img;
                $imgData = base64_decode(substr($image,22));
                $path = Str::random(11).'.jpg';
                Storage::makeDirectory("img/".$id);
                Storage::put('img/'.$id."/".$path, $imgData);


                $pie = new \App\Pie();
                $pie->id_paciente = $id;
                $pie->fecha = $request->fecha;
                $pie->url_imagen = $path;
                $pie->save();
                $pie->fecha2 = date('d/m/Y',strtotime($pie->fecha));

                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Imagen subida con exito');
                $regreso = Arr::add($regreso, 'pie', $pie);
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al validar paciente!');
                return response()->json($regreso);
            }

        }
        else{
            $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
            $pie = \App\Pie::where("fecha", $request->fecha)->where("id_paciente",$request->id_paciente)->where("id","!=",$request->id_foto)->first();
            if($paciente){
                if($pie){
                    $regreso = array();
                    $regreso = Arr::add($regreso, 'estado', 'false');
                    $regreso = Arr::add($regreso, 'mensaje', 'Ya existe un pie con esa fecha');
                    return response()->json($regreso);
                }
                $id = $request->id_paciente;
                $pie = \App\Pie::where('id_paciente', $request->id_paciente)->where('id', $request->id_foto)->first();
                $image = $request->img;
                $imgData = base64_decode(substr($image,22));
                $path = $pie->url_imagen;
                $pie->fecha = $request->fecha;
                $pie->save();
                $pie->fecha2 = date('d/m/Y',strtotime($pie->fecha));
                Storage::makeDirectory("img/".$id);
                Storage::put('img/'.$id."/".$path, $imgData);

                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Imagen reemplazada con exito');
                $regreso = Arr::add($regreso, 'pie', $pie);
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al validar paciente 2');
                return response()->json($regreso);
            }

        }
    }

    public function SubirFoto(Request $request){
        $image = $request->img;
        $imgData = base64_decode(substr($image,22));
        $path = Str::random(11).'.jpg';
        Storage::makeDirectory("protocolo/");
        Storage::put('protocolo/'.$path, $imgData);

        $regreso = array();
        $regreso = Arr::add($regreso, 'estado', 'true');
        $regreso = Arr::add($regreso, 'url', 'protocolo/'.$path);
        return response()->json($regreso);
    }
    public function EliminarPie(Request $request){
        $paciente = \App\Paciente::where('id',$request->id_paciente)->where('id_user', Auth::id())->first();
        if($paciente){
            $pie = \App\Pie::where('id_paciente', $request->id_paciente)->where('id', $request->fecha_pie)->first();
            if($pie){
                Storage::delete('img/'.$paciente->id.'/'.$pie->url_imagen);
                $pie->delete();
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'true');
                $regreso = Arr::add($regreso, 'mensaje', 'Imagen eliminada con exito');
                return response()->json($regreso);
            }
            else{
                $regreso = array();
                $regreso = Arr::add($regreso, 'estado', 'false');
                $regreso = Arr::add($regreso, 'mensaje', 'Error al validar imagen');
                return response()->json($regreso);
            }
        }
        else{
            $regreso = array();
            $regreso = Arr::add($regreso, 'estado', 'false');
            $regreso = Arr::add($regreso, 'mensaje', 'Error al validar paciente');
            return response()->json($regreso);
        }
    }
}
