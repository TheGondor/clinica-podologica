<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $regiones = \App\Region::all();
        return redirect()->route('home2');
    }

    public function index2()
    {
        return redirect()->route('home2');
    }

    public function Comunas(Request $request){
        $comunas = \App\Region::find($request->id)->communes;
        return $comunas->toJson();
    }

    public function RecibirPie($paciente, $id){
        $paciente2 = \App\Paciente::where('id', $paciente)->where('id_user',Auth::id())->where('activo', 1)->first();
        if($paciente2){
            $foto = \App\Pie::where('id_paciente', $paciente)->where('id', $id)->first();
            if($foto){
                $link = 'app/img/'.$foto->id_paciente.'/'.$foto->url_imagen;
                $path = storage_path($link);
                return response()->file($path, [$link]);
            }
            else{
                return "error";
            }
        }
        else{
            return "no paciente";
        }
    }
    public function RecibirProtocolo($link){
        $path = storage_path('app/protocolo/'.$link);
        return response()->file($path, [$link]);
    }
}
