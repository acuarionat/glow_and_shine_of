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
use App\Http\Controllers\moduloClienteController;
use App\Http\Controllers\moduloCClienteController;
use App\Http\Controllers\comprasController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\ManagmentSaleController;
use App\Models\Usuario;

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
Route::get('/listarUsuariosRep/{id}', [UsuarioController::class, 'listarUsuariosRep'])->name('usuarios.listarrep');
Route::get('/buscarUsuario/{id}', [UsuarioController::class, 'busqueda_usuario'])->name('usuarios.busqueda_usuario');
Route::get('/buscarUsuarioRep/{id}', [UsuarioController::class, 'busquedaUsuarioRep'])->name('usuarios.busqueda_usuario_rep');
Route::post('/resena', [ResenaController::class, 'store'])->name('store');
Route::put('/usuarios/cambiar-estado/{id}', [UsuarioController::class, 'cambiarEstado'])->name('cambiarEstado');




Route::get('/productoDetalle/{id_user}/{id}', [buscarProductoController::class, 'mostrarDetalleProductoAdmin']);

// Route::get('/producto/create', [registrarProductoController::class, 'create']);
Route::get('/registrarProducto/{id}', [registrarProductoController::class, 'create'])->name('producto.create');
Route::post('/registrarProducto/{id}', [registrarProductoController::class, 'store'])->name('producto.store');

Route::get('/buscarProducto/{id?}', [buscarProductoController::class, 'buscarProducto'])->name('buscarProducto');

// Route::resource('producto', registrarProductoController::class);

Route::get('/producto/{id_user}/{id}/edit', [registrarProductoController::class, 'edit'])->name('producto.edit');
Route::put('/producto/{id_user}/{id}/edit', [registrarProductoController::class, 'update'])->name('producto.update');



Route::get('/listaEmpleados/{id}', [moduloEmpleadoController::class, 'detalles_empleados'])->name('empleados.detalles');
Route::get('empleados/{id}/', [moduloEmpleadoController::class, 'busqueda_empleado'])->name('empleados.busqueda_empleado');
Route::get('/registrarEmpleados/{id}', [moduloEmpleadoController::class, 'registrar_empleado']);
Route::get('/verificar-correo', [moduloEmpleadoController::class, 'verificarCorreo'])->name('verificar.correo');
Route::post('/empleados/registrar', [moduloEmpleadoController::class, 'registrarEmpleado'])->name('empleados.registrar');
Route::get('/editarPerfil/{id}/{id_empleado}', [moduloEmpleadoController::class, 'editarEmpleado'])->name('empleados.editar');
Route::put('/empleados/actualizar', [moduloEmpleadoController::class, 'actualizarEmpleado'])->name('empleados.actualizar');
Route::get('/mostrarDetalles/{id}/{id_empleado}', [moduloEmpleadoController::class, 'mostrarDetalle'])->name('empleados.detalles');



Route::get('/registrarCCliente/{id}', [moduloCClienteController::class, 'registrar_cliente']);
Route::get('/verificarCorreo', [moduloCClienteController::class, 'verificarCorreo'])->name('verificar.correo');
Route::post('/cclientes/registrar', [moduloCClienteController::class, 'registrarCliente'])->name('cliente.registrar');
Route::get('/listaCClientes/{id}', [moduloCClienteController::class, 'detalles_cliente'])->name('cliente.detalles');
Route::get('cclientes/{id}/', [moduloCClienteController::class, 'busqueda_cliente'])->name('cliente.busqueda_cliente');
Route::get('/editarPerfilCCliente/{id}/{id_cliente}', [moduloCClienteController::class, 'editarCliente'])->name('cliente.editar');
Route::put('/Cclientes/actualizar', [moduloCClienteController::class, 'actualizarCliente'])->name('clientes.actualizar');



Route::get('/registrarCliente/{id}', [moduloClienteController::class, 'registrar_cliente']);
Route::get('/verificarCorreo', [moduloClienteController::class, 'verificarCorreo'])->name('verificar.correo');
Route::post('/clientes/registrar', [moduloClienteController::class, 'registrarCliente'])->name('cliente.registrar');
Route::get('/listaClientes/{id}', [moduloClienteController::class, 'detalles_cliente'])->name('cliente.detalles');
Route::get('clientes/{id}/', [moduloClienteController::class, 'busqueda_cliente'])->name('cliente.busqueda_cliente');
Route::get('/editarPerfilCliente/{id}/{id_cliente}', [moduloClienteController::class, 'editarCliente'])->name('cliente.editar');
Route::put('/clientes/actualizar', [moduloClienteController::class, 'actualizarCliente'])->name('clientes.actualiza');


Route::get('/perfil/{id}', [perfilController::class, 'datos_perfil']);


Route::get('/ventas/{id}', [salesController::class, 'mostrarVentas']);
Route::get('/compras/{id}', [comprasController::class, 'mostrarCompras']);

Route::get('/buscar-producto/{nombre}', [ManagmentSaleController::class, 'buscarProducto'])->name('buscar.producto');
Route::get('/msale/{id}', [ManagmentSaleController::class, 'ManagmentSale']); 
Route::get('/buscar-persona/{ci}', [ManagmentSaleController::class, 'buscarPersona'])->name('buscar.persona');


Route::get('registrarCompras/{id}', [comprasController::class, 'ManagmentBuy']);
Route::get('/buscar-empresa/{ci}', [comprasController::class, 'buscarPersona'])->name('buscar.persona');



Route::get('/post-created', function () {
    return view('post-created');
})->name('post-created');

Route::get('/usuarios/pdf',[UsuarioController::class,'GenerarPDF'])->name('usuariospdf.pdf');