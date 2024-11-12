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
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\registrarProductoController;
use App\Http\Controllers\buscarProductoController;
use App\Http\Controllers\moduloEmpleadoController;

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
Route::get('/registerU/{id}', [LoginController::class,'registroU'])->name('account.registerU');
Route::get('/listarUsuarios/{id}', [UsuarioController::class, 'listarUsuarios'])->name('usuarios.listar');
Route::get('/buscarUsuario/{id}', [UsuarioController::class, 'busqueda_usuario'])->name('usuarios.busqueda_usuario');
Route::post('/resena', [ResenaController::class, 'store'])->name('store');


Route::get('/producto/{id}', [buscarProductoController::class, 'mostrarDetalleProductoAdmin']);
Route::get('/producto/create', [registrarProductoController::class, 'create']);
Route::get('/registrarProducto', [registrarProductoController::class, 'create'])->name('producto.create');
Route::post('/registrarProducto', [registrarProductoController::class, 'store'])->name('producto.store');
Route::get('/buscarProducto', [buscarProductoController::class, 'buscarProducto'])->name('buscarProducto');;
Route::resource('producto', registrarProductoController::class);



Route::get('/listaEmpleados/{id}', [moduloEmpleadoController::class, 'detalles_empleados'])->name('empleados.detalles');
Route::get('empleados/{id}/', [moduloEmpleadoController::class, 'busqueda_empleado'])->name('empleados.busqueda_empleado');
Route::get('/registrarEmpleados/{id}', [moduloEmpleadoController::class, 'registrar_empleado']);
Route::get('/verificar-correo', [moduloEmpleadoController::class, 'verificarCorreo'])->name('verificar.correo');
Route::post('/empleados/registrar', [moduloEmpleadoController::class, 'registrarEmpleado'])->name('empleados.registrar');
Route::get('/editarPerfil/{id}/{id_empleado}', [moduloEmpleadoController::class, 'editarEmpleado'])->name('empleados.editar');
Route::put('/empleados/actualizar', [moduloEmpleadoController::class, 'actualizarEmpleado'])->name('empleados.actualizar');
