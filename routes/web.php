<?php

use App\Http\Controllers\ActividadTareaController;
use App\Http\Controllers\CertificacionController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DetalleFormularioController;
use App\Http\Controllers\FormularioCincoController;
use App\Http\Controllers\FormularioCuatroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// LOGIN
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);


// CONFIGURACIÓN
Route::get('/configuracion/getConfiguracion', [ConfiguracionController::class, 'getConfiguracion']);
Route::post('/configuracion/update', [ConfiguracionController::class, 'update']);


Route::prefix('admin')->group(function () {
    // USUARIOS
    Route::get('usuarios/getUsuario/{usuario}', [UserController::class, 'getUsuario']);
    Route::get('usuarios/userActual', [UserController::class, 'userActual']);
    Route::get('usuarios/getInfoBox', [UserController::class, 'getInfoBox']);
    Route::get('usuarios/getPermisos/{usuario}', [UserController::class, 'getPermisos']);
    Route::get('usuarios/getEncargadosRepresentantes', [UserController::class, 'getEncargadosRepresentantes']);
    Route::post('usuarios/actualizaContrasenia/{usuario}', [UserController::class, 'actualizaContrasenia']);
    Route::post('usuarios/actualizaFoto/{usuario}', [UserController::class, 'actualizaFoto']);
    Route::resource('usuarios', UserController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // UNIDADES ORGANIZACIONALES
    Route::resource('unidads', UnidadController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // FORMULARIO CUATRO
    Route::get("formulario_cuatro/getOperaciones", [FormularioCuatroController::class, "getOperaciones"]);
    Route::resource('formulario_cuatro', FormularioCuatroController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // DETALLE FORMULARIO CUATRO
    Route::resource('detalle_formularios', DetalleFormularioController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // operacions
    Route::get('operacions/getTareas', [OperacionController::class, "getTareas"]);

    Route::resource('operacions', OperacionController::class)->only([
        'store', 'update', 'destroy'
    ]);

    // tareas-partidas
    Route::get("actividad_tareas/getPartidas", [ActividadTareaController::class, 'getPartidas']);

    // FORMULARIO CINCO
    Route::get("formulario_cinco/tabla/getTabla/{formulario_cinco}", [FormularioCincoController::class, "getTabla"]);
    Route::get("formulario_cinco/getOperaciones", [FormularioCincoController::class, "getOperaciones"]);
    Route::resource('formulario_cinco', FormularioCincoController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // CERTIFICACION
    Route::get("certificacions/getNroCorrelativo", [CertificacionController::class, "getNroCorrelativo"]);
    Route::POST("certificacions/aprobar/{certificacion}", [CertificacionController::class, "aprobar"]);
    Route::POST("certificacions/pdf/{certificacion}", [CertificacionController::class, "pdf"]);
    Route::resource('certificacions', CertificacionController::class)->only([
        'index', 'store', 'update', 'destroy', 'show'
    ]);

    // REPORTES
    Route::post('reportes/usuarios', [ReporteController::class, 'usuarios']);
    Route::post('reportes/ejecucion_presupuestos', [ReporteController::class, 'ejecucion_presupuestos']);
    Route::post('reportes/ejecucion_presupuestos_g', [ReporteController::class, 'ejecucion_presupuestos_g']);
});

// ---------------------------------------
Route::get('/{optional?}', function () {
    return view('app');
})->name('base_path')->where('optional', '.*');
