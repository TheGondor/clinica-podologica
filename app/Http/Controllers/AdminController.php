<?php

namespace App\Http\Controllers;

use App\Compra_implemento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('activo', ['except' => ['index']]);
    }
    public function index(){
        return view ('administracion.home');
    }
    public function getPacientes(){
        $actividades = \App\Actividad::where('id_user', Auth::id())->where('activo', 1)->get();
        $estados = \App\Estado::where('id_user', Auth::id())->where('activo', 1)->get();
        $regiones = \App\Region::all();

        return view('administracion.pacientes', compact('actividades', 'estados', 'regiones'));
    }

    public function getProtocolo(){
        $patologias=\App\Enfermedad::where('activo',1)->where('id_user', Auth::id())->get();
        return view('administracion.protocolo', compact('patologias'));
    }

    public function getPaciente($id){

        $Paciente=\App\Paciente::where('id_user', Auth::id())->where('activo',1)->where('id',$id)->with(['commune'=>function($query){
            $query->with('region');
        }])->with('estado')->with('actividad')->first();
        $regiones = \App\Region::all();
        if($Paciente){
            return view('administracion.paciente', compact('Paciente', 'regiones'));
        }
        else{
            //abort(404);
        }

    }

    public function getMorbido($id){

        $morbido=\App\Morbido::where('activo',1)->orderBy('fecha', 'desc')->where('id_paciente', $id)->first();
        return view('administracion.morbido', compact('morbido'));
    }

    public function getEnfermedad($id){

        $enfermedades=\App\Enfermedad::where('activo',1)->where('id_user', Auth::id())->get();
        return view('administracion.enfermedades', compact('enfermedades'));
    }

    public function getMedicamento($id){

        $medicamentos=\App\Enfermedad::where('activo',1)->where('id_user', Auth::id())->get();
        return view('administracion.medicamentos', compact('medicamentos'));
    }

    public function getPatologia($id){

        $patologias=\App\Enfermedad::where('activo',1)->where('id_user', Auth::id())->get();
        return view('administracion.patologias', compact('patologias'));
    }

    public function getHabito($id){

        $habitos=\App\Habito::where('activo',1)->where('id_user', Auth::id())->get();
        return view('administracion.habitos', compact('habitos'));
    }

    public function getExamen($id){
        $paciente = \App\Paciente::where('id',$id)->where('id_user',Auth::id())->first();
        if($paciente){
            $examen=\App\Examen::where('activo',1)->orderBy('fecha', 'desc')->where('id_paciente', $id)->first();
            return view('administracion.examen', compact('examen'));
        }
        else{
            abort(404);
        }
    }

    public function getPies($id){
        $paciente = \App\Paciente::where('id',$id)->where('id_user',Auth::id())->first();
        if($paciente){
            $fecha_pies = \App\Pie::where('id_paciente',$id)->orderBy('fecha','desc')->orderBy('id','asc')->get(['id', 'fecha']);
            $pie = \App\Pie::where('id_paciente', $id)->orderBy('fecha','desc')->orderBy('id','desc')->first();
            return view('administracion.pies', compact('pie', 'fecha_pies'));
        }
        else{
            abort(404);
        }
    }

    public function getAtencion($id){
        $paciente = \App\Paciente::where('id',$id)->where('id_user',Auth::id())->first();
        if($paciente){
            return view('administracion.atencion');
        }
        else{
            abort(404);
        }
    }
}
