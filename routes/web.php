<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home')->middleware('activo');

Route::get('/home', 'HomeController@index2');

Auth::routes();

//Administracion

Route::get('/administracion', 'AdminController@index')->name('home2')->middleware('auth');

Route::get('/admin_pacientes', 'AdminController@getPacientes');

Route::get('/admin_protocolos', 'AdminController@getProtocolo');

Route::get('/admin_paciente/{id}', 'AdminController@getPaciente');

Route::get('/admin_morbido/{id}', 'AdminController@getMorbido');

Route::get('/admin_enfermedad/{id}', 'AdminController@getEnfermedad');

Route::get('/admin_medicamento/{id}', 'AdminController@getMedicamento');

Route::get('/admin_patologia/{id}', 'AdminController@getPatologia');

Route::get('/admin_habito/{id}', 'AdminController@getHabito');

Route::get('/admin_ficha_examen/{id}', 'AdminController@getExamen');

Route::get('/admin_pies/{id}', 'AdminController@getPies');

Route::get('/admin_atencion/{id}', 'AdminController@getAtencion');
//Paciente

Route::get('/paciente/{id}', 'PacienteController@get')->name('paciente');

Route::post('ver_pacientes','PacienteController@VerPacientes');

Route::post('paciente', 'PacienteController@CrearPaciente');

Route::delete('paciente', 'PacienteController@EliminarPaciente');

Route::put('paciente', 'PacienteController@EditarPaciente');

Route::post('ver_comunas', 'HomeController@Comunas');

//Morbido

Route::post('ver_morbidos', 'PacienteController@VerMorbidos');

Route::post('morbido', 'PacienteController@addMorbido');

Route::put('morbido', 'PacienteController@editMorbido');

Route::get('morbido/{id}/paciente/{paciente}', 'PacienteController@VerMorbido');

Route::delete('morbido', 'PacienteController@EliminarMorbido');

//Enfermedad

Route::post('ver_enfermedades', 'EnfermedadController@VerEnfermedadPaciente');

Route::get('enfermedad/{id}/paciente/{paciente}', 'EnfermedadController@getEnfermedadMorbido');

Route::post('enfermedad', 'EnfermedadController@AgregarEnfermedadMorbido');

Route::put('enfermedad', 'EnfermedadController@EditarEnfermedadMorbido');

Route::delete('enfermedad', 'EnfermedadController@EliminarEnfermedad');

//Habitos

Route::post('ver_habitos', 'HabitoController@VerHabitoPaciente');

Route::get('habito/{id}/paciente/{paciente}', 'HabitoController@getHabitoMorbido');

Route::post('habito', 'HabitoController@AgregarHabitoMorbido');

Route::put('habito', 'HabitoController@EditarHabitoMorbido');

Route::delete('habito', 'HabitoController@EliminarHabito');

//Medicamentos

Route::post('ver_medicamentos', 'MedicamentoController@VerMedicamentoPaciente');

Route::get('medicamento/{id}/paciente/{paciente}', 'MedicamentoController@getMedicamentoMorbido');

Route::post('medicamento', 'MedicamentoController@AgregarMedicamentoMorbido');

Route::put('medicamento', 'MedicamentoController@EditarMedicamentoMorbido');

Route::delete('medicamento', 'MedicamentoController@EliminarMedicamento');

//Patologia

Route::post('ver_patologias', 'PatologiaController@VerPatologiaPaciente');

Route::get('patologia/{id}/paciente/{paciente}', 'PatologiaController@getPatologiaMorbido');

Route::post('patologia', 'PatologiaController@AgregarPatologiaMorbido');

Route::put('patologia', 'PatologiaController@EditarPatologiaMorbido');

Route::delete('patologia', 'PatologiaController@EliminarPatologia');

//Examen fisico general

Route::post('ver_examenes', 'ExamenController@VerExamenes');

Route::post('examen', 'ExamenController@AgregarExamen');

Route::put('examen', 'ExamenController@EditarExamen');

Route::get('examen/{id}/paciente/{paciente}', 'ExamenController@VerExamen');

Route::delete('examen', 'ExamenController@EliminarExamen');


//Atencion

Route::post('ver_atenciones', 'PacienteController@VerAtencion');

Route::get('atencion/{id}/paciente/{paciente}', 'PacienteController@PacienteAtencion');

Route::post('atencion', 'PacienteController@AgregaAtencion');

Route::put('atencion', 'PacienteController@EditaAtencion');

Route::delete('atencion', 'PacienteController@EliminaAtencion');

//Pie

Route::post('upload_image', 'PacienteController@SubirPie');

Route::post('upload_foto', 'PacienteController@SubirFoto');

Route::post('eliminar_pie', 'PacienteController@EliminarPie');

Route::get('/imagen/{paciente}/pie/{id}', 'HomeController@RecibirPie')->name('imagen');

Route::get('/protocolo/{link}', 'HomeController@RecibirProtocolo')->name('protocolo');

//Protocolos

Route::post('ver_protocolos', 'ProtocoloController@VerProtocolos');

Route::get('protocolo2/{id}', 'ProtocoloController@getProtocolo');

Route::post('protocolo2', 'ProtocoloController@AgregarProtocolo');

Route::put('protocolo2', 'ProtocoloController@EditarProtocolo');

Route::delete('protocolo2', 'ProtocoloController@EliminarProtocolo');

Route::post('getProtocolo', 'ProtocoloController@PatologiaProtocolo');

