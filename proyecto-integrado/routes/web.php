<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\issueController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\issueUserController;


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

/********************************** RUTAS PARA PANTALLA PRINCIPAL *********************************/
Route::get('/', function () {
    return view('welcome');
});
/**************************************************************************************************/

/*********************************** RUTAS PARA LAS INCIDENCIAS ***********************************/
/* Ver todas las incidencias */
Route::get('/incidencias', [issueController::class, 'index'])->name('incidencias.index');

/* Ver una incidencia (por ID) */
Route::get('/incidencia/ver/{id}', [issueController::class, 'view'])->name('incidencias.view')->middleware(['auth']);

/* Crear una incidencia */
Route::get('/incidencias/crear', [issueController::class, 'create'])->name('incidencias.create')->middleware(['auth']);
Route::post('/incidencias/crear', [issueController::class, 'store'])->name('incidencias.store')->middleware(['auth']);

/* Crear un comentario desde la pantalla de incidencias */
Route::post('/incidencias', [issueController::class, 'storeComment'])->name('incidencias.storeComment')->middleware(['auth']);

/* Editar una incidencia (por ID) */
Route::get('/incidencia/editar/{id}', [issueController::class, 'edit'])->name('incidencia.edit')->middleware(['auth']);
Route::put('/incidencia/editar/{id}', [issueController::class, 'update'])->name('incidencia.update')->middleware(['auth']);
/**************************************************************************************************/

/******************************** RUTAS PARA EL PERFIL DEL USUARIO ********************************/
/* Ver perfil de un usuario */
Route::get('/perfil', [issueUserController::class, 'profile'])->name('usuarios.index')->middleware(['auth']);

/* Editar usuario (por ID) */
Route::post('/perfil', [usersController::class, 'update'])->name('usuario.update')->middleware(['auth']);

/* Editar estado de incidencia */
Route::put('/perfil', [issueController::class, 'updateCondition'])->name('incidencias.updateCondition')->middleware(['auth']);
/**************************************************************************************************/

/************************************* RUTAS PARA LOS USUARIOS ************************************/
/* Editar estado de incidencia (ADMIN) */
Route::put('/incidencias', [issueController::class, 'updateCondition'])->name('incidencias.updateCondition')->middleware(['auth']);

/* Ver todos los usuarios (ADMIN) */
Route::get('/usuarios', [usersController::class, 'admin'])->name('usuarios.admin');

/* Editar un usuario (por ID) */
Route::get('/usuario/editar/{id}', [usersController::class, 'edit'])->name('usuarios.edit')->middleware(['auth']);
Route::put('/usuario/editar/{id}', [usersController::class, 'update'])->name('usuarios.update')->middleware(['auth']);

/* Editar estado de incidencia */
Route::put('/usuarios', [usersController::class, 'updateState'])->name('usuarios.updateState')->middleware(['auth']);

/* Accesos denegado a los usuarios de baja o pendientes de confirmar */
Route::get('/accesoDenegado', [usersController::class, 'denied'])->name('usuarios.denied');

/* Crear e iniciar usuario */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
/**************************************************************************************************/