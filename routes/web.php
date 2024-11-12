<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\catalogoController;
use App\Http\Controllers\perfilAdministradorController;
use App\Http\Controllers\perfilEmpleadoController;
use App\Http\Controllers\perfilUsuarioController;
use App\Http\Controllers\editarUsuarioController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ResenaController;

Route::get('/', [HomeController::class, 'masVendidos', 'mostrarRecienLlegados']);

Route::get('/cardm', [ComponentsController::class, 'CardMostSold']);
Route::get('/cardn', [ComponentsController::class, 'CardNewArrivals']);

Route::view('/contactanos', 'contactanos');
Route::get('/Skincare', [catalogoController::class, 'mostrarCatalogoSkinCare']);
Route::get('/Maquillaje', [catalogoController::class, 'mostrarCatalogoMaquillaje']);
Route::get('/Joyeria', [catalogoController::class, 'mostrarCatalogoJoyeria']);
Route::get('/CuidadoCapilar', [catalogoController::class, 'mostrarCatalogoCuidadoCapilar']);
Route::get('/Fragancia', [catalogoController::class, 'mostrarCatalogoFragancia']);
Route::get('/Favoritos', [catalogoController::class, 'mostrarFavoritos']);

Route::get('/producto/{id}', [catalogoController::class, 'mostrarDetalleProducto']);

Route::get('/about', function () {
    return view('about');
});




Route::group(['prefix' => 'account'], function(){

    Route::group(['middleware' => 'guest'], function(){
        Route::get('login', [LoginController::class,'index'])->name('account.login');
        Route::get('register', [LoginController::class,'register'])->name('account.register');
        Route::post('process-register', [LoginController::class,'processRegistration'])->name('account.processRegistration');
        Route::post('authenticate', [LoginController::class,'authenticate'])->name('account.authenticate');

    });
    Route::group(['middleware' => 'auth'], function(){

        Route::get('logout', [LoginController::class,'logout'])->name('account.logout');
        /*         Route::get('dashboard', [DashboardController::class,'index'])->name('account.dashboard');*/  
        Route::get('dashboard/{id}', [perfilUsuarioController::class, 'recuperar_info'])->name('account.dashboard');
        /*         Route::get('dashboardAdmin',[DashboardController::class,'indexx'])->name('account.dashboardAdmin');*/
        Route::get('dashboardAdmin/{id}', [perfilAdministradorController::class, 'recuperar_info_administrador'])->name('account.dashboardAdmin');
        /*         Route::get('dashboardEmpleado',[DashboardController::class,'indexxx'])->name('account.dashboardEmpleado');   */  
        Route::get('dashboardEmpleado/{id}', [perfilEmpleadoController::class, 'recuperar_info_empleado'])->name('account.dashboardEmpleado');
    });
});


    Route::post('/favorites/add/{id}', [FavoritoController::class, 'addToFavorites'])->name('favorites.add');
    Route::delete('/favorites/{productId}', [FavoritoController::class, 'removeFromFavorites'])->name('favorites.remove');
    

/* SECCION DE USUARIO - CLIENTE */

Route::get('dashboard/editarPerfil/{id}',[editarUsuarioController::class, 'editar_perfil_usuario']); 

Route::post('/registro-admin', [LoginController::class, 'processRegistrationAdmin'])->name('account.processRegistrationAdmin');
Route::get('/registerU', [LoginController::class,'registroU'])->name('account.registerU');

Route::post('/resena', [ResenaController::class, 'store'])->name('store');


