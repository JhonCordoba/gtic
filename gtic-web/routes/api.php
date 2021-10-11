<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'api\AuthController@login');
    Route::post('logout', 'api\AuthController@logout');
    Route::post('refresh', 'api\AuthController@refresh');
    Route::post('me', 'api\AuthController@me');

});


Route::group([
    'middleware' => ['api', 'jwt.auth'],
    'prefix' => 'tareas',
    'name' => 'tareas'
], function ($router) {
    Route::get('pendientes', 'TareasController@getTareasSinFinalizar');
});
Route::resource('tareas', 'TareasController')->middleware(['api', 'jwt.auth']);

Route::post('/reporte/software',  'ReportesAutomaticosController@guardarReporteSoftware')->middleware(['api', 'jwt.auth']);
