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
//Route::get('/', "Auth\LoginController@showLoginForm");


Route::post('/cambiar_password', "UsersController@cambiar_password");


Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/configuracion', function(){

	$view = view("configuracion")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');

Route::get('/recursos-tecnologicos', function(){

	$view = view("recursos_tecnologicos")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');


Route::get('/recursos-humanos', function(){

	$view = view("recursos_humanos")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');


Route::get('/vista_movimientos', function(){

	$view = view("movimientos")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');


Route::get('/software', function(){

	$view = view("software")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');


Route::get('/formulario_subir_activos', function(){

	$view = view("formulario_subir_archivo_activos")->render(); 
	return response()->json(['html'=>$view]);

})->middleware('jwt.auth');

//TODO: fix the method of query this route, for use the middleware
//Route::post('/subir_activos', "InventarioController@registrarActivos")->middleware("jwt.auth", "role:root");
Route::post('/subir_activos', "InventarioController@registrarActivos");

Route::post('/activos', "InventarioController@registrarActivo")->middleware("jwt.auth", "role:root");

Route::get('/activo/componentes-compuestode',  'InventarioController@getComponentes_CompuestoDe_DeActivo')->middleware('jwt.auth');
Route::post('/activos/agregar-componente',  'InventarioController@agregarComponente');


Route::get('/activo/{id_activo}/eliminar-componente/{id_componente}',  'InventarioController@eliminarComponenteDeActivo');


Route::post("/activos/anexar_archivo", "InventarioController@anexar_archivo")->middleware("jwt.auth", "role:root");

Route::get("/activos/anexos", "InventarioController@listar_anexos")->middleware('jwt.auth');

Route::get("/activos/anexo/{id_activo}/{ruta_anexo}", "InventarioController@getAnexo")->middleware('jwt.auth');

Route::post("/filtrar_inventario", "InventarioController@filtrar_inventario")->middleware('jwt.auth');

Route::get("/get_api_token", "Auth\LoginController@getApiToken");

Auth::routes();


/////////////////////////////////////////////////////////////////

Route::get('/reporte/software',  'ReportesAutomaticosController@mostrarReportesSoftware');

Route::get("/vista_tareas", function (){
    $view = view("tareas")->render(); 
    return response()->json(['html'=>$view]);
});
Route::get('/tareas',  'TareasController@getTareas')->middleware('jwt.auth');
Route::post('/tareas',  'TareasController@crearTarea')->middleware('jwt.auth');
Route::put('/tareas',  'TareasController@actualizarTarea')->middleware('jwt.auth');
Route::delete('/tareas',  'TareasController@eliminarTarea')->middleware('jwt.auth');
Route::post('/marcar_tarea_realizada',  'TareasController@marcarTareaComoRealizada')->middleware('jwt.auth');



Route::get('/tipo_tareas', 'TareasController@getTiposTareas')->middleware('jwt.auth');

Route::post('/tipo_tareas', 'TareasController@crearTiposTareas')->middleware('jwt.auth');
Route::get('/categoriasTareas_arreglo_llave_valor',  'TareasController@tipoTareas_arreglo_llave_valor')->middleware('jwt.auth');



Route::post('/dependencias',  'DependenciasController@crearDependencia')->middleware("jwt.auth", "role:root");
Route::get('/dependencias',  'DependenciasController@getDependencias')->middleware('jwt.auth');
Route::get('/dependencias_arreglo_llave_valor',  'DependenciasController@getDependencias_arreglo_llave_valor')->middleware('jwt.auth');

Route::get('/cargos',  'CargosController@getCargos')->middleware('jwt.auth');
Route::post('/cargos',  'CargosController@crearCargos')->middleware("jwt.auth", "role:root");
Route::get('/cargos_arreglo_llave_valor',  'CargosController@getCargos_arreglo_llave_valor')->middleware('jwt.auth');

Route::get('/roles_arreglo_llave_valor',  'UsersController@getRoles_arreglo_llave_valor')->middleware('jwt.auth');


Route::get('/edificios',  'EdificiosController@getEdificios')->middleware('jwt.auth');
Route::post('/edificios',  'EdificiosController@crearEdificios')->middleware("jwt.auth", "role:root");
Route::get('/edificios_arreglo_llave_valor',  'EdificiosController@getEdificios_arreglo_llave_valor')->middleware('jwt.auth');


Route::get('/oficinas',  'OficinasController@getOficinas')->middleware('jwt.auth');
Route::get('/oficinas_arreglo_llave_valor',  'OficinasController@getOficinas_arreglo_llave_valor')->middleware('jwt.auth');
Route::post('/oficinas',  'OficinasController@crearOficinas')->middleware("jwt.auth", "role:root");

Route::get('/estados',  'EstadosDeActivosController@getEstados')->middleware('jwt.auth');
Route::post('/estados',  'EstadosDeActivosController@crearEstado')->middleware("jwt.auth", "role:root");
Route::get('/estados_arreglo_llave_valor',  'EstadosDeActivosController@getEstados_arreglo_llave_valor')->middleware('jwt.auth');


Route::get('/movimientos',  'MovimientosController@getMovimientos')->middleware('jwt.auth');
Route::post('/movimientos',  'MovimientosController@crearPrestamo')->middleware('jwt.auth');
Route::put('/movimientos',  'MovimientosController@actualizarMovimiento')->middleware('jwt.auth');

Route::get('/inventario',  'InventarioController@getListaInventario')->middleware('jwt.auth');
Route::get('/inventario_arreglo_llave_valor',  'InventarioController@getInventario_arreglo_llave_valor')->middleware('jwt.auth');

Route::get('/users',  'UsersController@getUsuariosConSuInformacion')->middleware('jwt.auth');
Route::post('/users',  'UsersController@addUsuariosConSuInformacion')->middleware("jwt.auth", "role:root");
Route::put('/users',  'UsersController@actualizarUsuario')->middleware("jwt.auth", "role:root");
Route::post("users/check_change_password/{id_user}", "UsersController@check_change_password")->middleware('jwt.auth');


Route::get('/personas_arreglo_llave_valor',  'UsersController@personas_arreglo_llave_valor')->middleware('jwt.auth');

Route::put('/activo',  'InventarioController@actualizarActivo')->middleware('jwt.auth');
/////////////////////////////////////////////////////////////////

//se pone al final para que vue.router no interfiera con el laravel-router
Route::get('/{catchall?}', 'HomeController@index')->where([ 'catchall' => '([^.]+)$' ]);